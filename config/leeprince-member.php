<?php
/**
 * [Description]
 *
 * @Author  leeprince:2020-07-08 09:31
 */

return [
    'wechat' => [
        'official_account' => [
            'default' => [
                /**
                 * 如果没有在 .env 中配置以下的账号信息，而是在此处定义的话，微信授权登陆是报错的（没有反应）。
                 *      原因是：该组件依赖与 overtrue/laravel-wechat，而 overtrue/laravel-wechat 的服务提供者会比该组件的服务提供者优先被 laravel 加载。
                 *              而在使用 overtrue/laravel-wechat 组件接入微信授权登陆过程
                 */
                'app_id'  => env('WECHAT_OFFICIAL_ACCOUNT_APPID', 'wxd73987a508f44d46'),         // AppID
                'secret'  => env('WECHAT_OFFICIAL_ACCOUNT_SECRET', '9fb594bfd110677286940022fb24c7e2'),    // AppSecret
                'token'   => env('WECHAT_OFFICIAL_ACCOUNT_TOKEN', 'leeprince-your-token'),           // Token
                'aes_key' => env('WECHAT_OFFICIAL_ACCOUNT_AES_KEY', ''),                 // EncodingAESKey
                /*
                 * OAuth 配置
                 *
                 * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
                 * callback：OAuth授权完成后的回调页地址(如果使用中间件，则随便填写。。。)
                 */
                'oauth' => [
                    'scopes'   => array_map('trim', explode(',', env('WECHAT_OFFICIAL_ACCOUNT_OAUTH_SCOPES', 'snsapi_userinfo'))),
                    'callback' => env('WECHAT_OFFICIAL_ACCOUNT_OAUTH_CALLBACK', '/examples/oauth_callback.php'),
                ],
            ],
        ],
    ],
    'auth'   => [
        // 预留
        'controller' => LeePrince\LaravelWechatShop\Wap\Member\Http\Controllers\AuthorizationController::class,
    
        // 当前使用的守卫,只是定义
        'guard'      => 'prince-wap-member',
    
        // 定义的是守卫组
        'guards'     => [
            'prince-wap-member' => [
                'driver'   => 'session',
                'provider' => 'wap-member',
            ]
        ],
        'providers'  => [
            'wap-member' => [
                'driver' => 'eloquent',
                'model'  => LeePrince\LaravelWechatShop\Wap\Member\Models\User::class,
            ]
        ],
    ]
];