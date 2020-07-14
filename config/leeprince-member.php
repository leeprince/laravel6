<?php
/**
 * [Description]
 *
 * @Author  leeprince:2020-07-08 09:31
 */

return [
    'auth' => [
        // 预留
        'controller' => LeePrince\LaravelWechatShop\Wap\Member\Http\Controllers\AuthorizationController::class,

        // 当前使用的守卫,只是定义
        'guard'      => 'member',

        // 定义的是守卫组
        'guards' => [
            'member' => [
                'driver' => 'session',
                'provider' => 'member',
            ]
        ],
        'providers'  => [
            'member' => [
                'driver' => 'eloquent',
                'model'  => LeePrince\LaravelWechatShop\Wap\Member\Models\User::class,
            ]
        ],
    ]
];