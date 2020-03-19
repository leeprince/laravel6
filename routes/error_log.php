<?php

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

use Illuminate\Support\Facades\Log;

// 错误
Route::any('abort', function () {
    abort(404,  '我是abort抛出的HTTP异常');
});
Route::get('log', function () {
   Log::error('error 日志');
   Log::debug('debug 日志');
});
