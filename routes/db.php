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

// 读写分离
Route::get('read', 'DbController@read');

// 事务
Route::get('trans', 'DbController@trans');

// 原生 sql
Route::get('simple', 'DbController@simple');

// 查询构造器
Route::get('select', 'DbController@select');

// redis 操作
Route::get('redis', 'DbController@redis');

// 模型 操作
Route::get('model', 'DbController@model');

// 模型 事件
Route::get('event', 'DbController@event');

// 模型 关联
Route::get('relevance', 'DbController@relevance');

// 模型 预加载
Route::get('with', 'DbController@with');

// 插入 & 更新关联模型
Route::get('saveOrUpdate', 'DbController@saveOrUpdate');

// 访问器 & 修改器
Route::get('attribute', 'DbController@attribute');