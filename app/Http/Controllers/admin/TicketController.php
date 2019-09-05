<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class TicketController extends Controller
{
    public function add_ticket(){
        return view('ticket.add_ticket');
    }

    public function ticketList(Request $request){
       
        $req=$request->all();
        // dd($req);
      
   
            $redis=new \Redis();
            $redis->connect('127.0.0.1','6379');
            $start_place='';
            $end_place='';
            if(!empty($req['start_place']) || !empty($req['end_place'])){
                //记录搜索次数
                $start_place=$req['start_place'];
                $end_place=$req['end_place'];

            $list=DB::table('ticket')
            ->where('start_place','like',"%{$req['start_place']}%")
            ->where('end_place','like',"%{$req['end_place']}%")
            ->get();
               
                $redis->incr('num');
                $num=$redis->get('num');
                echo '搜索次数:'.$num;
            }else{
                $list=DB::table('ticket')->get();
            }
            // //reids获取访问次数
            // $num=$reids->get('num');
            // //判断访问次数
            // if($num>5){
            //     $redis_info=json_encode($list);
            //     $redis->set('ticket_info',$redis_info,3*60);

            // }
        
            // else{
            //     $list=json_decode($redis->get('ticket_info'),1);
            // }
            //dd($list);
        return view('ticket.ticketList',['data'=>$list,'start_place'=>$start_place,'end_place'=>$end_place]);
    }

    public function do_add_ticket(Request $request){
        $req=$request->all();
        // dd($req);

        $req['add_time']=time();
        unset($req['_token']);
        // dd($req);

        $result=DB::table('ticket')->insert([
            $req
        ]);
        // dd($result);
        $result=true;
        if($result){
            return redirect('admin/ticketList');
        }
    }
}
