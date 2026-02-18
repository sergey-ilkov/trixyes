<?php

namespace App\Services\Backend\CallStream;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CallStreamService
{
    /**
     * Create a new class instance.
     */

    protected $channel;

    public function __construct()
    {
        //

        $this->channel = Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/callstream/callstream.log'),
        ]);
    }

    public function login()
    {
        // 
        $response = Http::post(config('services.call_stream.url_auth'), [
            'email' => config('services.call_stream.email'),
            'password' => config('services.call_stream.password'),
        ]);

        if ($response->ok() && $response->body()) {

            $dataResponse = json_decode($response->body());
            if (!$dataResponse->result || !$dataResponse->message->access_token || !$dataResponse->message->refresh_token) {
                Log::stack([$this->channel])->error('Error Authorization', [
                    'error' => $dataResponse,
                ]);

                return false;
            }
            // Log::stack(['single', $this->channel])->info('Tokens.', ['$dataResponse' => $dataResponse]);

            return $this->getDataFormTokens($dataResponse);
        }


        Log::stack([$this->channel])->error('Error Authorization', [
            'status' => $response->status(),
            'error' => $response->body(),
        ]);
        return false;

        // return 'login() and response tokens  <br>';
    }

    public function logout($access_token)
    {
        // 
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $access_token,
        ])->post(config('services.call_stream.url_logout'), []);

        if ($response->ok()) {
            Log::stack([$this->channel])->info('Token has been revoked success.');
            return $response->body();
        }

        Log::stack([$this->channel])->error('Error logout', [
            'status' => $response->status(),
            'error' => $response->body(),
        ]);
        return false;
    }

    public function refresh($refresh_token)
    {
        // 

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post(config('services.call_stream.url_refresh'), [
            'refresh_token' => $refresh_token,
        ]);

        if ($response->ok() && $response->body()) {

            $dataResponse = json_decode($response->body());
            if (!$dataResponse->result || !$dataResponse->message->access_token || !$dataResponse->message->refresh_token) {
                Log::stack([$this->channel])->error('Error Refresh tokens', [
                    'error' => $dataResponse,
                ]);

                return false;
            }

            return $this->getDataFormTokens($dataResponse);
        }


        Log::stack([$this->channel])->error('Error Refresh tokens', [
            'status' => $response->status(),
            'error' => $response->body(),
        ]);
        return false;
    }

    public function task($access_token, $phone)
    {

        $callback_url = route('api.task.update');
        // $callback_url = 'https://sergeyilkov.com';

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $access_token,
                'Content-Type' => 'application/json',
            ])->post(config('services.call_stream.url_task_last4'), [
                'phone' => $phone,
                'callback_url' => $callback_url,
            ]);
        } catch (\Exception $e) {
            Log::stack([$this->channel])->error('HTTP request failed: ', ['error' => $e->getMessage()]);
        }

        Log::stack([$this->channel])->info('Info task response', [
            '$response' => $response,
        ]);

        if ($response->ok() && $response->body()) {


            $dataResponse = json_decode($response->body());

            if (!$dataResponse->result || !$dataResponse->message->id) {
                Log::stack([$this->channel])->error('Error get task', [
                    'error' => $dataResponse,
                ]);

                return false;
            }

            Log::stack([$this->channel])->info('New task success', [
                'task' => $dataResponse,
            ]);

            return $dataResponse;
        }


        Log::stack([$this->channel])->error('Error get task', [
            'status' => $response->status(),
            'error' => $response,
            // 'error' => $response->body(),
        ]);
        return false;
    }

    public function getDataFormTokens($dataResponse)
    {
        $tokens = [
            'access_token' => $dataResponse->message->access_token,
            'refresh_token' => $dataResponse->message->refresh_token,
        ];

        return $tokens;
    }
}