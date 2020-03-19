<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ViewController extends Controller
{
    //
    public function index()
    {
        // 检查视图文件是否存在
        if (View::exists('greetting')) {
            dump('视图以判断存在');
        } else {
            dump('视图判断不存在');
        }

        // 所有视图共享数据
        return view('greetting', ['name' => 'leeprince', 'type' => 3, 'users' => [
            ['name' => 'prince01'],
            ['name' => 'prince02'],
            ['name' => 'prince03'],
        ], 'userelse' => []])->with(['flashName' => '闪存名字']);
        // 嵌套视图
        // return view('viewdir.greetting', ['name' => 'leeprince']);
    }

    public function master()
    {
        return view('layouts/master');
        // return View::make('layouts.master');
    }

    public function child()
    {
        return view('child');
    }

    public function component()
    {
        return view('component');
    }
}
