<?php

namespace App\Http\Controllers;

use App\Destination;
use App\Flight;
use App\Observers\FlightObserver;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Database\Eloquent\Builder;

class DbController extends Controller
{

    public function read(Faker $faker)
    {
        // 调试：dd、dump
        // $data =  DB::connection('mysqlread')->table('users')->where('id', 1)->dd();

        // $data =  DB::connection('mysqlread')->table('users')->where('id', 1)->get();
        $data = DB::connection('mysqlread')->table('users')->where([['id', '=', '1']])->get();
        // $bool =  DB::connection('mysql')->table('users')->insert([
        //     ['name' => $faker->name, 'email' => $faker->email, 'password' => bcrypt('leeprince')],
        //     ['name' => $faker->name, 'email' => $faker->email, 'password' => bcrypt('leeprince')],
        // ]);

        dd($data);
    }

    public function trans()
    {
        // 自动提交事务
        // $data = DB::transaction(function() {
        //     $bool = DB::table('users')
        //         ->where('id', 1)
        //         ->update(['name' => 'leeprince']);
        //     $bool01 = DB::update("update users set name = :name where id = :id", ['name' => 'leeprince01', 'id' => 2]);
        //     dump($bool, $bool01);
        //
        //     // throw new \ Exception('抛出异常，终止提交');
        // });

        // 手动提交事务
        DB::beginTransaction();
        $bool   = DB::table('users')
            ->where('id', 1)
            ->update(['name' => 'leeprince0101']);
        $bool01 = DB::update("update users set name = :name where id = :id", ['name' => 'leeprince0201', 'id' => 2]);

        dump($bool, $bool01);
        if ($bool || $bool01) {
            dump('手动提交事务');
            DB::rollback();
        }


        DB::commit();
    }

    public function simple()
    {
        // 查询
        // dump(DB::select("select * from users where id = :id", ['id' => 1]));

        // 插入
        // dump(DB::insert("insert into users (name, email, password) values (:name, :email, :password)", [
        //     'name' => 'simpleName0101',
        //     'email' => 'simpleEmail0101',
        //     'password' => bcrypt('leeprince')
        // ]));

        // 更新
        dump(DB::update("update users set name = :name where id = :id", ["name" => "simpleNameUpdate01", "id" => 3]));

    }

