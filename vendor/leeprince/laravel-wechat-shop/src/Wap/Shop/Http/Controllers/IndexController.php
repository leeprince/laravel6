<?php
/**
 * [Description]
 *
 * @Author  leeprince:2020-07-16 11:40
 */

namespace LeePrince\LaravelWechatShop\Wap\Shop\Http\Controllers;


class IndexController  extends Controller
{
    public function index()
    {
        // dump(asset("vendor/leeprince/laravel-shop/css/pre_foot.css"));
        // dump(shop_asset("css/pre_foot.css"));
        return view('WapShopView::index.index');
        // return 'IndexController';
    }
}