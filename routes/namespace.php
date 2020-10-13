<?php
/**
 * [更改路由默认命名空间]
 *  默认路由命名空间为$namespace = 'App\Http\Controllers';
 *  修改后该文件定义的路由命名空间为 $this->namespace.'\RouterNamespace' 即在该文件中定义路由时可以省略编写完整的路由命名空间（）
 * @Author  leeprince:2020-10-11 21:56
 */

Route::get('/namespace1', 'AdminController@index');
Route::get('/namespace2', 'Admin2Controller@index');
// 如果不在本路由文件中编写时，需要加上 RouterNamespace 的命名空间
/**
Route::get('/namespace1', 'RouterNamespace\AdminController@index');
Route::get('/namespace2', 'RouterNamespace\Admin2Controller@index');
*/