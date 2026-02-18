<?php

namespace App\Services\Backend\CallStream;

use App\Models\CallStreamToken;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class CallStreamTokenService
{
    /**
     * Create a new class instance.
     */
    protected $chanel;
    public function __construct()
    {
        //
        $this->channel = Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/CallStream/callstreamtoken.log'),
        ]);
    }

    public function getAccessToken()
    {

        $access_token = CallStreamToken::where('name', 'access_token')->first();

        if ($access_token && $access_token->token) {

            try {
                $access_token->token = Crypt::decryptString($access_token->token);
            } catch (\Exception $e) {
                $access_token->token = null;
                $access_token->update();
                Log::stack([$this->channel])->error('Decrypt access token failed: ', ['error' => $e->getMessage()]);
            }
        }

        return $access_token;
    }

    public function getRefreshToken()
    {

        $refresh_token = CallStreamToken::where('name', 'refresh_token')->first();

        if ($refresh_token && $refresh_token->token) {
            try {
                $refresh_token->token = Crypt::decryptString($refresh_token->token);
            } catch (\Exception $e) {
                $refresh_token->token = null;
                $refresh_token->update();
                Log::stack([$this->channel])->error('Decrypt refresh token failed: ', ['error' => $e->getMessage()]);
            }
        }

        return $refresh_token;
    }

    public function createTokens($tokens)
    {

        $data = $this->getFormDataTokens($tokens);

        $access_token_db = CallStreamToken::updateOrCreate(['name' => 'access_token'], [

            'token' => $data['access_token_encrypt'],
            'expires_at' => $data['access_token_expires'],
        ]);
        $refresh_token_db = CallStreamToken::updateOrCreate(['name' => 'refresh_token'], [

            'token' => $data['refresh_token_encrypt'],
            'expires_at' => $data['refresh_token_expires'],
        ]);
        // $access_token_db = CallStreamToken::create([
        //     'name' => 'access_token',
        //     'token' => $data['access_token_encrypt'],
        //     'expires_at' => $data['access_token_expires'],
        // ]);
        // $refresh_token_db = CallStreamToken::create([
        //     'name' => 'refresh_token',
        //     'token' => $data['refresh_token_encrypt'],
        //     'expires_at' => $data['refresh_token_expires'],
        // ]);

        if ($access_token_db && $refresh_token_db) {
            return true;
        }

        return false;
    }

    public function updateTokens($tokens)
    {

        $data = $this->getFormDataTokens($tokens);

        $access_token_db = $this->getAccessToken();
        if ($access_token_db) {
            $access_token_db->update([
                'name' => 'access_token',
                'token' => $data['access_token_encrypt'],
                'expires_at' => $data['access_token_expires'],
            ]);
        }
        $refresh_token_db = $this->getRefreshToken();
        if ($refresh_token_db) {
            $refresh_token_db->update([
                'name' => 'refresh_token',
                'token' => $data['refresh_token_encrypt'],
                'expires_at' => $data['refresh_token_expires'],
            ]);
        }

        if ($access_token_db && $refresh_token_db) {
            return true;
        }

        return false;
    }

    public function setTokensNull()
    {
        $token_expires = Carbon::now();
        CallStreamToken::updateOrCreate(['name' => 'access_token'], [
            'name' => 'access_token',
            'token' => null,
            'expires_at' => $token_expires,
        ]);
        CallStreamToken::updateOrCreate(['name' => 'refresh_token'], [
            'name' => 'refresh_token',
            'token' => null,
            'expires_at' => $token_expires,
        ]);
    }

    public function getFormDataTokens($tokens)
    {
        $access_token_expires = Carbon::now()->addHour(2);
        $refresh_token_expires = Carbon::now()->addHour(4);

        $access_token = $tokens['access_token'];
        $refresh_token = $tokens['refresh_token'];
        $access_token_encrypt = Crypt::encryptString($access_token);
        $refresh_token_encrypt = Crypt::encryptString($refresh_token);

        return [
            'access_token_encrypt' => $access_token_encrypt,
            'refresh_token_encrypt' => $refresh_token_encrypt,
            'access_token_expires' => $access_token_expires,
            'refresh_token_expires' => $refresh_token_expires,
        ];
    }
}
