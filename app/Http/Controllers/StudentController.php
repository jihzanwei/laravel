<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class StudentController extends Controller
{
    
    public function login()
    {
        return view('login');
    }

    public function do_login(Request $request)
    {
        $req=$request->all();
        $request->session()->put('username','name123');
        // echo '登陆成功';
        return redirect('student/index');
    }
    public function index(Request $request)
    {    
        // $info=DB::table('student')->select(DB::raw('count(*) as num,age'))->groupBy('age')->get()->toArray();
        // $info=DB::table('student')->orderBy('id','desc')->orwhere(['sex'=>'男'])->whereIn('id',[22,12])->get()->toArray();
        // $info=DB::table('student')->leftJoin('class','student.class_id','=','class.class_id')->get()->toArray();
        // dd($info);
        //打印日志语句
        // DB::connection('mysql_shop')->enableQueryLog($info);
        //查看这个表里的数据
        // $info=DB::connection('mysql_shop')->table('db')->where('db','like','%test%')->get()->toArray();
        // dd($info);
        // $sql=DB::connection('mysql_shop')->getQueryLog();
        // var_dump($sql);
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
            $info=DB::table('student')->where('name','like','%'.$req['search'].'%')->paginate(2);
            // dd($info);
        }else{
            $info=DB::table('student')->paginate(5);
        }
     
        return view('studentList',['student'=>$info,'search'=>$search]);
    }

    /**
     * 添加
     */
    public function add()
    {
        return view('studentAdd',[]);
    }
    /**
     * 修改
     */
    public function update(Request $request)
    {
        $req=$request->all();
        // dd($req);
        $info=DB::table('student')->where(['id'=>$req['id']])->first();
        // dd($info);
        return view('studentUpdate',['student_info'=>$info]);
    }
    /**
     * 执行修改
     */
    public function do_update(Request $request)
    {
       $req=$request->all();
    //    dd($req);
        $result=DB::table('student')->where(['id'=>$req['id']])->update([
            'name'=>$req['name'],
            'age'=>$req['age']
        ]);
        // dd($result);
        if($result){
           return  redirect('/student/index');
        }
    }
    /**
     * 删除
     */
    public function delete(Request $request)
    {
        $req=$request->all();
        $result=DB::table('student')->where(['id'=>$req['id']])->delete();
        // dd($result);
        if($result){
            return redirect('/student/index');
        }
    }
    /**
     * 添加学生的处理数据
     */
    public function do_add(Request $request)
    {
        $validateData=$request->validate([
            'name'=>'required',
            'age'=>'required'
        ],[
            'name.required'=>'名字没写',
            'age.required'=>'年龄没写'
        ]);
        $req=$request->all();
        $result=DB::table('student')->insert([
            $req
        ]);
        // dd($result);

        $result=true;
        if($result){
            return redirect('/student/index');
        }else{
            echo 'fail';
        }
    }
}
