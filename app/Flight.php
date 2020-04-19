<?php

namespace App;

use App\Events\FlightDeleted;
use App\Events\FlightSaved;
use App\Observers\FlightObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Flight extends Model
{
    //如果要开启模型软删除功能，你需要在模型上使用 Illuminate\Database\Eloquent\SoftDeletes trait
    use SoftDeletes;

    /**
     * 自定义存储时间戳的字段名
     */
    // const CREATED_AT = 'create_time';
    // const UPDATED_AT = 'update_time';

    /**
     * 与模型关联的表名
     */
    protected $table = 'flights';

    /**
     * 默认主键：id. $primaryKey 重定义主键
     */
    protected $primaryKey = 'id';


    /**
     * 模型的连接名称: 数据库连接
     */
    protected $connection = 'mysql';

    /**
     *
     * 自动递增主键ID的类型默认是整数
     */
    protected $keyType = 'int';

    protected $attributes = [
        // 'status' => 1
    ];

    /**
     * 模型日期列的存储格式。
     *
     * @var string
     */
    // protected $dateFormat = 'U';
    protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * 定义模型主键是否递增
     */
    public  $incrementing = false;

    /**
     * 定义是否自动维护时间戳：create_at, update_at
     */
    public $timestamps = true;

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    // protected $fillable = ['name', 'age'];

    /**
     * 不可批量赋值的属性。
     *
     * @var array
     */
    // protected $guarded = ['age'];

    /**
     * # 事件
     * ## 模型的事件映射
     * 1.
     *  创建监听器
     *      php artisan make:event FlightSaved
     *      php artisan make:event FlightDeleted
     *  在事件构造函数中模型注入:
     *      public function __construct(Flight $flight)
     *      {
     *        $this->flight = $flight;
     *      }
     *
     * 2.
     *  创建监听器类：php artisan make:listener FlightEventSubscriber
     *  创建监听方法：onFlightDeleted、onFlightSaved
     *  事件订阅者 - 编写事件订阅者
     *      public function subscribe($events)
     *      {
     *          $events->listen(
     *              FlightDeleted::class,
     *              FlightEventSubscriber::class.'@onFlightDeleted'
     *          );
     *          $events->listen(
     *              FlightSaved::class,
     *              FlightEventSubscriber::class.'@onFlightSaved'
     *          );
     *      }
     * 3.
     *  事件服务者 - 注册事件订阅者
     *      App\Provider\EventServiceProvider.php
     *          protected $subscribe = [
     *              'App\Listeners\FlightEventSubscriber',
     *          ];
     * ## 使用闭包
     *     你可以注册在触发各种模型事件时执行的闭包，而不使用自定义事件类。 
     *     
     * ## 观察者【推荐】
     * 1.
     *      创建观察者类：php artisan make:observer UserObserver --model=User
     *          编写观察者的事件方法：默认已经有一些
     * 2.
     *      在你希望观察的模型上使用 observe 方法注册观察者。也可以在服务提供者的 boot 方法注册观察者。
     *          - 在你希望观察的模型上使用 observe 方法注册观察者:
     *                      Flight::observe(FlightObserver::class;
     *                      dump(Flight::destroy(22));
     *          - 在EventServiceProvider服务提供者的 boot 方法注册观察者: Flight::observe(FlightObserver::class);
     *
     * @var array
     */
    // protected $dispatchesEvents = [
    //     'saved' => FlightSaved::class,
    //     'deleted' => FlightDeleted::class,
    // ];

    /**
     * 默认加载的关联。
     *
     * @var array
     */
    protected $with = ['flightForDestination'];

    /**
     * [【一对一关联】获得此航班的到达目的地的最后一趟航班: hasOne]
     *
     * @Author  leeprince:2020-02-19 13:02
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function flightForDestination()
    {
        // 第二个参数：关联表 Destination 与当前表Flight 关联的外键；； 第三个参数：当前表Flight 与关联表 Destination 关联的外键
        return $this->hasOne(Destination::class,'last_flight', 'id');
    }

    /**
     * [【一对多关联】]
     *
     * @Author  leeprince:2020-02-19 13:37
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getDestination()
    {
        return $this->hasMany(Destination::class, "last_flight" , "id");
    }
}
