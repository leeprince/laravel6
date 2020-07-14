<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * [composer 组件测试]
 *
 * @Author  leeprince:2020-07-06 19:00
 * @package App\Http\Controllers
 */
class ComposerTestController extends Controller
{
    public function unitFunTest($param1, $param2)
    {
        return '这是 leeprince-unit composer 组件测试使用的方法--参数为：'.$param1.';'.$param2;
    }
}
