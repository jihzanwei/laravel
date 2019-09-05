<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class Order extends Controller
{
    public function order_index(Request $request)
    {
        $data=$request->all();
        // dd($data);
        $goods_id=$data['goods_id'];
        // dd($goods_id);
        $where=[
            ['goods_id','in',$goods_id],
        ];
        // dd($where);
        $goodsInfo=DB::table('goods')->get()->toarray();
        // dd($goodsInfo);
        //总价
        $carInfo=DB::table('cart')->get()->toarray();
        $total=[];
        $pricetotal="";
        foreach($carInfo as $k=>$v){
            $v=get_object_vars($v);
            // var_dump($v['goods_number']);
            // var_dump($v['goods_price']);
            $total[]=$v['goods_number']*$v['goods_price'];
            // echo "<pre>";
            $price=array_sum($total);
            // print_r($price);
            $pricetotal=$price;

        }
        // dd($pricetotal);
        return view('home.order',['goodsInfo'=>$goodsInfo,'total'=>$pricetotal,'goods_id'=>$goods_id]);
    }

    public function order_indexs(Request $request)
    {
        $data=DB::table('order')->get()->toArray();
        // dd($data);
        $time=time();
        // dd(date('Y-m-d H:i:s',$time));
        
        
        return view('order_indexs',['data'=>$data,'now'=>$time]);
    }

    public function create(Request $request)
    {
        $data=$request->all();
        // dd($data);
        //订单号
        $oid=time().rand(1000,9999);
        //订单号唯一
        $where=[
            ['oid','=',$oid],
        ];
        
        $count=DB::table('order')->where($where)->count();
        // dd($count);
        if($count>0){
            echo json_encode(['code'=>2,'msg'=>'订单号已存在']);die;
        }
        //用户id
        $uid=session('uid');
        // dd($uid);
        $arr=[
            'oid'=>$oid,
            'uid'=>$uid,
            'pay_money'=>$data['total'],
            'add_time'=>time(),
            'address_name'=>$data['shopping'][0],
            'address_email'=>$data['shopping'][1],
            'address_tel'=>$data['shopping'][2],
            'pay_id'=>$data['pay'][0],
            'pay_name'=>$data['pay'][1],
            'goods_id'=>$data['good_ids']

            
        ];
        // dd($arr);
        $res=DB::table('order')->insert($arr);
        dd($res);
        if($res){
            echo json_encode(['code'=>1,'msg'=>'添加成功']);
        }else{
            echo json_encode(['code'=>2,'msg'=>'添加失败']);
        }
        
        
    }
}
