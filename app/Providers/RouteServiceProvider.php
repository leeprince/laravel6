<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //
        Route::pattern('id', '[0-9]+');

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
        // 自定义路由
        $this->mapControllerRoutes();
        $this->mapRouterNamespaceRoutes();
        $this->mapViewRoutes();
        $this->mapDbRoutes();
        $this->mapCookiesRoutes();
        $this->mapValideteRoutes();
        $this->mapErrorLogRoutes();
        $this->mapCodeRoutes();
        $this->mapQueueRoutes();
        $this->mapSwooleRoutes();

        // composer 包路由
        $this->mapComposerRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    /**
     * 自定义路由 - start
     */

    /**
     * [控制器的路由配置文件]
     *
     * @Author  leeprince:2020-02-29 15:12
     */
    protected function mapControllerRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/controller.php'));
    }

    /**
     * [Description]
     *
     * @Author  leeprince:2020-02-29 15:03
     */
    protected function mapRouterNamespaceRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace.'\RouterNamespace')
            ->group(base_path('routes/namespace.php'));
    }

    /**
     * [视图的路由配置文件]
     *
     * @Author  leeprince:2020-02-29 15:02
     */
    protected function mapViewRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/view.php'));
    }

    /**
     * [数据库操作的路由配置文件]
     *
     * @Author  leeprince:2020-02-29 15:02
     */
    protected function mapDbRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/db.php'));
    }

    /**
     * [coocies 及 session 路由的配置文件]
     *
     * @Author  leeprince:2020-02-29 15:01
     */
    protected function mapCookiesRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/cookies.php'));
    }

    /**
     * [验证器路由的配置文件]
     *
     * @Author  leeprince:2020-02-29 15:01
     */
    protected function mapValideteRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/validate.php'));
    }

    /**
     * [错误及日志路由配置文件]
     *
     * @Author  leeprince:2020-02-29 15:00
     */
    protected function mapErrorLogRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/error_log.php'));
    }

    /**
     * [源码分析路由配置文件]
     *
     * @Author  leeprince:2020-02-29 15:00
     */
    protected function mapCodeRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/code.php'));
    }

    /**
     * [队列路由配置文件]
     *
     * @Author  leeprince:2020-02-29 15:00
     */
    protected function mapQueueRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/queue.php'));
    }

    /**
     * [队列路由配置文件]
     *
     * @Author  leeprince:2020-02-29 15:00
     */
    protected function mapSwooleRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/swoole.php'));
    }


    /**
     * 自定义路由 - end
     */
    
    /**
     * [composer 包的路由配置文件]
     *
     * @Author  leeprince:2020-02-29 15:00
     */
    protected function mapComposerRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/composer.php'));
    }
}
