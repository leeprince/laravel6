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

// 定义视图
// 创建视图及模版标签
// Route::get('view/test', 'ViewController@index');
// Route::get('view.test', 'ViewController@index');
Route::get('view', 'ViewController@index');
// 模版布局
Route::get('master', 'ViewController@master');
Route::get('child', 'ViewController@child');
// 组件 & 插槽
Route::get('component', 'ViewController@component');