    public function select(Faker $faker)
    {
        // 获取所有数据
        // dump($result = DB::table('users')->get());
        // dump(gettype($result));
        // foreach ($result as $row) {
        //     // dump($row);
        //     dump($row->name);
        // }

        // 获取单行
        // dump(DB::table('users')->first());
        // dump(DB::table('users')->where('id', 1)->first());
        // 获取单行: 单列
        // dump(DB::table('users')->value('name'));
        // dump(DB::table('users')->where('id', 1)->value('name'));

        // 获取单列集合
        // dump(DB::table('users')->pluck('name'));
        // // 获取单列: 返回的集合中指定字段的自定义键名，则按照键值对 key->value 方式返回
        // dump($result = DB::table('users')->pluck('name', 'email'));
        // dump(gettype($result));

        // 获取多列
        // dump(DB::table('users')->select(['id', 'name', 'email'])->get());
        // dump(DB::table('users')->get(['id', 'name', 'email']));

        // 聚合: count, max, min, avg, sum
        // dump(DB::table('users')->count());
        // dump(DB::table('users')->max('id'));
        // dump(DB::table('users')->min('id'));
        // dump(DB::table('users')->avg('id'));
        // dump(DB::table('users')->sum('id'));

        // 分块操作
        // DB::table("users" )->orderBy('created_at')->chunk(2, function($data) {
        //     foreach ($data as $user) {
        //         dump('id:'.$user->id.';name:'.$user->name);
        //     }
        // });

        // where: 判断条件只是是否相等的话， 第二个参数的运算符可以省略，其他运算符必填
        // dump(DB::table('users')->where('id', 1)->get());
        // dump(DB::table('users')->where('id', '=', 1)->get());
        // where: 传入数组. 当判断的条件只是是否相等的话传入一维数组，当包含其他运算符的话使用二维数组
        // dump(DB::table('users')->where([
        //     'id' => 5
        // ])->get());
        // dump(DB::table('users')->where([
        //     ['id', '<', '5']
        // ])->get());
        // dump(DB::table('users')->where([
        //     ['id', '<', '5']
        // ])->WhereIn('id', [1, 2, 3])->get());
        // orwhere
        // dump(DB::table('users')->where('id', 1)->orwhere('id', '<', 10)->get());
        // 多条件查询：在 where 中使用必包函数
        // DB::table("users")->where('id', '=', 1)->where(function ($query) {
        //     $query->where('name', '=', 'leeprince0101')
        //         ->orWhere('email', '=', 'jensen25@example.com');
        // })->get();
        // json where: ->, whereJsonContains
        // dump(DB::table('goods')->where('json_data->jk01', 'jv0101')->get());
        // dump(DB::table('goods')->whereJsonContains('json_data->jk01', 'jv0101')->get());
        // dump(DB::table('goods')->whereJsonContains('json_data->jk01', ['jv0101', 'jv0102'])->get());

        // 联合查询
        // dump(DB::table("goods")
        //     ->join('goods_category', 'goods.category_id', '=', 'goods_category.id')
        //     ->select('goods.id', 'goods.good_name')
        //     ->get());
        //     // ->first());
        // // table 使用表别名
        // dump(DB::table("goods", 't1')
        //     ->join('goods_category', 't1.category_id', '=', 'goods_category.id')
        //     ->get());
        // ->first());
        // 高级 join: 多条件 join
        // dump(DB::table("goods")->join('goods_category', function ($query) {
        //     $query->on("goods.category_id", '=', 'goods_category.id')
        //         ->where('goods_category.id', 1);
        // })->get());
        // 左右连接；leftJoin, rightJoin
        // dump(DB::table("goods", 't1')
        //     // ->leftJoin('goods_category', 't1.category_id', '=', 'goods_category.id')
        //     ->rightJoin('goods_category', 't1.category_id', '=', 'goods_category.id')
        //     ->get());
        // ->first());

        // 子连接查询
        // 1
        // $latestCate = DB::table("goods")
        //     ->select('id', DB::raw("MAX(id) as maxid"), 'category_id',  'good_name')
        //     ->where('id', '<', 5)->groupBy('category_id');
        // dump($latestCate);
        // $goods = DB::table("goods_category")->joinSub($latestCate, 'latestCate', function ($join) {
        //     $join->on('goods_category.id', '=', 'latestCate.category_id')
        //         ->where('latestCate.id', '<=', 3);
        // })->get();
        // dump($goods);
        // 2
        // $cateMaxIdQuery = DB::table("goods")
        //     ->select(DB::raw("MAX(id) as maxId",  'good_name'))
        //     ->groupBy('category_id');
        // $cateMaxData = DB::table("goods")->joinSub($cateMaxIdQuery, 'max_query', function ($join) {
        //     $join->on('goods.id', '=', 'max_query.maxId')
        //         ->where('goods.category_id', '<', 5);
        // })->get(); // select * from `goods` inner join (select MAX(id) as maxId from `goods` group by `category_id`) as `max_query` on `goods`.`id` = `max_query`.`maxId` and `goods`.`category_id` < ?
        // dump($cateMaxData);


        // 分组：groupBy/having
        // dump(DB::table('goods')->groupBy('category_id')->get());
        // dump(DB::table('goods')
        //     ->groupBy('category_id')
        //     ->having('id', '>', 1)
        //     ->get());

        // 排序：orderBy
        // dump(DB::table("goods")->orderBy('id', 'desc')->get());
        // dump(DB::table("users")->latest()->get());
        // dump(DB::table("users")->oldest()->get());

        // 限制结果集：skip/take, offset/limit
        // dump(DB::table('users')->skip(5)->take(2)->get());
        // dump(DB::table('users')->offset(5)->limit(2)->get());

        // 添加数据： insert, insertGetId, insertOrIgnore,
        // dump(DB::table('users')->insert([
        //     'name' => 'leepirnceinsert01',
        //     'email' => 'leepirnceinsert01@qq.com',
        //     'password' => bcrypt('leepprince')
        // ]));
        // dump(DB::table('users')->insertGetId([
        //     'name' => 'leepirnceinsert02',
        //     'email' => 'leepirnceinsert02@qq.com',
        //     'password' => bcrypt('leepprince')
        // ]));
        // 批量添加
        // dump(DB::table('users')->insert([
        //     [
        //         'name'     => $faker->name,
        //         'email'    => $faker->email,
        //         'password' => bcrypt('leepprince')
        //     ], [
        //         'name'     => $faker->name,
        //         'email'    => $faker->email,
        //         'password' => bcrypt('leepprince')
        //     ], [
        //         'name'     => $faker->name,
        //         'email'    => $faker->email,
        //         'password' => bcrypt('leepprince')
        //     ],
        //
        // ]));
        // insertOrIgnore 方法用于忽略重复插入记录到数据库的错误
        // dump(DB::table('users')->insertOrIgnore([
        //     'name'     => 'leepirnceinsert0101',
        //     'email'    => 'leepirnceinsert01@qq.com', // 数据库中是唯一索引
        //     'password' => bcrypt('leepprince')
        // ]));

        // 更新：update, updateOrInsertt
        // dump(DB::table('users')->where('id', '=', '10')->update([
        //     'name' => 'leeprinceUpdate01'
        // ]));
        // dump(DB::table('users')->updateOrInsert(
        //     ['name' => 'leepirnceinsert0105'],
        //     ['email' => 'leepirnceinsert0107@qq.com', 'password' => bcrypt('leeprince')]
        // ));
        // 更新： 更新 json 字段
        // dump(DB::table("goods")->where('id', '=', 28)->update([
        //     'json_data->jk01' => 'jv0101'
        // ]));

        // 调试：dd、dump
        $data =  DB::table('users')->where('id', 1)->dd();
    }

