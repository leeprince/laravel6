<?php
/**
 * [Description]
 *
 * @Author  leeprince:2020-02-29 23:40
 */

namespace App\MyFacade;

use Illuminate\Support\Facades\Facade;

class Index extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        // 在应用程序的服务容器中可用的类；需要通过服务提供者注册到容器
        return 'index';
    }
}