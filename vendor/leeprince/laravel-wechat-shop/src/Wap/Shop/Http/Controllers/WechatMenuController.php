<?php
/**
 * [Description]
 *
 * @Author  leeprince:2020-07-09 01:16
 */

namespace LeePrince\LaravelWechatShop\Wap\Shop\Http\Controllers;

class WechatMenuController extends Controller
{
    /**
     * [发布微信公众号菜单栏]
     *
     * @Author  leeprince:2020-07-16 11:12
     * @return mixed
     */
    public function menu()
    {
        $buttons = [
            [
                "type" => "view",
                "name" => "laravel 商城",
                "url"  => "http://e6yn87.natappfree.cc/LaravelWechatShopWapShop"
            ],
            [
                "name"       => "菜单",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "搜索",
                        "url"  => "http://www.soso.com/"
                    ],
                    [
                        "type" => "view",
                        "name" => "视频",
                        "url"  => "http://v.qq.com/"
                    ],
                    [
                        "type" => "click",
                        "name" => "赞一下我们",
                        "key" => "V1001_GOOD"
                    ],
                    [
                        "type" => "view",
                        "name" => "微信授权登陆",
                        "url" => "http://e6yn87.natappfree.cc/LaravelWechatShopWapMember/wechatLogin"
                    ],
                ],
            ],
        ];
        return  app('wechat.official_account')->menu->create($buttons);
    }
}