    public function redis()
    {
        // 简单操作
        dump(Redis::set('name', 'leeprince'));
        dump(Redis::get('name'));

        // 使用 command 方法将命令传递给服务器
        // dump(Redis::command('set', ['name01', 'leeprince01']));
        // dump(Redis::command('get', ['name01']));

        // 管道命令: 当你需要在一个操作中给服务器发送很多命令时，推荐你使用管道命令
        // $startp = microtime(true);
        // Redis::pipeline(function ($pipe) {
        //     for ($i = 0; $i < 1000; $i++) {
        //         $pipe->set("key:$i", $i);
        //     }
        // });
        // $endp = microtime(true);
        //
        // $startp01 = microtime(true);
        // for ($i = 0; $i <= 1000; $i++) {
        //     Redis::set("key01:$i", $i);
        // }
        // $endp01 = microtime(true);
        // dump($endp-$startp, $endp01-$startp01);
    }

    public function model()
    {
        // 模型操作都是返回一个结果集对象
        // $flights = Flight::all();
        // dump($flights);
        // foreach ($flights as $flight) {
        //     // dump($flight->id, $flight->name, $flight->email);
        //     // var_dump($flight->id, $flight->name, $flight->email);
        //     // echo $flight->id, $flight->name, $flight->email;
        //     echo $flight->id. $flight->name. $flight->email;
        // }
        // 操作集合：转化为数组
        // $flights = Flight::all()->toArray();
        // dump($flights);
        // foreach ($flights as $flight) {
        //     echo $flight['id']. $flight['name']. $flight['email'];
        // }

        // 查询一条纪录
        // dump(Flight::find(1));
        // dump(Flight::first());

        // 附加约束：模型使用查询构造器的方法
        // 查询
        // dump(Flight::where('id', '<', 6)->latest()->limit(1)->get(['name', 'email']));
        // dump(Flight::where([['id', '<', 6]])->get());
        // 高级子查询
        // selects 子查询: select 和 addSelect
        // dump(Destination::addSelect(['last_flight' => Flight::select('name')
        //     ->whereColumn('destination_id', 'destinations.id')
        //     ->orderBy('arrived_at', 'desc')
        //     ->latest()
        //     ->limit(1)
        // ])->get()); //select `destinations`.*, (select `name` from `flights` where `destination_id` = `destinations`.`id` order by `arrived_at` desc, `created_at` desc limit 1) as `last_flight` from `destinations`
        // ordering 子查询：orderByDesc
        //

        // 插入
        // 1：save()：先创建新模型实例，给实例设置属性，然后调用 save 方法;
        $flight = new Flight();
        $flight->name = 'leeprince';
        $flight->email = 'leeprince@foxmail.com';
        dump($flight->save());
        // 2: insert()：查询构造器方法
        // dump(Flight::insert([
        //     ['name' => 'leeprince01', 'email' => 'leeprince01@foxmail.com'],
        //     ['name' => 'leeprince02', 'email' => 'leeprince02@foxmail.com']
        // ]));

        // 更新
        // 先找到模型，然后赋值再调用save() 方法
        // $flight = Flight::find(1);
        // $flight->name = 'New Flight Name';
        // $flight->age = 19;
        // $flight->save();
        // // 批量更新
        // dump(Flight::where('id', '<', 6)->update([
        //     'name'  => 'update_name',
        //     'age'  => 19,
        // ]));
        // 批量赋值: create() 是针对数据表中的多个字段更新; 使用 save() 和 update() 方法则没有白名单/黑名单的功能
        // dump(Flight::where('id', '<', 6)->create([
        //     'name'  => 'create_name',
        //     'age'  => 18,
        // ]));

        // 删除
        // 通过查询删除模型: 模型实例上调用 delete 方法来删除实例
        // dump(Flight::where('age', 100)->delete());
        // // 主键删除
        // dump(Flight::destroy(11));
        // dump(Flight::destroy(9, 10));
        // dump(Flight::destroy([12, 13]));
        // dump(Flight::destroy(collect([7, 8])));
        // 软删除:
        // 如果要开启模型软删除功能，你需要在模型上使用 Illuminate\Database\Eloquent\SoftDeletes trait.
        // 在模型实例上使用 delete 方法， 当前日期时间会写入 deleted_at 字段。同时，查询出来的结果也会自动排除已被软删除的记录。
        // dump(Flight::where('id', 21)->delete());
        // dump(Flight::destroy(22));

        // 查询软删除模型
        // 包括已软删除的模型
        // dump(Flight::withTrashed()
        //     ->where('id', '<=', 20)
        //     ->get());
        // 只检索软删除模型
        // dump(Flight::onlyTrashed()
        //     ->where('id', '<=', 25)
        //     ->get());
        // 恢复软删除模型
        // dump(Flight::withTrashed()
        //     ->where('id', 20)
        //     ->restore());
        // dump(Flight::where('id', 19)
        //     ->restore());
        // dump(Flight::where('name', 'Sadie Abshire')
        //     ->restore());
        // 永久删除
        // dump(Flight::where('id', 19)->forceDelete());
    }

