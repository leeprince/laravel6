<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelloController extends Controller
{
    /**
     * [Description]
     *
     * @Author  leeprince:2020-01-04 15:15
     * @return string
     */
    public function foo()
    {
        return 'hello world';
    }
}
