<?php
/**
 * [守卫者工具]
 * 用于替换以下 Auth::guard('prince-wap-member') 的写法。该工具已实现门面的使用 LeePrince\LaravelWechatShop\Wap\Member\Facades\Member.php
 *      dump(Auth::guard('prince-wap-member')->check());
 *      Auth::guard('prince-wap-member')->login($user);
 *      dump(Auth::guard('prince-wap-member')->check());
 *
 * @Author  leeprince:2020-07-15 16:03
 */
namespace LeePrince\LaravelWechatShop\Wap\Member\Support;

use Illuminate\Support\Facades\Auth;

class Guard
{
    public static function guard()
    {
        return Auth::guard('prince-wap-member');
    }
    
    /**
     * [魔术方法]
     *
     * @Author  leeprince:2020-07-16 09:09
     * @param $method
     * @param $args
     * @return mixed
     */
    public function __call($method, $args)
    {
        return $this->guard()->$method(...$args);
    }
}