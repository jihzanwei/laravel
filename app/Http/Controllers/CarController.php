<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class CarController extends Controller
{
    public function index()
    {
        $data=DB::table('cart')->get()->toarray();
        // dd($data);
        $goods_id=array_column($data,'goods_id');
        // dd($goods_id);
        $goods_id=implode(',',$goods_id);
        // dd($goods_id);
        //总价
        $total=[];
        $pricetotal="";
        foreach($data as $k=>$v){
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
        //------------------------------------------------------------
        return view('Car_index',['data'=>$data,'total'=>$pricetotal,'goods_id'=>$goods_id]);
    }
    
    public function create(Request $request)
    {
        $id=$request->all()['id'];
        // dd($id);
        $where=[
            ['id','=',$id],
        ];
        // dd($where);
        $data=DB::table('goods')->where($where)->first();
        // dd($data);
        $data=get_object_vars($data);
        // dd($data);
        $w=[
            ['goods_id','=',$data['id']],
        ];
        $uid=session('id');
        // dd($uid);
        $arr=[
            'uid'=>$uid,
            'goods_id'=>$data['id'],
            'goods_name'=>$data['goods_name'],
            'goods_pic'=>$data['goods_pic'],
            'goods_price'=>$data['goods_price'],
            'add_time'=>$data['add_time'],
            'goods_number'=>$data['goods_number'],
        ];
        // $result=DB::table('cart')->insert([
        //     $arr
        // ]);
        // dd($result);
        // dd($arr);
        $wheres=[
            ['goods_id','=',$id],
        ];
        // dd($goods_number);
        $goods_number=$data['goods_number']+1;
        // dd($wheres);
        $count=DB::table('cart')->where($wheres)->count();
        // DB::enableQueryLog();
        // dd($count);
        if($count>0){
            $res=DB::table('cart')->where($w)->increment('goods_number');
            echo json_encode(['code'=>1,'msg'=>'增加购买数量']);die;
            // print_r(DB::getQueryLog());die;
            // dd($res);
        }else{
            // echo 222;die;
            $res=DB::table('cart')->insert($arr);
            // echo $res;
            // dd($res);
        }
        
        if($res){
            echo json_encode(['code'=>1,'msg'=>'加入购物车成功']);die;
        }else{
            echo json_encode(['code'=>2,'msg'=>'加入购物车失败']);die;  
        }
        
        
    }   
}
