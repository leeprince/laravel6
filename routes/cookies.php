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


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/** 设置 cookie */
Route::any('cookie', 'CookieController@cookie');
/** 获取 cookie */
Route::any('getCookie', 'CookieController@getCookie');
/** 删除 cookie */
Route::any('delCookie', 'CookieController@delCookie');

/** 设置 session */
Route::any('setSession', function (Request $request) {
    // 请求实例
    dump($request->session()->put('key18', 'value18'));
    // 助手函数
    dump(session('key1815', 'value1815'));
    dump(session([
        'key1816' => 'value1816',
        'key1817' => 'value1817'
    ]));
    dump(session([
        'user'  => [
            'key1816' => 'value1816',
            'key1817' => 'value1817'
        ]
    ]));
    // dump($request->session()->push('user.key35', 35));
    dump(Session::push('user.key36', 36));
    dump(Session::push('user.key37', 37));
    dump(Session::push('user.key38', '38'));
    // 门面
    dump(Session::put('key21', 21));
});
/** 获取 session */
Route::any('getSession', function (Request $request) {
    // dump(Session::all());
    dump($request->session()->get('key18'));
    dump(session()->get('key18'));
    dump(session('key18'));
    dump(Session::get('key18'));
    
    // dump($request->session()->get('keyNull', 'defaulut'));
});
/** 删除 session */
Route::any('delSession', function (Request $request) {
    dump($request->session()->pull('key18', 'default'));
    // 删除单个值...
    $request->session()->forget('key');
    // 删除多个值...
    $request->session()->forget(['key1', 'key2']);
    // 删除所有
    $request->session()->flush();
});

/** 表单验证 */
Route::any('login', 'CookieController@login');
// 表单验证请求
Route::post('post', 'CookieController@post');
// 表单验证请求 - 失败自定义重定向
Route::get('error', 'CookieController@error');

