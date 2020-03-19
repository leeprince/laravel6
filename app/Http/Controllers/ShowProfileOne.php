<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowProfileOne extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        //
        return '我是单一控制器:'.$id;
    }
}
