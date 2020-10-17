<?php
/**
 * [Wap/Shop 路由; 路由前缀为：LaravelWechatShopWapShop]
 *
 * @Author  leeprince:2020-07-08 09:34
 */

/*Route::get('/', function () {
    return '这是 laravel-shop-wap-shop';
});*/
Route::get('/', function () {
    return '这是 laravel-shop-wap-shop';
})->middleware('wechat.oauth');
Route::get('/menu', 'WechatMenuController@menu');
Route::get('/config', function () {
    
    dd(config());
});
Route::get('/index', 'IndexController@index');
