<?php
/**
 * [Wap/Member 路由; 路由前缀为：LaravelWechatShopWapMember]
 *
 * @Author  leeprince:2020-07-08 09:34
 */

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return '这是 laravel-shop-wap-member';
});
Route::get('/wechatLogin', 'AuthorizationController@wechatLogin')->middleware('wechat.oauth');
Route::get('/config', function () {
    // dump(Auth::guard('prince-wap-member'));
    dump(app()->getBindings());
    dd(config());
});
/*Route::get('/config', function () {
    // dump(Auth::guard('prince-wap-member'));
    dump(app()->getBindings());
    dd(config());
})->middleware('wechat.oauth');*/
