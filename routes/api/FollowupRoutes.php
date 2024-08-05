<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FollowupController;

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
Route::get('/followups', [FollowupController::class, 'index']);
Route::get('/followups/latest', [FollowupController::class, 'getLatest']);
Route::get('/followups/latestbydate', [FollowupController::class, 'getLatestByDate']);
Route::get('/followups/{id}', [FollowupController::class, 'show']);
Route::get('/followups/sendnotificationauthor', [FollowupController::class, 'sendNotificationAuthor']);
Route::post('/followups', [FollowupController::class, 'store']);
Route::put('/followups/{id}', [FollowupController::class, 'update']);
Route::delete('/followups/{id}', [FollowupController::class, 'destroy']);

