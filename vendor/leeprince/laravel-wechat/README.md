## 基于 laravel 开发微信公众号 composer 扩展包(20200322–_20200325)

## 1. 开通微信公众号：订阅号
1. 到[微信公众号开通个人订阅号](https://mp.weixin.qq.com/)，并查看[相关开发文档](https://developers.weixin.qq.com/doc/offiaccount/Basic_Information/Access_Overview.html)，并了解[消息管理中的被动回复用户信息](https://developers.weixin.qq.com/doc/offiaccount/Message_Management/Passive_user_reply_message.html)。

## 2. 实现对接微信公众号功能
1.对接代码
```index.php
$signature = $_GET["signature"];
$timestamp = $_GET["timestamp"];
$nonce     = $_GET["nonce"];
$echostr   = $_GET["echostr"];

$token  = 'leeprinceSubscription';
$tmpArr = array($token, $timestamp, $nonce);
sort($tmpArr, SORT_STRING);
$tmpStr = implode($tmpArr);
$tmpStr = sha1($tmpStr);

if ($tmpStr == $signature) {
    // 微信服务器在验证业务服务器地址的有效性时，包含 echostr 参数，之后微信服务器与业务服务器的交互不再包含此参数。
    if (empty($echostr)) {
        /**
         * 开始处理业务
         */
        return true;
    } else {
        // 若确认此次GET请求来自微信服务器，请原样返回echostr参数内容. 此处只能使用 echo，使用 return 失败。
        echo $echostr;
    }
} else {
    return false;
}
```

2.在 **「微信公众号->开发->基本配置->服务器配置」** 中配置信息，其中服务器地址（URL）要能被外网访问，第一次配置会传入 echostr 参数进行服务器地址的有效校验，之后微信服务器与业务服务器的交互不再包含此参数。可以正确提交即检验成功，之后启动该服务配置。后面可以在「管理->消息管理」中查看用户给公众号发的消息。

> 补充：基于内网开发的可以使用 [ngrok](https://ngrok.com/) 进行内网穿透。ngrok 会分配 http 和 https 的临时链接供你使用的。（mac使用：/Applications/ngrok http 80）其中 「Web Interface」的本地链接 http://127.0.0.1:4040 是 web 页面用于查看 ngrok 转发的信息
```angular2
ngrok by @inconshreveable                                       (Ctrl+C to quit)

Session Status                online
Session Expires               7 hours, 59 minutes
Version                       2.3.35
Region                        United States (us)
Web Interface                 http://127.0.0.1:4040
Forwarding                    http://6a33d7ab.ngrok.io -> http://localhost:80
Forwarding                    https://6a33d7ab.ngrok.io -> http://localhost:80

Connections                   ttl     opn     rt1     rt5     p50     p90
                              0       0       0.00    0.00    0.00    0.00
```


## 3. 构建微信公众号对接功能到 composer 扩展包中

1.在项目（我的本地项目路径是：xxx/www/composer/laravel-wechat 此处为了更好在下文说明）中执行 **composer init**。本地没有 [composer](https://docs.phpcomposer.com/) 的自行去官网下载吧。
```angular2
> composer init
Package name (<vendor>/<name>) [leeprince/laravel-wechat]: 
Description []: This is laravel WeChat composer
Author [leeprince <leeprince@foxmail.com>, n to skip]: 
Minimum Stability []: 
Package Type (e.g. library, project, metapackage, composer-plugin) []: library 
License []: MIT

Define your dependencies.

Would you like to define your dependencies (require) interactively [yes]? 
Search for a package: 
Would you like to define your dev dependencies (require-dev) interactively [yes]? 
Search for a package: 

{
    "name": "leeprince/laravel-wechat",
    "description": "This is laravel WeChat composer",
    "type": "library",
    "license": "MIT",
    "authors": [
        {
            "name": "leeprince",
            "email": "leeprince@foxmail.com"
        }
    ],
    "require": {}
}

Do you confirm generation [yes]? 
Would you like the vendor directory added to your .gitignore [yes]? 

```
2.在 composer.json 文件中添加自动加载配置

```angular2
    "autoload": {
        "psr-4": {
            "LeePrince\\WeChat\\": "./src/"
        }
    }
```


3.执行 **composer update** 更新获取依赖的最新版本

## 4. laravel 项目集成本地基于微信公众号开发 composer 组件包
1.在已经下载好的 laravel 项目（我的本地路径是：xxx/www/laravel69）中配置 composer laravel-wechat 扩展的本地仓库的相对路径或者绝对路径
```angular2
composer config repositories.leeprince path ../composer/laravel-wechat

```
2.增加新的依赖包到当前项目的 ./vendor/ 中
```angular2
composer require leeprince/laravel-wechat:dev-master
``` 
    
## 5. 编写服务提供者，并注册到 laravel 的服务提供者中
这是将该 composer leeprince/laravel-wechat 扩展包集成到 laravel 的第一步
1.在 laravel-wechat 项目的 ./src 路径下 编写服务提供者 WeChatServiceProvider 并继承 laravel 的服务提供者。注意命名空间为：namespace LeePrince\WeChat; 该服务提供者用于加载自定义组件中的所有服务
```
<?php
/**
 * [服务提供者为 laravel 提供该组件的所有服务]
 *
 * @Author  leeprince:2020-03-22 19:05
 */

namespace LeePrince\WeChat;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class WeChatServiceProvider extends ServiceProvider
{
    ...
}
```
2.在 laravel 项目的 ./config/app.php 中注册该 composer 扩展包的服务提供者
```
/**
 * 引入 composer 组件中的服务提供者
 */
// 自定义服务提供者 - 基于微信公众号开发的 composer 组件
LeePrince\WeChat\WeChatServiceProvider::class,
```

## 6. 【核心服务：路由】
1.在 ./src/Route/route.php 中编写路由
```angular2
Router::any('hello', function() {
   dump('hello world');
});
```
2.在服务提供者 WeChatServiceProvider boot() 方法中加载路由
```
/**
 * [引导服务：该方法在所有服务提供者被注册以后才会被调用]
 *
 * @Author  leeprince:2020-03-22 19:55
 */
public function boot()
{
    $this->loadRoutes();
}

/**
 * [加载路由]
 *
 * @Author  leeprince:2020-03-23 00:28
 */
private function loadRoutes()
{
    Route::group(['namespace' => 'LeePrince\WeChat\Http\Controllers', 'prefix' => 'wechat'], function() {
        $this->loadRoutesFrom(__DIR__.'/Route/route.php');
    });
}
```
## 7. 【核心服务：控制器】
1.在 ./src/Http/Controllers/WxSubscriptionController.php.php 中编写控制器。由于上一步已经加载了路由，所以编写的控制器可以立即生效。
```angular2
<?php

namespace LeePrince\WeChat\Http\Controllers;

use Illuminate\Http\Request;

/**
 * [微信公众号 - 订阅号接受微信服务验证、接受微信从订阅号发送过来的信息并自动回复]
 *
 * @Author  leeprince:2020-03-22 20:06
 * @package LeePrince\WeChat\Http\Controllers
 */
class WxSubscriptionController extends Controller
{
    /**
     * [自动回复微信公众号信息]
     *
     * @Author  leeprince:2020-03-24 01:10
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /**
         * 开始处理业务
         */
        $signature = $request->input("signature");
        $timestamp = $request->input("timestamp");
        $nonce     = $request->input("nonce");
        $echostr   = $request->input("echostr");

        $token  = 'leeprinceSubscription';
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        if ($tmpStr == $signature) {
            // 微信服务器在验证业务服务器地址的有效性时，包含 echostr 参数，之后微信服务器与业务服务器的交互不再包含此参数。
            if (empty($echostr)) {
                /**
                 * 开始处理业务
                 */
                
                // 回复信息
                // 接收微信发送的参数
                $postObj =file_get_contents('php://input');
                $postArr = simplexml_load_string($postObj,"SimpleXMLElement",LIBXML_NOCDATA);
                if (empty($postArr)) {
                    return response('XML消息为空！');
                }
                //消息内容
                $content = $postArr->Content;
                //接受者
                $toUserName = $postArr->ToUserName;
                //发送者
                $fromUserName = $postArr->FromUserName;
                //获取时间戳
                $time = time();
                
                //回复消息内容； 补充：想更加只能可以通过接入机器人自动回复。比如图灵机器人：http://www.tuling123.com
                $content = "[PrinceProgramming] - 编程是一门艺术\n欢迎您，您的消息是： $content\n";
                //回复文本消息的格式：把百分号（%）符号替换成一个作为参数进行传递的变量
                $info = sprintf("<xml>
                  <ToUserName><![CDATA[%s]]></ToUserName>
                  <FromUserName><![CDATA[%s]]></FromUserName>
                  <CreateTime>%s</CreateTime>
                  <MsgType><![CDATA[text]]></MsgType>
                  <Content><![CDATA[%s]]></Content>
                </xml>", $fromUserName, $toUserName, $time, $content);
                
                return response($info);
            } else {
                // 若确认此次GET请求来自微信服务器，请原样返回echostr参数内容. 此处只能使用 echo，使用 return 失败。
                echo $echostr;
            }
        } else {
            return response('false');
        }

    }
}
```

## 8.【扩展服务：中间件】

测试通过后继续完善代码提取检测签名部分到中间件中作为请求过滤，这里是用的是路由中间件。需要在 WeChatServiceProvider 服务提供者中加载路由中间件到路由中。
```
<?php
/**
 * [服务提供者为 laravel 提供该组件的所有服务]
 *
 * @Author  leeprince:2020-03-22 19:05
 */

namespace LeePrince\WeChat;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class WeChatServiceProvider extends ServiceProvider
{
    // 中间件组
    private $middlewareGroups = [];
    
    // 路由中间件
    private $routeMiddleware = [
        'wechat.subscription.CheckSignture' => \LeePrince\WeChat\Http\Middleware\CheckSignture::class,
    ];
    
    /**
     * [注册服务：register 方法中，你只需要将服务绑定到服务容器中。而不要尝试在 register 方法中注册任何监听器，路由，或者其他任何功能。否则，你可能会意外地使用到尚未加载的服务提供者提供的服务。]
     *
     * @Author  leeprince:2020-03-22 19:56
     */
    public function register()
    {
       
    }
    
    /**
     * [引导服务：该方法在所有服务提供者被注册以后才会被调用]
     *
     * @Author  leeprince:2020-03-22 19:55
     */
    public function boot()
    {
        $this->syncMiddlewareToRouter();
    }
    
    /**
     * 将中间件的当前状态同步到路由器
     *
     * @return void
     */
    private function syncMiddlewareToRouter()
    {
        foreach ($this->middlewareGroups as $key => $middleware) {
            Route::middlewareGroup($key, $middleware);
            // $this->router->middlewareGroup($key, $middleware);
        }
        
        foreach ($this->routeMiddleware as $key => $middleware) {
            Route::aliasMiddleware($key, $middleware);
        }
    }
}
```
	
## 9.【扩展服务：视图】
1.在 ./src/Resources/views/view.blade.php 中编写视图文件。

```
在 ./src/Resources/ 下的目录结构为

Resources
    js
    lang
    sass
    views
    
view.blade.php 文件
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
    </head>
    <body>
        <div class="content">
            LeePrince
            <br>
            [PrinceProgramming] - 编程是一种艺术
            <hr>
        </div>
    </body>
</html>

```

2.在 WeChatServiceProvider 服务提供者中加载视图文件并设置命名空间
```
<?php
/**
 * [服务提供者为 laravel 提供该组件的所有服务]
 *
 * @Author  leeprince:2020-03-22 19:05
 */

namespace LeePrince\WeChat;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class WeChatServiceProvider extends ServiceProvider
{
    /**
     * [注册服务：register 方法中，你只需要将服务绑定到服务容器中。而不要尝试在 register 方法中注册任何监听器，路由，或者其他任何功能。否则，你可能会意外地使用到尚未加载的服务提供者提供的服务。]
     *
     * @Author  leeprince:2020-03-22 19:56
     */
    public function register()
    {
    
    }
    
    /**
     * [引导服务：该方法在所有服务提供者被注册以后才会被调用]
     *
     * @Author  leeprince:2020-03-22 19:55
     */
    public function boot()
    {
        $this->loadViews();
    }
    /**
     * [加载视图]
     *
     * @Author  leeprince:2020-03-24 01:08
     */
    private function loadViews()
    {
        $this->loadViewsFrom(__DIR__."/Resources/views/", 'wechatview');
    }
}
```


3.在在组件的路由配置文件 ./src/Route/route.php 中注册路由
```
Route::any('welcome',  function() {
    // 注意在 WeChatServerProvider 服务提供者中 loadViewsFrom 方法为视图路径设置的命名空间。
    // 所以此处的写法必须是: 设置的命名空间::视图模版名称(去掉.blade.php)
    return view('wechatview::welcome');
});
```
	
## 10.【扩展服务：配置文件】
1.在 ./src/Config/wechat.php 中编写配置文件
```
<?php

/**
 * leeprince/laravel-wechat composer 组件中的配置文件
 *      是执行命令  php artisan vendor:publish --provider="LeePrince\WeChat\WeChatServiceProvider" 生成的配置文件
 */
return [
    'wechat_template' => [
        // 文本模板
        'text'  => '
            <xml>
              <ToUserName><![CDATA[%s]]></ToUserName>
              <FromUserName><![CDATA[%s]]></FromUserName>
              <CreateTime>%s</CreateTime>
              <MsgType><![CDATA[text]]></MsgType>
              <Content><![CDATA[%s]]></Content>
            </xml>',
        // 图片模板
        'image'  => '
            <xml>
                <ToUserName><![CDATA[%s]]></ToUserName>
                <FromUserName><![CDATA[%s]]></FromUserName>
                <CreateTime>%s</CreateTime>
                <MsgType><![CDATA[image]]></MsgType>
                <Image>
                    <MediaId><![CDATA[%s]]></MediaId>
                </Image>
            </xml>',
        // 图文模板
        'news'  =>[
            'TplHead' => '
                  <xml>
                    <ToUserName><![CDATA[%s]]></ToUserName>
                    <FromUserName><![CDATA[%s]]></FromUserName>
                    <CreateTime>%s</CreateTime>
                    <MsgType><![CDATA[news]]></MsgType>
                    <ArticleCount>%s</ArticleCount>
                    <Articles>',
            'TplBody' => '
                    <item>
                        <Title><![CDATA[%s]]></Title>
                        <Description><![CDATA[%s]]></Description>
                        <PicUrl><![CDATA[%s]]></PicUrl>
                        <Url><![CDATA[%s]]></Url>
                    </item>',
            'TplFoot' => '
                    </Articles>
                  </xml>'
        ],
    ]
];

```
2.在 WeChatServiceProvider 服务提供者中加载配置文件
```
<?php
/**
 * [服务提供者为 laravel 提供该组件的所有服务]
 *
 * @Author  leeprince:2020-03-22 19:05
 */

namespace LeePrince\WeChat;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class WeChatServiceProvider extends ServiceProvider
{
    /**
     * [注册服务：register 方法中，你只需要将服务绑定到服务容器中。而不要尝试在 register 方法中注册任何监听器，路由，或者其他任何功能。否则，你可能会意外地使用到尚未加载的服务提供者提供的服务。]
     *
     * @Author  leeprince:2020-03-22 19:56
     */
    public function register()
    {
        $this->registerConfigFile();
    }
    
    /**
     * [引导服务：该方法在所有服务提供者被注册以后才会被调用]
     *
     * @Author  leeprince:2020-03-22 19:55
     */
    public function boot()
    {

    }
    /**
     * [注册配置文件]
     *
     * @Author  leeprince:2020-03-25 00:43
     */
    private function registerConfigFile()
    {
        // 将给定配置与现有配置合并。
        // 指定的 key = 配置的文件名。即可让配置文件合并到由 $this->publishes([__DIR__ . '/Config' => config_path()], $groups = null); 分配的由文件名组成的同一个组中
        $this->mergeConfigFrom(__DIR__ . "/Config/wechat.php", 'wechat');
    }
}
```

3.在路由中注册一个测试路由，在闭包函数中获取该配置文件
```
Route::any('config',  function() {
    dump(config());
    // dump(config('wechat'));
    // dump(config('wechat.wechat_template'));
    // dump(config('wechat.wechat_template.text'));
});
```

## 11.【扩展服务：外部允许修改配置文件】
1.在服务提供者 WeChatServiceProvider 中添加允许在 laravel 框架的 config 中修改组件的配置文件，而无需到组件的配置文件中修改的方法。
```
<?php
/**
 * [服务提供者为 laravel 提供该组件的所有服务]
 *
 * @Author  leeprince:2020-03-22 19:05
 */

namespace LeePrince\WeChat;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class WeChatServiceProvider extends ServiceProvider
{
    /**
     * [注册服务：register 方法中，你只需要将服务绑定到服务容器中。而不要尝试在 register 方法中注册任何监听器，路由，或者其他任何功能。否则，你可能会意外地使用到尚未加载的服务提供者提供的服务。]
     *
     * @Author  leeprince:2020-03-22 19:56
     */
    public function register()
    {
        $this->registerConfigFilePublishing();
    }
    
    /**
     * [引导服务：该方法在所有服务提供者被注册以后才会被调用]
     *
     * @Author  leeprince:2020-03-22 19:55
     */
    public function boot()
    {
    
    }
    /**
     * [执行 vendor:publish 命令发布配置文件到指令目录，即可以发布配置文件到指定目录，达到允许外部修改配置文件信息的目的]
     *      执行：php artisan vendor:publish --provider="LeePrince\WeChat\WeChatServiceProvider"
     *
     * @Author  leeprince:2020-03-25 00:43
     */
    private function registerConfigFilePublishing()
    {
        // 确定应用程序是否正在控制台中运行。
        if ($this->app->runningInConsole()) {
            // 注册要由 publish 命令发布的路径，可以发布配置文件到指定目录
            $this->publishes([__DIR__ . '/Config' => config_path()], null);
        }
    }
}
```
2.在 laravel 项目的根目录执行命令：**php artisan vendor:publish --provider="LeePrince\WeChat\WeChatServiceProvider"** 即可在 laravel 项目的 ./config/wechat.php 中看到该组件的所有配置信息，并允许修改生效。

## 12.【扩展服务：自定义 Artisan 命令用于创建控制器到组件中】
1.在 ./src/Console/MakeWechatComposerControllerCommand.php 中编写自定义 Artisan 命令
```
<?php
/**
 * [创建控制器的命令]
 *
 * @Author  leeprince:2020-03-25 02:10
 */

namespace LeePrince\WeChat\Console;

use Illuminate\Routing\Console\ControllerMakeCommand;
use Illuminate\Support\Str;

class MakeWechatComposerControllerCommand extends ControllerMakeCommand
{
     // 控制台命令名称。
    protected $name = 'make:wetchatcomposercontroller';
    
    // 控制台命令的描述
    protected $description = '创建 leeprince/laravel-wechat composer 组件包中的控制器';
    
    private $rootNamespace = 'LeePrince\Wechat';
    
    /**
     * 获取该类的根名称空间。
     *
     * @return string
     */
    protected function rootNamespace()
    {
        return $this->rootNamespace;
    }
    
    /**
     * 获取目标类路径。
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        
        return __DIR__.'/../'.str_replace('\\', '/', $name).'.php';
    }
}
```
2.在 WeChatServiceProvider 中注册自定义 Artisan 命令
```
<?php
/**
 * [服务提供者为 laravel 提供该组件的所有服务]
 *
 * @Author  leeprince:2020-03-22 19:05
 */

namespace LeePrince\WeChat;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class WeChatServiceProvider extends ServiceProvider
{
    /**
     * 自定义 Artisan 命令
     *      创建控制器到组件中
     */
    private $commands = [
        Console\MakeWechatComposerControllerCommand::class
    ];
    
    /**
     * [注册服务：register 方法中，你只需要将服务绑定到服务容器中。而不要尝试在 register 方法中注册任何监听器，路由，或者其他任何功能。否则，你可能会意外地使用到尚未加载的服务提供者提供的服务。]
     *
     * @Author  leeprince:2020-03-22 19:56
     */
    public function register()
    {
        $this->registerCommands();
    }
    /**
     * [注册软件包的自定义 Artisan 命令。]
     *
     * @Author  leeprince:2020-03-25 02:07
     */
    private function registerCommands()
    {
        $this->commands($this->commands);
    }
}

```
3. 在 laravel 项目的根目录中执行：**php artisan list** 查看自定义的 Artisan 命令已生效，即可使用该命令创建控制器到组件的 ./src/Http/Controllers/ 中
```
 make
  make:channel                    Create a new channel class
  make:command                    Create a new Artisan command
  make:controller                 Create a new controller class
  make:event                      Create a new event class
  make:exception                  Create a new custom exception class
  make:factory                    Create a new model factory
  make:job                        Create a new job class
  make:listener                   Create a new event listener class
  make:mail                       Create a new email class
  make:middleware                 Create a new middleware class
  make:migration                  Create a new migration file
  make:model                      Create a new Eloquent model class
  make:notification               Create a new notification class
  make:observer                   Create a new observer class
  make:policy                     Create a new policy class
  make:provider                   Create a new service provider class
  make:request                    Create a new form request class
  make:resource                   Create a new resource
  make:rule                       Create a new validation rule
  make:seeder                     Create a new seeder class
  make:test                       Create a new test class
  make:wetchatcomposercontroller  创建 leeprince/laravel-wechat composer 组件包中的控制器

```

## 13. 发布 composer 组件包到 [github](https://github.com/leeprince/laravel-wechat) 作为 composer 的代码仓库

## 14. 在 [packagist](https://packagist.org/packages/leeprince/laravel-wechat) 中提交该组件的 github 项目地址作为 composer 组件包的包仓库

## 15. 在 laravel 项目中删除 composer 的本地仓库，并使用 composer 的远程仓库
1. 在 laravel 项目根目录的 composer.json 文件中删除本地仓库的信息
```
范围1：
    "repositories": {
        "packagist": {
            "type": "composer",
            "url": "https://packagist.phpcomposer.com"
        },
        "leeprince": {
            "type": "path",
            "url": "../composer/laravel-wechat"
        }
    }
删除1：注意删除后结尾处没有 「,」符号
    "leeprince": {
        "type": "path",
        "url": "../composer/laravel-wechat"
    }
范围2：
    "require": {
        "php": "^7.2",
        "doctrine/dbal": "^2.10",
        "fideloper/proxy": "^4.0",
        "laravel/framework": "^6.2",
        "laravel/tinker": "^2.0",
        "leeprince/laravel-wechat": "dev-master"
    },
删除2：注意删除后结尾处没有 「,」符号
    "leeprince/laravel-wechat": "dev-master"
```
2.删除在 laravel 项目 ./vendor/ 目录的 leeprince 扩展包

3.使用 composer 远程仓库增加新的依赖包到当前 laravel 项目的 ./vendor 目录中
```
composer require leeprince/laravel-wechat
```

## 16. 最后查看整个基于 laravel 开发微信公众号 composer 扩展包集成到 laravel 后，在微信公众号运行的效果
![微信公众号](./src/Document/wechat.jpg)


## 使用该基于 laravel 开发微信公众号 composer 扩展包的方法
1. composer require leeprince/laravel-wechat
2. 执行命令  **php artisan vendor:publish --provider="LeePrince\WeChat\WeChatServiceProvider"** 生成配置文件
3. 在 laravel 项目的 ./config/app.php 中注册该  composer 扩展包的服务提供者
```
/**
* 引入 composer 组件中的服务提供者
*/
// 自定义服务提供者 - 基于微信公众号开发的 composer 组件
LeePrince\WeChat\WeChatServiceProvider::class,
```

## github 代码仓库地址
https://github.com/leeprince/laravel-wechat

## packagist composer 包仓库: leeprince/laravel-wechat
https://packagist.org/packages/leeprince/laravel-wechat

## 完善 README.md 的编写