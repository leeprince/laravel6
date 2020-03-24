<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index($age = 19)
    {
        return 'hello world: '.$age;
    }

    public function hello(Request $request)
    {
        dump(route('namehello.hello'));
        
        
        dump($request->input());
        
        return 'hello world - hello';
    }

    public function foo()
    {
        // dump(route('hello'));
        // return  redirect()->route('prince');

        return  'hello world - foo';
    }
    public function prince()
    {
        // dump(route('hello'));
        return 'hello world - prince';
    }
    public function prince01()
    {
        // dump(route('hello'));
        return 'hello world - prince01';
    }
}
