<?php

namespace App\Services\Frontend;

use App\Mail\SendCode;
use App\Models\User;
use App\Services\Backend\CallStream\CallStreamService;
use App\Services\Backend\CallStream\CallStreamTaskService;
use App\Services\Backend\CallStream\CallStreamTokenService;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthUserService
{

    protected $channel;



    public function __construct()
    {
        //
        $this->channel = Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/authuser.log'),
        ]);
    }

    public function register($request)
    {

        if ($request->action == 'email-confirm') {

            $request->validate([
                'email' => 'required|email',
            ]);


            $email = strip_tags($request->email);


            $user = User::where('email', $email)->first();
            if ($user) {
                $res = [
                    "status" => "error",
                    'errors' => [
                        'email' => __('messages.email_already_registered'),
                    ]
                ];
                return response()->json($res);
            }



            $code = codeGenerator();



            $data = [
                'code' => $code,
                'url' => route('home'),
            ];



            try {
                // ? send email
                Mail::to($email)->send(new SendCode($data));

                Cache::put($email, $code, now()->addMinutes(10));

                $res = [
                    "status" => "ok",
                ];

                return response()->json($res);
            } catch (Exception $ex) {

                Log::stack([$this->channel])->error('Error send email code: ', ['error' => $ex]);
                $errors = [
                    "status" => "error",
                    'errors' => [
                        'send-email' => __('messages.error_sending_email'),
                    ]
                ];
                return response()->json($errors);
            }
        }

        if ($request->action == 'sign-up') {

            $request->validate([
                'name' => 'required',
                'surname' => 'required',
                'birthday' => 'required',
                'phone' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'code' => 'required',
            ]);


            $name = strip_tags($request->name);
            $surname = strip_tags($request->surname);
            $birthday = strip_tags($request->birthday);
            $phone = strip_tags($request->phone);
            $email = strip_tags($request->email);
            $password = $request->password;
            $code = strip_tags($request->code);



            $codeCache = Cache::pull($email);


            $errors = [];

            $users = User::all();

            if (!$users->isEmpty()) {

                $phoneDB = $users->whereIn('phone', $phone)->isNotEmpty();
                if ($phoneDB) {
                    $errors['phone'] =  __('messages.phone_already_registered');
                    $errors['code'] =  __('messages.get_new_code');
                }

                $emailDB = $users->whereIn('email', $email)->isNotEmpty();
                if ($emailDB) {
                    $errors['email'] =  __('messages.email_already_registered');
                    $errors['code'] =  __('messages.get_new_code');
                }
            }



            $checkCode = $code == $codeCache;
            if (!$checkCode) {
                $errors['code'] =  __('messages.invalid_verification_code');
            }


            if (!empty($errors)) {
                $res = [
                    "status" => "error",
                    'errors' => $errors,
                ];
                return response()->json($res);
            }

            $id_unique = str()->substr($phone, -7) . str(str()->random(8))->lower();

            $userData = [
                'name' => $name,
                'surname' => $surname,
                'birthday' => $birthday,
                'phone' => $phone,
                'email' => $email,
                'password' => bcrypt($password),
                'id_unique' => $id_unique,

            ];


            $user = User::create($userData);


            if ($user) {


                $userAuthData = [
                    'email' => $email,
                    'password' => $password,
                ];

                if ($this->authenticate($userAuthData)) {

                    $res = [
                        "status" => "ok",
                        "auth" => true,
                        'message' => __('messages.success_registration'),
                    ];

                    return response()->json($res);
                }
            }

            Log::stack([$this->channel])->error('Error user authenticate.');

            $res = [
                "status" => "error",
                'errors' => [
                    'register' => __('messages.error_registration'),
                ]
            ];
            return response()->json($res);
        }



        $error = [
            "status" => "error",
            'errors' => [
                'action' => "Invalid action field value",
            ]
        ];
        return response()->json($error);
    }



    public function login($request)
    {



        $request->validate([
            'action' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);



        $email = strip_tags($request->email);
        $password = $request->password;
        if ($request->action == 'sign-in') {

            $userAuthData = [
                'email' => $email,
                'password' => $password,
            ];

            if ($this->authenticate($userAuthData)) {

                $res = [
                    "status" => "ok",
                    "auth" => true,
                ];

                return response()->json($res);
            }


            $error = [
                "status" => "error",
                'errors' => [
                    'message' => __('messages.auth_error_email_pass'),
                ]
            ];
            return response()->json($error);
        }




        $error = [
            "status" => "error",
            'errors' => [
                'action' => "Invalid action field value",
            ]
        ];
        return response()->json($error);
    }



    public function authenticate($userAuthData)
    {
        if (Auth::attempt($userAuthData)) {

            request()->session()->regenerate();

            return true;
        }

        return false;

        // Auth::loginUsingId($userId);
        // $request->session()->regenerate();
    }


    public function generateUniqueString($len = 10, $num = 0)
    {

        $secret_key = $num == 0 ?  str(str()->random($len))->lower() : str(str()->random($len))->lower() . $num;

        $data = ['id_unique' => $secret_key,];

        $num++;

        $rules = ['id_unique' => 'unique:users'];

        $validate = Validator::make($data, $rules)->passes();

        return $validate ? $data['id_unique'] : $this->generateUniqueString($len, $num);
    }
}