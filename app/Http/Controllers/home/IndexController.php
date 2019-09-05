<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class IndexController extends Controller
{
     /**
     * 前台首页
     */
    public function index()
    {
        
        $data=DB::table('goods')->get();
        // dd($data);
        return view('home.index',['data'=>$data]);
    }
    public function login()
    {
        return view('login');
    }

    
    public function do_login(Request $request)
    {
        
        $req=$request->all();
        $name=$req['name'];
        $password=$req['password'];
        // dd($password);
        $result=DB::table('user')->where(['name'=>$name,'password'=>$password])->first();
        // dd($result);
        if($result){
            if($result->state==3){
                echo "<script>alert('你已经被该网站拉入黑名单！')</script>";
            }else{
                  //将账户密码存入session
                session(['name'=>$name,'password'=>$password]);
                return redirect('/index/index');
            }
            
        }
       
    }


    public function register()
    {
        return view('register');
    }

    public function do_register(Request $request)
    {
        $validateData=$request->validate([
            'name'=>'required',
            'password'=>'required'
        ],[
            'name.required'=>'名字没写',
            'password.required'=>'年龄没写'
        ]);
        $req=$request->all();
        $req['reg_time']=time();
        // dd($req);
        $result=DB::table('user')->insert([
            $req
        ]);
        // dd($result);
        $result=true;
        if($result){
            return redirect('/home/login');
        }else{
            echo 'fail';
        }
    }

    

    public function add_cart(Request $request)
    {
        $id=$request->all()['id'];
        // dd($id);
        $where=[
            ['goods_id','=',$id],
        ];
        $data=DB::table('goods')->where($where)->first();
        unset($data->_token);
        // dd($data);
        $data=get_object_vars($data);
        // dd($data);
        
        $result=DB::table('cart')->insert([
            $data
        ]);
        // dd($result);
       return redirect('home/cartList');
    }

    public function cartList(Request $request)
    {
        $data=DB::table('cart')->get()->toarray();
        $goods_id=array_column($data,'goods_id');
        // dd($goods_id);
        $goods_id=implode(',',$goods_id);
        // dd($goods_id);
        //总价
        $total=[];
        $pricetotal="";
        foreach($data as $k=>$v){
            $v=get_object_vars($v);
            var_dump($v['goods_number']);
            var_dump($v['goods_price']);
            $total[]=$v['goods_number']*$v['goods_price'];
            // echo "<pre>";
            $price=array_sum($total);
            // print_r($price);
            $pricetotal=$price;

        }
        return view('home/cartList',['data'=>$data,'total'=>$pricetotal,'goods_id'=>$goods_id]);
        
        // $data=DB::table('cart')->get()->toarray();
        // dd($data);
        // $goods_id=array_column($data,'goods_id');
        // dd($goods_id);
        // $goods_id=implode(',',$goods_id);
        // dd($goods_id);
        //总价
        // $total=[];
        // $pricetotal="";
        // foreach($data as $k=>$v){
        //     $v=get_object_vars($v);
        //     // var_dump($v['goods_number']);
        //     // var_dump($v['goods_price']);
        //     $total[]=$v['goods_number']*$v['goods_price'];
        //     // echo "<pre>";
        //     $price=array_sum($total);
        //     // print_r($price);
        //     $pricetotal=$price;

        // }
        // dd($pricetotal);
        //------------------------------------------------------------
        // return view('Car_index',['data'=>$data,'total'=>$pricetotal,'goods_id'=>$goods_id]);
    }
}
