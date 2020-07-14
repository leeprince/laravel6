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

/** 表单验证 */
Route::any('login', 'ValidateController@login');
// 表单验证请求
Route::post('post', 'ValidateController@post');

Route::get('validateForm', function () {
    return view('validateFrom');
});
Route::middleware('web')->post('validate', 'ValidateController@validateForm')->name('validate.form');

// 表单验证请求 - 失败自定义重定向
Route::get('error', 'ValidateController@error');

