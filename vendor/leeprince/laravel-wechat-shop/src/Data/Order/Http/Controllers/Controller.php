<?php
namespace LeePrince\LaravelWechatShop\Data\Order\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use LeePrince\LaravelWechatShop\Data\Goods\Logic\GoodsLogic;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        (new GoodsLogic())->index();
    }
}
