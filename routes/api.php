<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MailsController;
use App\Http\Controllers\MTAServerController;
use App\Http\Controllers\LogController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Routing for /api/mail forwards requests to DefaultController::class controller
 */
Route::group(['prefix'=>'mail'], function(){
    Route::get('/', [MailsController::class, 'getItems']);
    Route::get('/statistics', [MailsController::class, 'getStatistics']);
    Route::post('/', [MailsController::class, 'createItem']);
});

Route::group(['prefix'=>'mtaserver'], function(){
    Route::get('/', [MTAServerController::class, 'getItems']);
});

Route::group(['prefix'=>'log'], function(){
    Route::get('/', [LogController::class, 'getItems']);
});