    public function event()
    {
        // dump(Flight::find(20)->delete());

        // dump((Flight::observe(FlightObserver::class)));
        dump(Flight::destroy(22));
    }

    public function relevance()
    {
        // 一对一关联
        // dump($hasOne = Flight::find(1)->flightForDestination); // 结果集默认为对象
        // dump($hasOne->destination_name);
        // dump($hasOne = Flight::find(1)->flightForDestination->toArray()); // 结果集转化为数组
        // dump($hasOne['destination_name']);
        // 一对一反向关联
        // dump(Destination::find(1)->destinationForFlight);
        // dump(Destination::find(1)->destinationForFlight->toArray());

        // 一对多关联
        // dump(Flight::find(1)->getDestination->toArray());
        // 一对多关联 - 约束条件
        // dump(Flight::find(1)->getDestination()->where('id', '>', 2)->get());
        // dump(Flight::find(1)->getDestination()->where('id', '>', 2)->get(['id', 'destination_name']));
        // dump(Flight::find(1)->getDestination()->where('id', '>', 2)->select(['id', 'destination_name'])->get());

        // 多对多关联
        // dump(User::find(1)->getRoles->toArray()); // 结果集转化为数组
        // 多对多关联 - 约束条件
        // dump(User::find(1)->getRoles()->orderBy('id')->get()->toArray());

        // 关联查询
        // dump(Flight::find(1)->getDestination->toArray());
        // dump(Flight::find(1)->getDestination()->where('id', '>', 2)->get()->toArray());
        // dump(Flight::find(1)->getDestination()->where('id', '>', 2)->get(['id', 'destination_name'])->toArray());
        // 在将 orWhere 子句链接到关联时要小心，因为 orWhere 子句将在逻辑上与关联约束处于同一级别。在大多数情况下，你可以使用约束组 在括号中对条件检查进行逻辑分组。
        // dump(Flight::find(1)->getDestination()->where('id', '>', 2)->orWhere('id', '<', 5)->get()->toArray()); // orWhere 子句将在逻辑上与关联约束处于同一级别: "select * from `destinations` where `destinations`.`last_flight` = ? and `destinations`.`last_flight` is not null and `id` > ? or `id` < ?"
        // dump(Flight::find(1)->getDestination()
        //     ->where(function (Builder $query) {
        //         return $query->where('id',  '>', 2)
        //             ->orWhere('id', '<', 5);
        //     })
        //     ->get()->toArray()); // 使用约束组 在括号中对条件检查进行逻辑分组:"select * from `destinations` where `destinations`.`last_flight` = ? and `destinations`.`last_flight` is not null and (`id` > ? or `id` < ?)"


    }

