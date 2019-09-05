<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class GoodsController extends Controller
{
    // public function add_goods()
    // {
    //     // dd(storage_path('app\public'));
    //     return view('admin.add_goods');
    // }

    // public function do_add_goods(Request $request)
    // {
    //     // dd($_FILES);
    //     $files=$request->file('goods_pic');
    //     $path='';
    //     if(empty($files)){
    //         echo 'fail';die();
    //     }else{
    //       $path= $files->store('goods');
    //     }
    //     // dd($path);l;pp

    //     echo asset('storage').'/'.$path;
    // }

    public function goodsList(Request $request)
    {
        $redis= new \Redis();
        $redis->connect('127.0.0.1','6379');
        $redis->incr('num');
        $num=$redis->get('num');
        echo '访问次数:'.$num;
        $req=$request->all();
        // dd($req);
        $search="";
        if(!empty($req['search'])){
            $search=$req['search'];
            $info=DB::table('goods')->where('goods_name','like','%'.$req['search'].'%')->paginate(2);
            // dd($info);
        }else{
            $info=DB::table('goods')->paginate(2);
        }
     
        return view('admin.goodsList',['goods'=>$info,'search'=>$search]);
      
    }
  

    public function goods(Request $request)
    {
        $req=$request->session()->put('username','tom');
        if(!session('username')){
            dd('stop');
        }
        return view('admin.goods.goods');
    }

    public function add_goods(){
        return view('admin.add_goods');
    }

     public function do_add_goods(Request $request)
    {
        $validateData=$request->validate([
            'goods_name'=>'required',
            'goods_number'=>'required'
        ],[
            'goods_name.required'=>'商品名字没写',
            'goods_number.required'=>'商品库存没写',
            'goods_price.required'=>'商品价格没写',
            'goods_pic.required'=>'商品没写',

        ]);
        $req=$request->all();
        $req['add_time']=time();
        // dd($data);
        // dd($_FILES);
        $files=$request->file('goods_pic');
        $path='';
        if(empty($files)){
            echo 'fail';die();
        }else{
          $path= $files->store('goods');
          $req['goods_pic']='/'.'storage'.'/'.$path;
        //   dd($req);
        }
        // echo 'storage'.'/'.$path;
   
        // dd($req);
        $result=DB::table('goods')->insert([
            $req
        ]);
        // dd($result);
        $result=true;
        if($result){
           return  redirect('admin/goods');
        }else{
            echo 'fail';
        }

    }

    public function delete(Request $request)
    {
        $req=$request->all();
        $result=DB::table('goods')->where(['id'=>$req['id']])->delete();
        if($result){
            return redirect('admin/goods');
        }
    }

    public function update(Request $request){
        $req=$request->all();
        $info=DB::table('goods')->where(['id'=>$req['id']])->first();
        return view('admin.goodsUpdate',['goods_info'=>$info]);
    }


    public function do_update(Request $request)
    {
       $req=$request->all();
    //    dd($req);
        $result=DB::table('goods')->where(['id'=>$req['id']])->update([
            'goods_name'=>$req['goods_name'],
            'goods_price'=>$req['goods_price'],
            'goods_number'=>$req['goods_number']
        ]);
        // dd($result);
        if($result){
           return  redirect('/admin/goods');
        }else{
            echo 'fail';
        }
    }
}
