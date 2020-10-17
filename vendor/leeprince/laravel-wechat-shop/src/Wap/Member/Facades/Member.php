<?php
/**
 * [守卫者工具的门面类]
 *
 * @Author  leeprince:2020-07-15 16:09
 */

namespace LeePrince\LaravelWechatShop\Wap\Member\Facades;

use Illuminate\Support\Facades\Facade;

class Member extends Facade
{
    protected static function getFacadeAccessor()
    {
        // 注意命名空间最前面含有 \
        return \LeePrince\LaravelWechatShop\Wap\Member\Support\Guard::class;
    }
}