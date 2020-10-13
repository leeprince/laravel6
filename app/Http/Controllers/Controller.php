<?php

namespace App\Http\Controllers;

use App\Http\Controllers\RouterNamespace\Admin2Controller;
use App\Http\Controllers\RouterNamespace\AdminController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * [继承基类的公用方法]
     *
     * @Author  leeprince:2020-01-29 22:57
     */
    public function compose()
    {
        // 可优化下方法: 使用依赖注入。
        dump((new AdminController())->index());
        dump((new Admin2Controller())->index());
    }
}
