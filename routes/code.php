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

use App\MyFacade\Index;
use Illuminate\Support\Facades\Config;

/** app 的容器实例使用 redis 抽象去调用redis 相关方法 */
Route::get('app', function() {
    // dump(app()->getBindings());
    // dump(app('redis'));
    // dump(app()->make('redis'));
    // dump(app('redis')->set('key01', 'value02'));
    // dump(app('redis')->get('key01'));

    dump(app('config')->all());
    dump(Config::all());
});

/** 自定义服务提供者
 *      1. 编写服务提供者:在register() 方法中绑定服务到容器-注册服务提供者
 *      2. 在config/app.php 中注册服务提供者
 */
Route::get('provider', function() {
    dump(app('trade')->index());
});

/** 自定义门面
 *      1. 创建门面需要「静态代理」的类
 *      2. 编写服务提供者:在register() 方法中绑定服务到容器-注册服务提供者
 *      3. 在config/app.php 中注册服务提供者【注意2, 3 步骤可以在已存在的服务提供者中操作】
 *      4. 创建门面类
 */
Route::get('facade', function() {
    // 1. 通过服务提供者获取服务
    dump(app('index')->index());
    // 2. 通过自定义门面获取服务
    dump(Index::index());
    // 通过门面别名获取服务s
    dump(IndexAliase::index());
});

/**
 * 自定义契约
 *      1. 定义契约的接口类
 *      2. 定义契约接口的实现
 *      3. 编写服务提供者:在register() 方法中绑定服务到容器-注册服务提供者
 *      4. 在config/app.php 中注册服务提供者【注意3, 4 步骤可以在已存在的服务提供者中操作】
 */
// 1. 通过服务容器的辅助函数访问契约约束的实现方法
Route::get('contracts', function() {
   return app('alipay')->transaction();
});
// 2. 通过依赖注入契约的实现类访问契约约束的实现方法：这种方式则不需要上面步骤4 中的注册服务提供者，不过这种方式代码耦合度高，不推荐！推荐方案1和方案3！
Route::get('contracts01', function(App\MyPackage\Alipay $alipay) {
   return $alipay->transaction();
});
// 3. 通过依赖注入契约的接口类访问契约约束的实现方法
Route::get('contracts02', function(App\MyContracts\Pay $alipay) {
   return $alipay->transaction();
});



