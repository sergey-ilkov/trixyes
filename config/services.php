<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'call_stream' => [
        'email' => env('CALL_STREAM_EMAIL'),
        'password' => env('CALL_STREAM_PASSWORD'),
        'url_auth' => env('CALL_STREAM_URL_AUTH'),
        'url_refresh' => env('CALL_STREAM_URL_REFRESH'),
        'url_logout' => env('CALL_STREAM_URL_LOGOUT'),
        'url_task' => env('CALL_STREAM_URL_TASK'),
        'url_task_last4' => env('CALL_STREAM_URL_TASK_LAST4'),
    ],

];
