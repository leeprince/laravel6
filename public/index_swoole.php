<?php

/**
 * 使用 swoole 加速 laravel 框架
 */

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);


$http = new Swoole\Http\Server('0.0.0.0', 9501);

/**
 * 使用 swoole 加速 laravel 框架
 */
$http->on('request', function ($swoole_request, $swoole_response) use ($kernel) {
    // var_dump($swoole_request->server);
    // var_dump($_SERVER);
    
    // 请求两次问题解决
    if ($swoole_request->server['path_info'] == '/favicon.ico' || $swoole_request->server['request_uri'] == '/favicon.ico') {
        $swoole_response->end();
        return;
    }
    
    // swoole 会将 $_SERVER 的部分参数省略掉，包含（REQUEST_URI）. 导致在获取路由地址(vendor/symfony/http-foundation/Request.php@prepareRequestUri) 的时候总是 / ，最终都是返回 / 的路由
    // 解决办法1:[推荐]
    $_SERVER['REQUEST_URI'] = $swoole_request->server['request_uri'];
    // 解决办法2：【完整】
    /*
    $_SERVER = [];
    if (isset($request_swoole->server)) {
       foreach ($request_swoole->server as $k => $v) {
           $_SERVER[strtoupper($k)] = $v;
       }
    }
    // 这个一定要写不然会报错
    $_SERVER['argv'] = [];
    if (isset($request_swoole->header)) {
       foreach ($request_swoole->server as $k => $v) {
           $_SERVER[strtoupper($k)] = $v;
       }
    }
    $_GET = [];
    if (isset($request_swoole->get)) {
       foreach ($request_swoole->get as $k => $v) {
           if($k == 's'){
               $_GET[$k] = $v;
           }else{
               $_GET[strtoupper($k)] = $v;
           }
       }
    }
    $_POST =[];
    if (isset($request_swoole->post)) {
       foreach ($request_swoole->post as $k => $v) {
           $_POST[strtoupper($k)] = $v;
       }
    }
     */
    
    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    );
    $kernel->terminate($request, $response); // 不影响
    
    // 响应头 - 需将 laravel 响应的头部设置方式用 swoole 替换，暂时不修改
    // $swoole_response->header("Content-Type", "text/html; charset=utf-8");
    
    // swoole 的输出方式与 laravel 不一样，需要做兼容处理
    // 将 $response->send() 替换为 $response->getContent(); 直接输出内容，不输出头部
    $swoole_response->end($response->getContent());
});

$http->start();

