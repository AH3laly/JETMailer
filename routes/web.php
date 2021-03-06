<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() {
    return View::make('pages.dashboard');
 });
 
 Route::get('/mails', function() {
    return View::make('pages.mails');
 });
 
 Route::get('/newmail', function() {
    return View::make('pages.newmail');
 });

 Route::get('/mtaservers', function() {
    return View::make('pages.mtaservers');
 });

 Route::get('/logs', function() {
    return View::make('pages.logs');
 });
