<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;

class ValidateController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            // 编写验证逻辑
            $validatedData = $request->validate([
                'user_name' => 'required|max:255|min:5',
                'password' => 'required|max:255|min:2',
            ]);
            var_dump($validatedData);
            
            return '验证通过 ';
        }
        // if (!empty(session('errors'))) {
        //     return session('errors');
        // }
        
        return view('login');
    }
    
    public function error(Request $request)
    {
        return '验证失败 - 已重定向';
    }
    
    public function post(LoginRequest $request)
    {
        // 表单请求验证：想 Request 的依赖注入（类型提示） 换成表单请求
        // 传入的请求通过验证
        dump($request->validated());
        return '验证通过 ';
    }
}
