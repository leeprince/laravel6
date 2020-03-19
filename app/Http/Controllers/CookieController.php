<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CookieController extends Controller
{
    
    public function cookie()
    {
        // 原生方法: 路径及过期问题
        // setcookie('default', 'leeprince1722', 1);
        
        // 设置 cookie
        // 1. 助手函数：将 Cookies 附加到响应中.必须 return
        // return response('cookie 响应成功')->cookie('name', 'leeprrince1700', 1);
        // cookie 不加密：App\Http\Middleware\EncryptCookies 中间件的 $except 属性
        // return response('cookie 响应成功')->cookie('userName', 'leeprrince1707', 1);
        $cookie = cookie('name', 'prince17', 5);
        return response('cookie 响应成功')->cookie($cookie);
        // 2. 门面：队列。可以不使用 return
        // return Cookie::queue(Cookie::make('queue01', 'value1729', 1));
        // return Cookie::queue('queue02', 'value1729', 1);
        // Cookie::queue('queue02', 'value1729', 1);
    
    }
    
    public function getCookie(Request $request)
    {
        dump($request->cookie('name'));
        dump(request()->cookie('name'));
        dump(Cookie::get('name'));
    }
    
    public function delCookie(Request $request)
    {
        return response('cookie 响应删除成功')->cookie(Cookie::forget('name'));
        // return response('cookie 响应删除成功')->cookie('name', '');
        // return response('cookie 响应删除成功')->cookie('name', null);
    }

}
