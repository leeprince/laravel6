<?php
/**
 * [Description]
 *
 * @Author  leeprince:2020-07-16 15:34
 */


if (! function_exists('shop_asset')) {
    /**
     * [简写静态资源加载路径]
     *
     * @Author  leeprince:2020-07-16 15:36
     * @param $path
     * @return mixed
     */
    function shop_asset($path)
    {
        $path = '/vendor/leeprince/laravel-wechat-shop/'.$path;
        return asset($path);
    }
}