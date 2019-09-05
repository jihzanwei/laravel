<?php

namespace App\Http\Middleware;

use Closure;

class GoodsUpdate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
    //     $time = time();
    //     //dd($time);
    //    $a = strtotime('9:00:00');
    // //    dd($a);
    //     $b = strtotime('17:00:00');
    //     // dd($b);
    //     if($time< $a){
    //         echo "该页面九点后可进入";die;
    //     }else if($time> $b){
    //         echo "该页面五点前可进入";die;
    //     }
    $start=strtotime('9:00:00');
    $end=strtotime('22:00:00');
    $now=time();
    if($now>$start && $now<$end){
        //通过，什么操作都没有
    }else{
        // die();
        // dd('该时间停止营业');
        echo  '<script>alert("宝贝，该时间已经停止营业！")</script>';
  
        die();
    }
        return $next($request);
    }
}
