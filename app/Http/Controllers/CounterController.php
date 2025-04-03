<?php
//演示vue怎么远程访问api
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache; // 引入 Cache

class CounterController extends Controller
{
    public function getCount()
    {
        $count = Cache::get('count', 0);
        return response()->json(['count' => $count]);
    }

    public function incrementCount()
    {
        $count = Cache::get('count', 0);
        $count++;
        Cache::put('count', $count);
        //延时1秒
        sleep(2);
        return response()->json(['count' => $count]);
    }
}
