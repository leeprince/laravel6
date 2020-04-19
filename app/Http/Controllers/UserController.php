<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        // 设置中间件全局应用于控制器方法
        // $this->middleware('auth');

        // except 设置中间件应用于控制器的方法 白名单
        // $this->middleware('log')->only('index');

        // except 设置中间件排除控制器的方法 黑名单
        // $this->middleware('subscribed')->except('store');

        // $this->middleware(function ($request, $next) {
        //     // 这是前置中间件
        //     // dump('这是我的业务1');
        //     // dump('这是我的业务2');
        //     // return $next($request);
        //
        //     // 这是后置中间件
        //     // $response = $next($request);
        //     // dump('这是后置处理的业务');
        //     // return $response;
        // });
    }

    public function index()
    {
        parent::compose();
        return 'hello world-UserController@index';
    }

    public function requestAge(Request $request, $age)
    {
        dump('我正在处理业务01:' . $request->dd);
        dump('我正在处理业务02:' . $request->query('dd'));
        dump('我正在处理业务02:' . $request->query('dd01', 103));
        dump('我正在处理业务02:' . $request->input('dd'));
        dump('我正在处理业务02:' . $request->input('dd01', 102));
        return '中间件 - 前置&后置中间件: ' . $age;
    }

    public function show($id)
    {
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }

    public function store(Request $request, $id, $where = 'default')
    {
        // 通过辅助函数获取请求参数
        // dump(request());

        // 通过服务容器的依赖注入获取请求参数
        // dump($request);
        // dump($request->cookie());
        // dump($request->cookie('laravel_session'));
        // dump($request->get('name'));
        // dump($request->post('email'));

        // 路由参数
        dump($id, $where);

        // 不针对请求类型
        dump('$request->input()', $request->input());
        dump('$request->all()', $request->all());
        // dump($request->only('email'));
        // dump($request->only(['email', 'password']));
        dump($request->all(['email', 'password']));

        // 地址
        dump($request->path());
        dump($request->getPathInfo());
        dump($request->url());
        dump('getUri', $request->getUri());

        // 获取查询的字符串
        dump('$request->fullUrl()', $request->fullUrl());
        dump($request->method());

        // 判断是否存在结果值
        // 判断一个值在请求中是否存在
        dump('$request->has()', $request->has('name01'));
        // 判断一个值在请求中是否存在，并且不为空
        dump($request->filled('name'));

        // is 验证
        // 验证请求路径
        dump($request->is('stores/*/where'));
        // 验证请求方法
        dump($request->isMethod('post'));

        // 获取部分数据
        // 获取请求部分数据即指定的所有键名
        dump($request->only(['name', 'email']));
        // 获取请求部分数据除指定的键名之外
        dump($request->except(['name']));
    }


    public function wi(Request $request)
    {
        // 闪存数据
        // 闪存所有数据
        dump($request->flash());
        // dump(old('name'));
        // 闪存指定的数据 - 白名单
        $request->flashOnly(['name']);
        // 闪存除指定键值外的数据 - 黑名单
        $request->flashExcept(['name']);

        // 重定向并设置session闪存数据
        // return redirect('old')->withInput();
        // return redirect('old')->withInput(
        //     ['age' => 18]
        // );

        // 重定向到路由
        // return redirect()->route('old');

        // 重定向到控制器
        // return redirect()->action('UserController@old');
        return redirect()->action('UserController@old',
            ['name01' => 'name001', 'age01' => 'age01']
        );
    }

    public function old(Request $request)
    {
        dump($request->all());
        dump(old('name'));
        dump(old('age'));
    }

    public function profile(Request $request, $id, $where =  'default')
    {
        dump($request->all());
        dump($request->input());
        return 'UserController@profiel. id:'.$id.';where:'.$where;
    }
}
