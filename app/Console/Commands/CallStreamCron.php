<?php

namespace App\Console\Commands;

use App\Services\Backend\CallStream\CallStreamService;
use App\Services\Backend\CallStream\CallStreamTokenService;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CallStreamCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'callstream:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh tokens Call Stream';

    /**
     * Execute the console command.
     */
    public function handle(CallStreamService $callStream, CallStreamTokenService $callStreamToken)
    {
        //
        $channel = Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/callstream/callstreamcron.log'),
        ]);
        // Log::stack(['stack', $channel])->info('Cron start.');
        Log::stack([$channel])->info('Cron start.');


        $dataStart = Carbon::now();

        $refresh_token = $callStreamToken->getRefreshToken();

        $tokens = null;

        // ? refresh token
        if ($refresh_token && $refresh_token->token && $refresh_token->expires_at > Carbon::now()) {
            Log::stack([$channel])->info('Еhere is a token. Refresh get tokens');
            try {
                $tokens = $callStream->refresh($refresh_token->token);
            } catch (\Exception $e) {
                Log::stack([$channel])->error('HTTP request failed: ', ['error' => $e->getMessage()]);
            }

            if ($tokens) {
                $callStreamToken->setTokensNull();

                $res = $callStreamToken->updateTokens($tokens);
                if ($res) {
                    Log::stack([$channel])->info('Update tokens success.');
                } else {
                    Log::stack([$channel])->error('Error update tokens.');
                }
            } else {
                Log::stack([$channel])->error('Error get tokens.');
            }
        } else {
            // ? login and update or create token
            Log::stack([$channel])->info('No token or token lifetime expired . Login get tokens.');

            try {
                $tokens = $callStream->login();
            } catch (\Exception $e) {
                Log::stack([$channel])->error('HTTP request failed: ', ['error' => $e->getMessage()]);
            }

            if ($tokens) {
                $res = $callStreamToken->createTokens($tokens);
                Log::stack([$channel])->info('Create tokens.');
                if ($res) {
                    Log::stack([$channel])->info('Update or Create tokens success.');
                } else {
                    Log::stack([$channel])->error('Error create tokens.');
                }
            } else {
                Log::stack([$channel])->error('Error get tokens.');
            }
        }


        $dataEnd = Carbon::now();
        $info = $dataStart . '   ' . $dataEnd;

        Log::stack([$channel])->info('Cron time: .', ['time: ' => $info]);
        Log::stack([$channel])->info('Cron end.');
    }
}