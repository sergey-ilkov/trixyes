<?php

namespace App\Services\Backend\CallStream;

use App\Models\CallStreamTask;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class CallStreamTaskService
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
            'path' => storage_path('logs/callstream/callstreamtask.log'),
        ]);
    }

    // public function createTask($user, $taskResponse, $request)
    public function createTask($user, $taskResponse)
    {
        $task = new CallStreamTask();
        $task->result = $taskResponse->result;
        $task->error = $taskResponse->error;
        $task->task_id = $taskResponse->message->id;
        $task->attributes = [
            'phone' => $taskResponse->message->phone,
            'callback_url' => $taskResponse->message->callback_url,
            'created_at' => $taskResponse->message->created_at,
        ];
        // $task->session_id = $request->cookie(config('session.cookie'));
        $task->expires_at = Carbon::now()->addMinutes(10);

        // $new_task = $user->callStreamTask()->save($task);
        $new_task = $user->callStreamTasks()->save($task);

        if ($new_task) {
            Log::stack([$this->channel])->info('Create task success', ['task_id' => $new_task->task_id]);
        } else {
            Log::stack([$this->channel])->error('Error create task', ['task_id' => $taskResponse->message->id]);
        }

        return $new_task;
    }
    public function updateTask($request)
    {

        // ? нужно тестировать что присылает в ответ сервис апи call stream
        // ? для теста сохраним присланный запрос в  attributes->res

        $task_id = strip_tags($request->message['id']);


        if ($task_id) {

            $task = CallStreamTask::where('task_id', $task_id)->where('expires_at', '>', Carbon::now())->first();
            if ($task) {

                $attributes = $task->attributes;
                $attributes['response'] = $request->all();
                $task->attributes = $attributes;
                $update_task = $task->update();

                if ($update_task) {
                    Log::stack([$this->channel])->info('Update task DB success: ', ['$task_id' => $task_id]);
                    return true;
                }
                Log::stack([$this->channel])->error('Error update task DB: ', ['$task_id' => $task_id]);

                return false;
            }

            Log::stack([$this->channel])->error('Error update task expires_at < date now(). ', ['$task_id' => $task_id]);
            return false;
        }


        Log::stack([$this->channel])->error('Error update task: ', ['$task_id' => $task_id]);

        return false;
    }
}