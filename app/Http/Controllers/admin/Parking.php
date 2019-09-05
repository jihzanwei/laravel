<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class Parking extends Controller
{
    public function login(){
        return view('admin/parking/login');
    }
    public function do_login(Request $request){
        $req=$request->all();
        // dd($req);
        $name=$req['name'];
        $password=$req['password'];
        $data=DB::table('user')->where(['name'=>$name,'password'=>$password])->first();
        // dd($data);
        if($data!==null){
            echo '成功';
            session(['name'=>$name,'password'=>$password]);
            return redirect('admin/parking/index');
        }else{
            echo 'fail';
        }
    }
    

    /**
     * 添加门卫
     */
    public function add_doorkeeper(){
        return view('admin/parking/add_doorkeeper');
    }
    /**
     * 执行门卫添加
     */
    public function do_add_doorkeeper(Request $request){
        $req=$request->all();
        unset($req['_token']);
        $req['add_time']=time();
        // dd($req);
        $result=DB::table('doorkeeper')->insert([
            $req
        ]);
        // dd($result);
        if($result==true){
            echo 'Ok';
        }else{
            echo 'fail';
        }
    
    }

    public function add_cartnumber(){
        return view('admin/parking/add_cartnumber');
    }

    public function do_add_cartnumber(Request $request){
        $req=$request->all();
        unset($req['_token']);
        $req['add_time']=time();

        // dd($req);
        $result=DB::table('parking_cartnumber')->insert([
            $req
        ]);
        // dd($result);
        if($result==true){
            echo '添加车位数量成功';
        }else{
            echo '操作失败';
        }
    }
    public function doorkeeperlogin(Request $request){
        return view('admin/parking/doorkeeperlogin');
    }
    public function do_doorkeeperlogin(Request $request){
        $req=$request->all();
        // dd($req);
        $name=$req['doorkeeper_name'];
        $count=DB::table('doorkeeper')->where(['doorkeeper_name'=>$name])->count();
        if($count>0){
            return redirect('parking/door_index');
        }else{
            echo '登录失败';
        }
        // dd($count);
    }

    public function index(){
        // $info=DB::table('student')->select(DB::raw('count(*) as num,name'))->groupBy('name')->get()->toArray();
        //根据groupBy('age')查出每个age的总数
        // $info=DB::table('student')->orderBy('id','desc')->orwhere(['sex'=>'男'])->whereIn('id',[32,22,12,19,21])->get()->toArray();
        // $info=DB::table('student')->leftJoin('class','student.class_id','=','class.class_id')->get()->toArray();
        // dd($info);
        //打印日志语句
        // DB::connection('mysql_shop')->enableQueryLog($info);
        //查看这个表里的数据
        // $info=DB::connection('mysql_shop')->table('db')->where('db','like','%test%')->get()->toArray();
        // dd($info);
        // $sql=DB::connection('mysql_shop')->getQueryLog();
        // var_dump($sql);
        return view('admin/parking/index');

    }

    public function door_index(){
        $data=DB::table('parking_cartnumber')->first();
        $number=$data->number;
        // dd($number);
        // dd($data);
        return view('admin/parking/door_index',['number'=>$number]);
    }
    public function entry()
    {
        return view('admin/parking/entry');
    }

    public function do_entry(Request $request)
    {
       $data=$request->all();
       
        $result=DB::table('parking')->insert([
            'cart_num'=>$data['cart'],'state'=>1,'add_time'=>time(),'price'=>0,'del_time'=>0
        ]);
            // dd($result);
        if($result=true){
            
            echo json_encode(['status'=>1,'content'=>'添加成功']);
        }else{
            echo json_encode(['status'=>0,'content'=>'添加失败']);
        }
    }
}
