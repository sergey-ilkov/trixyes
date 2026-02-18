<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Backend\CallStream\CallStreamTaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CallStreamApiController extends Controller
{
    //
    protected $channel;

    public $callStreamTask;

    public function __construct(CallStreamTaskService $callStreamTask)
    {
        $this->channel = Log::build([
            'driver' => 'single',
            'path' => storage_path('logs/callstream/callstream.log'),
        ]);

        $this->callStreamTask = $callStreamTask;
    }


    public function index()
    {


        return  response('GET /api/v1/callstream/task 200 ok', 200);
        // return  response('/api/v1/task 200 ok', 200)->header('Content-Type', 'text/html');
        // return response('ok', 200);
    }

    public function task(Request $request)
    {

        // ? test midlleware


        // ? проверка данных request
        // if (isset($request->message['id2'])) {
        //     return response()->json(['res' => $request->message['id2']]);
        // }
        // return response()->json(['res' => $request->message['id']]);
        // return response()->json(['res' => $request->all()]);


        Log::stack([$this->channel])->info('ApiController. Request update task', ['$request' => $request->all()]);

        if (!$request->message || !$request->message['id']) {
            Log::stack([$this->channel])->info('ApiController. Error Request update task');
            return response('ok', 200);
        }

        // return dd(
        //     $request->host(),
        //     $request->httpHost(),
        //     $request->schemeAndHttpHost()
        // );

        // ? нужно тестировать что присылает в ответ сервис апи call stream
        // ? для теста сохраним присланный запрос в  attributes->res

        // Log::stack([$this->channel])->info('Request update task', ['$request' => $request->all()]);

        $this->callStreamTask->updateTask($request);



        // return response()->json(['task_id' => $request->message['id']]);

        return response('ok', 200);
    }
}
