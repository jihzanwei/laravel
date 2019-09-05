<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class Survey extends Controller
{
    public function login(){
        return view('admin/survey/login');
    }
    public function do_login(Request $request){
        $req=$request->all();
        // dd($req);
        $name=$req['name'];
        $password=$req['password'];
        $result=DB::table('user')->where(['name'=>$name,'password'=>$password])->first();
        // dd($result);
        if($result!==null){
            echo 'OK';
            session(['name'=>$name,'password'=>$password]);
            return redirect('admin/survey/index');
        }else{
            echo 'fail';
        }
    }
    public function index(){
        return view('admin/survey/index');
    }
    public function do_add(Request $request){
        $req=$request->all();
        // dd($req);
        $result=DB::table('survey')->insert([
            $req
        ]);
        // dd($result);
        $result=true;
        if($result){
            return redirect('admin/survey/survey');
        }
    }

    public function survey(Request $request){
        $data=DB::table('survey')->get();
        return view('admin/survey/survey',['data'=>$data]);
    }

    public function list(Request $request){
        $data=DB::table('survey')->get();
        return view('admin/survey/list',['data'=>$data]);

    }
    public function surveys(Request $request){
        $id=$request->all()['id'];
        // dd($id);
        return view('admin/survey/surveys',['id'=>$id]);
    }
    public function add_question(Request $request){
        $req=$request->all();
        // dd($req);
        // dd($req['answer']);
        $req['answer']=implode(',',$req['answer']);
        // dd($req);
        $result=DB::table('survey_question')->insert([
            $req
        ]);
        // dd($result);
        $result=true;
        if($result){
            echo 'Ok';
            return redirect('admin/survey/list');
        }else{
            echo 'fail';
        }
       
    }

    public function use(Request $request){
        return view('admin/survey/use');
    }
   
}
