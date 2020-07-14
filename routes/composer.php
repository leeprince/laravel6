<?php
/**
 * [Description]
 *
 * @Author  leeprince:2020-07-08 22:57
 */


// overtrue/laravel-wechat 授权验证
Route::group(['middleware' => ['web', 'wechat.oauth']], function () {
    Route::get('/user', function () {
        $user = session('wechat.oauth_user.default'); // 拿到授权用户资料
        
        dd($user);
    });
});


Route::get('/guardConfig', function (){
    // dd(config());
    dd(Auth::guard('member'));
});