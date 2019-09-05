<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class ExamSystem extends Controller
{
    public function Login(){
        return view('admin.examsystem.login');
    }

    public function do_login(Request $request){
        $req=$request->all();
        $name=$req['name'];
        $password=$req['password'];
        unset($req['_token']);
        // dd($req);
        $result=DB::table('user')->where(['name'=>$name,'password'=>$password])->first();
        // dd($result);
        if($result){
            session(['name'=>$name,'password'=>$password]);
            return redirect('admin/exam/index');
        }else{
            echo '失败';
        }

    }

    public function index()
    {
        $data=DB::table('type')->get();
        return view('admin/examsystem/index',['data'=>$data]);
    }

    public function aadd(Request $request){
        return view('admin/examsystem/aadd');
     
    }

    public function do_aadd(Request $request){
        $req=$request->all();
        // dd($req);
        $req['add_time']=time();
        $result=DB::table('examsystem')->insert([
            $req
        ]);
        $result=true;
        if($result){
            return redirect('admin/exam/examList');
        }
    }
    public function add(Request $request)
    {
        $req=$request->all();
        $req['add_time']=time();
        // dd($req);
        // $type=DB::table('examsystem')->insert([
        //     $req
        // ]);
        $type=$req['type'];
        // dd($type);
        if($type=='单选'){
            return redirect('admin/exam/aadd');
        }
        
    }
    public function examList(Request $request)
    {
       $data=DB::table('examsystem')->get();
       return view('admin/examsystem/examList',['data'=>$data]);
        
    }
    public function detail(Request $request)
    {
        $req=$request->all();
        $data=DB::table('examsystem')->where(['id'=>$req['id']])->first();
        return view('admin/examsystem/detail',['data'=>$data]);
        
    }
}
