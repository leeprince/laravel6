<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    //
    protected $fillable = ['destination_name'];

    /**
     * [【一对一反向关联】查询目的地对应的最后一个航班：hasOne 方法对应的 belongsTo 方法来定义反向关联]
     *
     * @Author  leeprince:2020-02-19 13:26
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destinationForFlight()
    {
        // 第二个参数：当前表 Destination 与关联表 Flight 的外键；； 第三个参数：关联表 Flight 与当前表 Destination 关联的外键
        return $this->belongsTo(Flight::class, 'last_flight', 'id');
    }

}
