<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketUserController;

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
Route::get('/ticketusers', [TicketUserController::class, 'index']);
Route::get('/ticketusers/latest', [TicketUserController::class, 'getLatest']);
Route::get('/ticketusers/{id}', [TicketUserController::class, 'show']);
Route::get('/ticketusers/ticketid-type/{ticketId}/{type}', [TicketUserController::class, 'getByTicketIdAndType']);
Route::post('/ticketusers', [TicketUserController::class, 'store']);
Route::put('/ticketusers/{id}', [TicketUserController::class, 'update']);
Route::delete('/ticketusers/{id}', [TicketUserController::class, 'destroy']);