    public function with()
    {
        // 「懒加载」： 当以属性方式访问 Eloquent 关联时，关联数据「懒加载」。这意味着直到第一次访问属性时关联数据才会被真实加载。
        // $flights = Flight::all();
        // // dump(gettype($flights));
        // // "select * from `flights` where `flights`.`deleted_at` is null"
        // foreach($flights as $key => $flight) {
        //     // 循环执行："select * from `destinations` where `destinations`.`last_flight` = ? and `destinations`.`last_flight` is not null limit 1"
        //     dump($flight->flightForDestination);
        // }

        // 「预加载」 - with()： - 不过 Eloquent 能在查询父模型时「预先载入」子关联。预加载可以缓解 N + 1 查询问题。
        // $flights = Flight::with('flightForDestination')->get();
        // // "select * from `flights` where `flights`.`deleted_at` is null"
        // // 一次性执行："select * from `destinations` where `destinations`.`last_flight` in (1, 2, 3, 4, 5, 6, 7, 8, 9, 10)"
        // foreach ($flights as $flight) {
        //     dump($flight->flightForDestination);
        // }
        // 「预加载」 - with()：预加载指定列：指定关联模型的字段(with('动态属性:字段1,字段2'), 并且一定要包含外键ID) -- 指定当前模型的字段：select()、get()
        // $flights = Flight::with('flightForDestination:last_flight,destination_name')->get();
        // $flights = Flight::with('flightForDestination:last_flight,destination_name')->select(['id', 'name'])->get();
        // $flights = Flight::with('flightForDestination:last_flight,destination_name')->get(['id', 'name']);
        // "select * from `flights` where `flights`.`deleted_at` is null"
        // 一次性执行："select * from `destinations` where `destinations`.`last_flight` in (1, 2, 3, 4, 5, 6, 7, 8, 9, 10)"
        // foreach ($flights as $flight) {
        //     dump($flight->flightForDestination->destination_name);
        // }
        // 在模型中设置默认预加载默认预加载
    }

    public function saveOrUpdate()
    {
        // 保存方法
        // $destination = new Destination(['destination_name' => 'prince20200220']);
        // $flight = Flight::find(1);
        // dump($flight->flightForDestination()->save($destination));

        // 新增方法
        // $flight = Flight::find(1);
        // dump($flight->flightForDestination()->create([
        //     'destination_name' => 'prince0231'
        // ]));

        // 更新 belongsTo 关联
        $destination = Destination::find(15);
        $destination->destinationForFlight()->associate($destination);
        dump($destination->save());
    }

    public function attribute()
    {
        // 访问器
        // dump($user = User::find(1));
        // dump($user->email);
        // dump($user = User::find(1)->toArray());
        // dump($user['email']);

        // 修改器
        dump($user = User::find(1));
        $user->name = 'Prince';
        dump($user);
        // dump($user = User::find(1)->toArray());
        // dump($user['email']);
    }
}
