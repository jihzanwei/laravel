<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class Tournament extends Controller
{
    public function add(Request $request){
        return view('admin/tournament/add');
    }
    public function do_add(Request $request){
        $validateData=$request->validate([
            'one'=>'required',
            'two'=>'required',
            'guess_time'=>'required'
        ],[
            'one.required'=>'A方没写',
            'two.required'=>'B方没写',
            'guess_time.required'=>'竞猜时间没写',
        ]);
        $req=$request->all();
        $req['guess_time']=strtotime($req['guess_time']);
        // dd($req);
        $req['add_time']=time();
        if($req['one']==$req['two']){
            echo "<script>alert('你添加了两个相同的球队')</script>";
            die();
        }
        $result=DB::table('tournament')->insert([
            $req
        ]);
        // dd($result);
        $result=true;

        if($result){

            return redirect('admin/tournament/guesslist');
        }else{
            echo 'fail';
        }
    }

    public function guesslist(Request $request){
        $data=DB::table('tournament')->get();
        // dd($data);
      
        foreach($data->toArray() as $v){
            // print_r($v->guess_time);
            $guess_time=strtotime($v->guess_time);
        }
        // dd($guess_time);

        $time=time();
        // dd($time);
        return view('admin/tournament/guesslist',['data'=>$data,'time'=>$time,'guess_time'=>$guess_time]);
    }

    public function result(Request $request){
        $req=$request->all();
        // dd($req);
        $id=$req['id'];
        $data=DB::table('tournament')->where(['id'=>$id])->first();
        $one=$data->one;
        // dd($one);
        $two=$data->two;
        // dd($two);
        $result=DB::table('endresult')->where(['one'=>$one,'two'=>$two])->first();
        $guess=DB::table('guess')->where(['one'=>$one,'two'=>$two])->first();
        // dd($guess);
        $guesss=$guess->guess_result;
        // dd($guesss);
        // dd($result);
        // dd($data);
        // $data=DB::table('endresult')->get();
        $guess_result=$result->guess_result;
        // dd($guess_result);
        return view('admin/tournament/result',['guess_result'=>$guess_result,'one'=>$one,'two'=>$two,'guesss'=>$guesss]);
    }

    public function guessing(Request $request){
        $req=$request->all();
        $id=$req['id'];
        $data=DB::table('tournament')->where(['id'=>$id])->first();
        // dd($data);
        $one=$data->one;
        $two=$data->two;
        // dd($one);
        // dd($two);
        // dd($id);
        return view('admin/tournament/guessing',['one'=>$one,'two'=>$two]);
    }

    public function do_add_guessing(Request $request){
        $req=$request->all();
        // dd($req);
        $req['add_time']=time();
        // dd($req);
        $result=DB::table('guess')->insert([
            $req
        ]);
        // dd($result);
        $result=true;
        if($result){
            echo '竞猜成功';
            return redirect('admin/tournament/guesslist');
        }else{
            echo 'fail';
        }

    }

    public function adminresult(Request $request){
        $data=DB::table('endresult')->get();
        // dd($data);

        return view('admin/tournament/adminresult',['data'=>$data]);
       
    }
}
