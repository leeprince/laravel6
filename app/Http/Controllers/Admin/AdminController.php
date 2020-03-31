<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        dump(Auth::user()->name);
        return 'AdminControler@index';
    }

    public function login(Request $request)
    {
        $data = $request->only('email', 'password');
        if (Auth::attempt($data)) {
            dump('登录成功');
            echo '登录成功';
            return redirect()->route('auth.info');
        }
        dump('登录验证失败');
    }
}
