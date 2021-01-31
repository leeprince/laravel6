<?php

namespace LeePrince\LaravelWechatShop\Data\Goods\Models;
use ShineYork\LaravelExtend\Database\Eloquent\SEvents;

use Illuminate\Database\Eloquent\Model as  laravelModel;

class Model extends laravelModel
{
    use SEvents;

    public function __construct(array $attributes = [])
    {
        $this->setConnection(config('data.goods.database.connection.name'));

        parent::__construct($attributes);
    }
}
