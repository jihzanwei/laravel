<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class News extends Controller
{
    public function login(){
        return view('admin.news.login');
    }
    public function do_login(Request $request){
        $req=$request->all();
        $name=$req['name'];
        $password=$req['password'];
        // dd($name);
        // dd($req);
        $data=DB::table('user')->where(['name'=>$name,'password'=>$password])->first();
        // dd($data);
        if($data){
            session(['name'=>$name]);
            return redirect('news/index');
        }else{
            echo 'fail';
        }
    }

    public function index(Request $request){
        $data=DB::table('news')->paginate(2);

        return view('admin.news.index',['data'=>$data]);
    }

    public function add_news(){
        return view('admin.news.add_news');
    }
    public function do_add_news(Request $request){
        $validateData=$request->validate([
            'news_title'=>'required',
            'author'=>'required',
            'news_content'=>'required'
        ],[
            'news_title.required'=>'标题没写',
            'author.required'=>'作者没写',
            'news_content.required'=>'新闻详情必须填',
        ]);
        $req=$request->all();
        $req['add_time']=time();
        unset($req['_token']);
        // dd($req);
        $files=$request->file('goods_pic');
        // dd($files);
        $path='';
        if(empty($files)){
            echo 'fail';die();
        }else{
          $path= $files->store('goods');
        //   dd($path);
          $req['goods_pic']='/'.'storage'.'/'.$path;
        //   dd($req);
        }
        $result=DB::table('news')->insert([
            $req
        ]);
        // dd($result);
        $result=true;
        if($result){
            return redirect('news/index');
        }else{
            echo 'fail';
        }
    }
    public function delete(Request $request){
        $req=$request->all();
        // dd($req);
        $data=DB::table('news')->where(['id'=>$req['id']])->delete();
        // dd($data);
        $data=1;
        if($data){
            echo '删除成功';
            return redirect('news/index');
        }else{
            echo 'fail';
        }

    }
    public function show(Request $request){
        $req=$request->all();
        // dd($req);
        $data=DB::table('news')->where(['id'=>$req['id']])->first();
        // dd($data);
        $author=$data->author;
        $news_content=$data->news_content;
        $goods_pic=$data->goods_pic;
        // dd($goods_pic);
            $redis=new \Redis();
            $redis->connect('127.0.0.1','6379');
            $redis->incr('num');
            $num=$redis->get('num');

            // echo '搜索次数:'.$num;
        return view('admin.news/show',['author'=>$author,'news_content'=>$news_content,'goods_pic'=>$goods_pic,'num'=>$num]);
    }
}
