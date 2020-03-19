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

# 控制器

// Auth
// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');


Route::get('user', 'UserController@index');

// 单一控制器
Route::get('name/{id}', 'ShowProfile');
Route::get('one/{id}', 'ShowProfileOne');

Route::any('show/{id}', 'UserController@show')->where(['id' => '[0-9]+']);

// 中间件
Route::get('muser', 'UserController@index');
Route::get('mindex', 'UserController@index')->name('mindex');
// 前置&后置 中间件
Route::middleware('checkage')->get('mrequest/{age}', 'UserController@requestAge')->where(['age' => '[0-9]+']);

Route::any('store', 'UserController@store');
Route::any('stores/{id}/{where?}', 'UserController@store');

// 闪存数据: Laravel 允许你在两次请求之间保持数据
Route::any('wi', 'UserController@wi');
Route::any('old', 'UserController@old')->name('old');

// 文件上传
Route::post('file', 'FileController@file');

// 响应
// 字符串 & 数组
// Route::post('/', function () {
//     // return 'hello leeprince';
//     // return [1, 2];
//     return json_encode([1, 2, 3]);
// });
// 添加响应头
// Route::post('/', function () {
//     return response([1, 2, 3], 200)
//         ->header('Content-Type', 'application/json')// text/html、text/plain、application/json
//         // 链式调用
//         ->header('X-Header-One', 'leeprince - header value 01')
//         ->header('X-Header-Two', 'leeprince - header value 02');
//
// });
// 添加响应头可以使用 withHeaders 方法来指定要添加到响应的头信息数组:
// Route::post('/', function () {
//     return response([1, 2, 3], 200)
//         ->withHeaders([
//             'Content-Type' => 'application/json', // text/html、text/plain、application/json
//             'X-Header-One' => 'leeprince - header value 01',
//             'X-Header-Two' => 'leeprince - header value 02'
//         ]);
// });
// 重定向
Route::get('dashboard', 'HomeController@dashboard')->name('dashboardname');
// Route::redirect('dashboardredirect', 'dashboard');
Route::get('dashboardredirect', function () {
    // 重定向到路由
    // return redirect('dashboard');

    // 重定向到路由并使用闪存数据
    // return redirect('dashboard')->with(['sessionOne' => 'one']);

    // 重定向到命名路由
    return redirect()->route('dashboard');
});
// 重定向到之前的位置
Route::get('user/profile', function () {
    // 验证请求

    // 由于这个功能利用了 会话控制， 请确保调用 back 函数的路由使用 web 中间件组或所有 Session 中间件:
    // return back();
    return back()->withInput();
});
// 重命名到路由
Route::get('profile/{id}/{where?}', 'UserController@profile')->name('profilename');
// Route::redirect('dashboardredirect', 'dashboard');
Route::get('profileredirect', function () {
    // 重定向到路由
    // return redirect('profile/2/a');

    // 重定向到命名路由
    return redirect()->route('profilename', ['id' => 10, 'where' => 'where01']);
});
// 重定向到控制器行为
Route::get('profilecontroller', function () {
    return redirect()->action('UserController@profile', [
        'id' => 11, 'where' => 'where02'
    ]);
});
// 重定向到外部域名
Route::get('profileaway', function () {
    // return redirect('http://www.baidu.com');
    // return redirect()->away('http://www.baidu.com');
});
// 视图响应
Route::get('profileview', function () {
    return response()
        ->view('profile', ['user' => User::findOrFail(1)])
        ->header('Content-Type', 'text/html');
});
// json响应
Route::get('profilejson', function (Request $request) {
    // return response([
    //     'user' => User::findOrFail(1)
    // ]);
    // return response()->json([
    //         'user' => User::findOrFail(1)
    // ]);

    // 如果想要创建 JSONP 响应，可以结合 withCallback 方法使用 json 方法:
    // dump($request->input("callback"));
    return response()
        ->json(['name' => 'Abigail', 'state' => 'CA'])
        ->withCallback($request->input('callback'));
});
// 文件下载
Route::get('download', function() {
    // $filename = 'leeprinceimg.jpeg';
    $filename = 'Cb1jOdcOp5JHGmP4wWISC2r0OfrL6py2PiICExZW.jpeg';

    $header = [
        'Cache-Control' => 'max-age=0',
        'Content-Description' => 'File Transfer',
        'Content-Disposition' => 'attachment;filename='.'dispositionName默认文件名.jpeg',
        'Content-Type' => 'application/zip',
        'Content-Transfer-Encoding'  => 'binary'
    ];

    // $downPath = storage_path('app/images/').$filename;
    // $downPath = storage_path('app/public/').$filename;
    $downPath = public_path('storage/').$filename; // php artisan storage:link

    // return response()->download($downPath);
    // return response()->download($downPath, 'downimg.jpeg');
    return response()->download($downPath, 'downimg.jpeg', $header);
    // return response()->download($downPath)->deleteFileAfterSend();
});
// 文件响应：文件预览
Route::get('downloadlook', function() {
    // $filename = 'leeprinceimg.jpeg';
    $filename = 'Cb1jOdcOp5JHGmP4wWISC2r0OfrL6py2PiICExZW.jpeg';

    // $downPath = storage_path('app/images/').$filename;
    // $downPath = storage_path('app/public/').$filename;
    $downPath = public_path('storage/').$filename; // php artisan storage:link

    return response()->file($downPath);
});


// 资源路由
// Route::resource('photos', 'Api\PhotoController');
// 部分资源路由
// Route::resource('photos', 'Api\PhotoController')->only([ 'index', 'show'
// ]);
// Route::resource('photos', 'Api\PhotoController')->except([ 'create', 'store', 'update', 'destroy'
// ]);
// 将自定义的资源控制器方法声明为普通路由定义的方法
Route::get('customerapi', 'Api\PhotoController@customerapi');
// 命名资源路由
// Route::resource('photos', 'Api\PhotoController')->names([
//     'create' => 'photos.build'
// ]);
// Route::resource('photos', 'Api\PhotoController', ['names' => [
//     'index'   => 'photos.index',
//     'create'  => 'photos.create',
//     'store'   => 'photos.store',
//     'show'    => 'photos.show',
//     'edit'    => 'photos.edit',
//     'update'  => 'photos.update',
//     'destroy' => 'photos.destroy'
// ]]);
// 命名资源路由参数
// Route::resource('photos', 'Api\PhotoController')->parameters([
//     'photos' => 'show_id'
// ]);
// Route::get('photosredirect', function () {
//     return redirect()->route('photos.show', [
//         'show_id' => 1
//     ]);
//     return redirect()->route('photos.edit', [
//         'show_id' => 1
//     ]);
// });









