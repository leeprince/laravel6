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

use App\User;
use Illuminate\Http\Request;

Route::get('/', function () {
    // dd(debug_backtrace());
    return view('welcome');
}
);


// 路由体验
Route::get('hello/{id}', 'Home\HelloController@foo')->where('id', "[0-9]+");

// 路由到控制器
// Route::post('hello', 'HelloController@index');
// Route::match(['get', 'post'], 'hello', 'HelloController@index');
// Route::any(['get', 'post'], 'hello', 'HelloController@index');

// 路由参数：路由参数是安装参数位置绑定到操作方法内部，不是命令映射
// Route::get('hello/{age}', function($age) {
//    return $age;
// });

// Route::get('hello/{age}', 'HelloController@index')->where('age', '[0-9]+');

// Route::get('hello/{age?}', function($age = 19) {
//    return $age;
// });

// Route::get('hello/{age?}', 'HelloController@index')->where('age', '[0-9]+');

// Route::get('hello/{id}', 'HelloController@index');


// 路由命名
// Route::middleware(['checkRoute'])->get('hello', 'HelloController@hello')->name('hello');
// Route::get('foo', 'HelloController@hello')->name('foo');
// Route::middleware(['checkRoute'])->group(function() {
//     Route::get('hello', 'HelloController@hello')->name('hello');
//     Route::get('foo', 'HelloController@hello');
// });

// 路由组
Route::group(['prefix' => 'hello', 'name' => 'namehello.'], function () {
    Route::get('hello', 'HelloController@hello')->name('hello');
    Route::get('foo', 'HelloController@foo')->name('foo');
});

// 路由组中路由的命名前缀
Route::name('namehello.')->group(function () {
    Route::get('hello', 'HelloController@hello')->name('hello');
    Route::get('foo', 'HelloController@foo')->name('foo');
});
Route::get('prince', 'HelloController@prince')->name('prince');

// 重定向路由
Route::redirect('prince', 'hello');

// 定义一个在没有其他路由可匹配传入的请求时，才执行的路由
// Route::fallback(function () {
//     return redirect()->route('prince');
// });

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::middleware('auth')->group(function () {
        Route::get('info', 'AdminController@index')->name('auth.info');
    }
    );
    Route::post('login', 'AdminController@login');
});

