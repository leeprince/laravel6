<?php

namespace LeePrince\LaravelWechatShop\Data\Goods\Models;

class Shop extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct( $attributes);
        $this->setTable(config('data.goods.database.prefix').'shop');
    }
}
