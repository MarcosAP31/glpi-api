<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Include the events routes
require __DIR__.'/api/EventRoutes.php';

// Include the followups routes
require __DIR__.'/api/FollowupRoutes.php';

// Include the queuednotifications routes
require __DIR__.'/api/QueuedNotificationRoutes.php';

// Include the tickets routes
require __DIR__.'/api/TicketRoutes.php';

// Include the users routes
require __DIR__.'/api/UserRoutes.php';

// Include the ticketusers routes
require __DIR__.'/api/TicketUserRoutes.php';
