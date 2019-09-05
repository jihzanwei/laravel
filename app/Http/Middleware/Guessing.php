<?php

namespace App\Http\Middleware;

use Closure;
use DB;
class Guessing
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
        $id=$request->all()['id'];
        // dd($id);
        $data=DB::table('tournament')->where(['id'=>$id])->first();
        $id=$data->id;
        // dd($id)
        // dd($data);
        $guess_time=$data->guess_time;
        // dd($guess_time);
        $now=time();
        if($now>$guess_time){
             echo "<script>alert('竞猜时间已过')</script>";
            
            return redirect('admin/tournament/result');
        }
        // dd($now);
        return $next($request);
    }
}
