<?php

namespace App\MyPackage;

use App\MyContracts\Pay as PayContracts;

/**
 * [实现自定义契约接口]
 *
 * @Author  leeprince:2020-03-07 14:32
 */
class Alipay implements PayContracts
{
    public function transaction()
    {
        return '[自定义契约-实现接口] - transaction';
    }
}