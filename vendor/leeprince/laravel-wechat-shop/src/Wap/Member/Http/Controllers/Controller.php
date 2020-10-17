<?php
/**
 * [Description]
 *
 * @Author  leeprince:2020-07-08 12:53
 */
namespace LeePrince\LaravelWechatShop\Wap\Member\Http\Controllers;

use App\Http\Controllers\Photo\Admin2Controller;
use App\Http\Controllers\Photo\AdminController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
