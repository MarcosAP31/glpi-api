<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QueuedNotificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::get('/queuednotifications', [QueuedNotificationController::class, 'index']);
Route::get('/queuednotifications/latest', [QueuedNotificationController::class, 'getLatest']);
Route::get('/queuednotifications/{id}', [QueuedNotificationController::class, 'show']);
Route::get('/queuednotifications/itemid/{itemId}', [QueuedNotificationController::class, 'getByItemId']);
Route::post('/queuednotifications', [QueuedNotificationController::class, 'store']);
Route::put('/queuednotifications/{id}', [QueuedNotificationController::class, 'update']);
Route::delete('/queuednotifications/{id}', [QueuedNotificationController::class, 'destroy']);
