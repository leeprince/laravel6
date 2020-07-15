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
                'app_id'  => env('WECHAT_OFFICIAL_ACCOUNT_APPID', 'shineyork-your-app-id'),         // AppID
                'secret'  => env('WECHAT_OFFICIAL_ACCOUNT_SECRET', 'shineyork-your-app-secret'),    // AppSecret
                'token'   => env('WECHAT_OFFICIAL_ACCOUNT_TOKEN', 'shineyork-your-token'),           // Token
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