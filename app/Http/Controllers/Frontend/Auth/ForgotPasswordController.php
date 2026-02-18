<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendForgotLink;
use App\Models\PasswordResetToken;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    //
    protected $channel;

    public function __construct()
    {
        //
        $this->channel = Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/forgot.log'),
        ]);
    }

    // public function showForgotPasswordForm()
    // {
    //     // 
    //     $page = 'forgot-pass';

    //     return view('frontend.auth.forgotPassword', compact('page'));
    // }

    public function submitForgotPasswordForm(Request $request)
    {
        // 


        $request->validate([
            'email' => 'required|email',
        ]);

        $email = strip_tags($request->email);

        $user = User::where('email', $email)->first();

        if (!$user) {
            $error = [
                "status" => "error",
                'errors' => [
                    'email' => __('messages.email_not_registered'),
                ]
            ];
            return response()->json($error);
        }

        $token = str(str()->random(64))->lower();


        $resetPassword = DB::table('password_reset_tokens')->where(['email' => $email])->first();
        if ($resetPassword) {
            DB::table('password_reset_tokens')->where(['email' => $email])->delete();
        }

        $resetPassword = DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);




        if (!$resetPassword) {
            $error = [
                "status" => "error",
                'errors' => [
                    'forgot' => __('messages.forgot_error_occurred'),
                ]
            ];
            return response()->json($error);
        }



        $sendMail = null;
        // ? send email
        try {
            $data = [
                'token' => $token,
            ];

            // ? send email
            $sendMail = Mail::to($email)->send(new SendForgotLink($data));
            // Mail::to($email)->send(new SendForgotLink($data));


            // $res = [
            //     "status" => "ok",
            //     // 'message' => __('messages.success_registration'),
            //     'forgot' => true,
            // ];
            // return response()->json($res);
        } catch (Exception $ex) {

            Log::stack([$this->channel])->error('Error send email forgot password: ', ['error' => $ex->getMessage()]);



            // $errors = [
            //     "status" => "error",
            //     'errors' => [
            //         'send-email' => __('messages.error_sending_email'),
            //     ]
            // ];
            // return response()->json($errors);
        }


        if ($sendMail) {
            $res = [
                "status" => "ok",
                // 'message' => __('messages.success_registration'),
                'sendMail' => $sendMail,
                'forgot' => true,
            ];
            return response()->json($res);
        } else {

            DB::table('password_reset_tokens')->where(['email' => $email])->delete();


            $errors = [
                "status" => "error",
                'sendMail' => $sendMail,
                'errors' => [
                    'send-email' => __('messages.error_sending_email'),
                ]
            ];
            return response()->json($errors);
        }
    }

    public function showResetPasswordForm($token)
    {
        // 
        $page = 'reset-pass';


        return view('frontend.auth.resetPassword', compact('page'), ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        // 
        $request->validate([
            'password' => 'required|string|min:8',
            // 'email' => 'required|email',
            // 'password' => 'required|string|min:8|confirmed',
            // 'password_confirmation' => 'required'
        ]);


        // $email = strip_tags($request->email);

        // $user = User::where('email', $email)->first();

        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'token' => $request->token_forgot
            ])
            ->first();

        if (!$updatePassword) {

            $errors = [
                "status" => "error",
                'errors' => [
                    'email_token' => __('messages.error_forgot'),
                ]
            ];
            return response()->json($errors);
        }
        $email = $updatePassword->email;

        $user = User::where('email', $email)->first();

        if (!$user) {

            DB::table('password_reset_tokens')->where(['email' => $email])->delete();

            $errors = [
                "status" => "error",
                'errors' => [
                    'email' => __('messages.error_forgot'),
                ]
            ];
            return response()->json($errors);
        }









        if (Carbon::parse($updatePassword->created_at)->addMinutes(10) < Carbon::now()) {

            DB::table('password_reset_tokens')->where(['email' => $email])->delete();

            $errors = [
                "status" => "error",
                'errors' => [
                    'email_token' => __('messages.error_token_expires'),
                ]
            ];
            return response()->json($errors);
        }


        DB::table('password_reset_tokens')->where(['email' => $email])->delete();



        $user->update(['password' => bcrypt($request->password)]);



        $res = [
            "status" => "ok",
            'forgot' => true,
        ];
        return response()->json($res);
    }
}
