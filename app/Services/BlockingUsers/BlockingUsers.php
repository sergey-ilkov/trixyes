<?php


namespace App\Services\BlockingUsers;

use App\Models\Blocking;
use Illuminate\Http\Request;




class BlockingUsers
{
    public function isBlocked(Request $request)
    {

        $user = Blocking::query()
            ->where('ip', '=', $request->ip())
            // ->whereDate('created_at', '=', now()->format('Y-m-d '))
            ->first();


        if ($user && $user->blocking) {

            return true;
        }

        return false;
    }


    public function createOrUpdateBlockedUser($request)
    {
        $user = Blocking::query()
            ->where('ip', '=', $request->ip())
            // ->where('path', '=', $request->path())
            // ->whereDate('created_at', '=', now()->format('Y-m-d '))
            ->first();

        if (!$user) {
            $user = Blocking::query()->create([

                'ip' => $request->ip(),
                // 'path' => $request->path(),
                'count' => 1,
                'blocking' => false,
            ]);
        } else {

            $user->increment('count');

            if ($user->count >= env('APP_BLOCKING_COUNT')) {

                $user->update(['blocking' => true]);
            }
        }
    }
}
