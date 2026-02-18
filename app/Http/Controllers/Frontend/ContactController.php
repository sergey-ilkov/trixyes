<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\SendMessage;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    //
    public function index()
    {
        $posts = Post::where('published', 1)->where('slider', 1)->get();

        $page = 'contacts';
        return view('frontend.contacts.index', compact('page', 'posts'));
    }
    public function send(Request $request)
    {


        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);


        try {
            // ? send email
            Mail::to('support@trixy.com.ua')->send(new SendMessage($data));

            $res = [
                "status" => "ok",
            ];

            return response()->json($res);
        } catch (Exception $ex) {

            $errors = [
                "status" => "error",
                'errors' => [
                    'send-email' => __('messages.error_sending_email'),
                ]
            ];
            return response()->json($errors);
        }
    }
}