<?php
/**
 * [配置]
 *
 * ### 配置说明
 * #### config() & env() 读取配置与生成缓存配置 php artisan config:cache
 *
 * ##### env({key}, {defaultValue})
 *
 * 读取.env文件中的配置信息. 如果通过php artisan config:cache生成缓存配置文件, 再通过env()函数是无法读取到.env的配置信息的, 即当配置缓存文件存在时不能通过 env() 去读取配置文件信息, 只能通过config('config目录下文件名为前缀.配置项').
 *
 * ##### config('config目录下文件名为前缀.配置项')
 *
 * 读取config/文件夹下的.php文件, 当缓存存在时读取缓存(/boostrap/cache/config.php)
 *
 * ##### 建议
 *
 * 所以编写应用程序时，除config/app.php 配置文件或者 composer 包的配置文件, 再其他地方中推荐都通过config('config目录下文件名为前缀.配置项')；去读取配置。config() 方法 laravel 已封装配置信息都在一维数组中通过 . 拼接，以 {config目录下文件名为前缀.配置项.配置项} 形式去访问配置。
 *
 * @Author  leeprince:2020-07-08 09:31
 */

return [
    'wechat' => [
        'official_account' => [
            'default' => [
                /**
                 * 如果没有在 .env 中配置以下的账号信息，而是在此处定义的话，微信授权登陆是报错的（没有反应或者提示登陆失败）。
                 *      原因是：该组件依赖与 overtrue/laravel-wechat，而 overtrue/laravel-wechat 的服务提供者会比该组件的服务提供者优先被 laravel 加载(laravel 的加载方式是根据服务提供者命名空间的首字母排序的A-Z加载的)。
                 *              导致在使用 overtrue/laravel-wechat 组件的接入微信授权登陆中间件时，
                 *              \Overtrue\LaravelWeChat\Middleware\OAuthAuthenticate::class 的 handle 方法通过 $officialAccount = app(\sprintf('wechat.'.$prefix.'.%s', $account));
                 *              解析 EasyWeChat\OfficialAccount\Application 类时，实际上 overtrue/laravel-wechat 的服务提供者中已经通过$this->app->singleton("wechat.{$name}.{$account}", function ($laravelApp) use ($name, $account, $config, $class) { ..}
                 *              将 asyWeChat\OfficialAccount\Application =》 EasyWeChat\Kernel\ServiceContainer 绑定到服务容器中，而当时的 ServiceContainer 构造函数读取配置信息 $config 由于加载服务提供者的顺序问题未能及时将该组件的配置信息合并到项目中以供在绑定 EasyWeChat\OfficialAccount\Application 时读取。
                 *      解决的方法
                 *          方法一：[推荐]在 laravel 项目的 .env 中配置以下账号信息
                 *          方法二：确定组件服务提供者的加载顺序
                 *              - 如果该组件的服务提供者加载顺序比 overtrue/laravel-wechat 服务提供者优先：
                 *                  则注意该组件中服务提供者将配置文件的合并到项目中的方法 $this->loadAuthConfig(); 放入到服务提供者的 register() {...} 方法中，而不是 boot(){...} 方法，因为 laravel 根据顺序将所有服务提供者的 register 方法执行完后再根据顺序执行所有的服务提供者的 boot 方法。
                 *                  # 注：$this->registerConfigFile()方法也是将配置文件的合并到项目中，但是并不符合 overtrue/laravel-wechat 组件提供的接入微信授权登陆中间件的读取格式。
                 * 、            - 如果 overtrue/laravel-wechat 服务提供者比该组件的服务提供者加载顺序优先：
                 *                  则[！！只是作为思路，不能作为线上使用！！]可以通过调整 laravel 项目中的 /bootstrap/cache/packages.php 中的已缓存要加载的服务提供者顺序，然后根据上面的情况进行修改。
                 *          方法三：在该组件的服务提供者中的boot 方法中重新绑定 EasyWeChat\OfficialAccount\Application 类到服务容器中，
                 *                  根据 overtrue/laravel-wechat 的服务提供者中 $this->app->singleton("wechat.{$name}.{$account}", function ($laravelApp) use ($name, $account, $config, $class) { ..} 进行修改，以下是修改的结果：
                 *                  ```
                 *                  $this->app->singleton("wechat.official_account.default", function ($laravelApp) {
                 *                      $app = new OfficialAccount(array_merge(config('wechat.official_account.default', []), config('wechat.official_account')));
                 *                      if (config('wechat.defaults.use_laravel_cache')) {
                 *                          $app['cache'] = $laravelApp['cache.store'];
                 *                      }
                 *                      $app['request'] = $laravelApp['request'];
                 *                      return $app;
                 *                  });
                 *                  ```
                 */
                'app_id' => env('WECHAT_OFFICIAL_ACCOUNT_APPID', 'wxd73987a508f44d46'),         // AppID
                'secret' => env('WECHAT_OFFICIAL_ACCOUNT_SECRET', '9fb594bfd110677286940022fb24c7e2'),    // AppSecret
                'token' => env('WECHAT_OFFICIAL_ACCOUNT_TOKEN', 'leeprince-your-token'),           // Token
                'aes_key' => env('WECHAT_OFFICIAL_ACCOUNT_AES_KEY', ''),                 // EncodingAESKey
                /*
                 * OAuth 配置
                 *
                 * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
                 * callback：OAuth授权完成后的回调页地址(如果使用中间件，则随便填写。。。)
                 */
                'oauth' => [
                    'scopes' => array_map('trim', explode(',', env('WECHAT_OFFICIAL_ACCOUNT_OAUTH_SCOPES', 'snsapi_userinfo'))),
                    'callback' => env('WECHAT_OFFICIAL_ACCOUNT_OAUTH_CALLBACK', '/examples/oauth_callback.php'),
                ],
            ],
        ],
    ],
    'auth' => [
        // 预留
        'controller' => LeePrince\LaravelWechatShop\Wap\Member\Http\Controllers\AuthorizationController::class,

        // 当前使用的守卫,只是定义
        'guard' => 'prince-wap-member',

        // 定义的是守卫组
        'guards' => [
            'prince-wap-member' => [
                'driver' => 'session',
                'provider' => 'wap-member',
            ]
        ],
        'providers' => [
            'wap-member' => [
                'driver' => 'eloquent',
                'model' => LeePrince\LaravelWechatShop\Wap\Member\Models\User::class,
            ]
        ],
    ]
];