<?php

use App\Http\Controllers\Api\CallStreamApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


// Route::prefix('/v1')->group(function () {
//     Route::prefix('/callstream/task')->group(function () {
//         Route::get('/', [CallStreamApiController::class, 'index'])->name('api.task.index');
//         Route::post('/', [CallStreamApiController::class, 'task'])->name('api.task.update');
//     });
// });