<?php

namespace App\Http\Controllers\agent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Tools\Wechat;
use GuzzleHttp\Client;
use DB;
use Illuminate\Support\Facades\Storage;

class AgentController extends Controller
{
    public $request;
    public $wechat;
    public function __construct(Request $request,Wechat $wechat)
    {
        $this->request = $request;
        $this->wechat  = $wechat;
    }

    public function user_list()
    {
        $user_info=DB::connection('access')->table('user')->get();
        return view('agent/user_list',['tang'=>$user_info]);
    }
    // 生成用户二维码
    public function creat_qrcode(Request $request)
    {
        $uid=$request->all('id')['id'];
//        dd($uid);
        $url='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$this->wechat->get_access_token();
//        dd($url);
        $data=[
            "action_name"=>"QR_LIMIT_SCENE",
            "action_info"=>[
                "scene"=>[
                    "scene_id"=>123
                ]
            ]
        ];
//        dd($data);
        $re=$this->wechat->post($url,json_encode($data));
        $obj=json_decode($re,1);
//        dd($obj);
//        dd($uid);
        $tang=$obj['ticket'];
//        dd($tang);
        $url_tang='https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$tang;
//        dd($url_tang);
        $client=new Client();
        $response=$client->get($url_tang);
//        dd($response);
        $h=$response->getHeaders();
//        dd($h);
        $ext=explode('/',$h['Content-Type'][0])[1];
//        dd($ext);
        $file_name=time().rand(1000,9999).'.'.$ext;
        $path='qrcode/'.$file_name;
        $ree=Storage::disk('local')->put($path,$response->getBody());
        $qrcode_url=env('APP_URL').'/storage/'.$path;
//        dd($qrcode_url);
        $res=DB::connection('access')->table('user')->where('id','=',$uid)->update(
            [
                'agent_code'=>$obj['ticket'],
                'qrcode_url'=>$qrcode_url
            ]);
        return redirect('agent/user_list');

    }
    // 用户推广用户列表
    public function agent_list(Request $request)
    {
        $data=$request->all()['id'];
//        dd($data);
        $obj=DB::connection('access')->table('user_agent')->where('uid','=',$data)->get();
//        dd($obj);

        return view('agent/agent_list',['obj'=>$obj]);
    }

    // 用户添加
    public function add()
    {
        return view('agent/add');
    }
    public function do_add(Request $request)
    {
        $data=$request->all();
//        dd($data);
        $obj=DB::connection('access')->table('user')->insert(['name'=>$data['name']]);
//        dd($obj);
        if($obj){
            return redirect('agent/user_list');
        }
    }


















    // 查看二维码
//    public function tanghu(Request $request)
//    {
//        $data=$request->all()['id'];
////        dd($data);
//        $url='https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$data;
////        dd($url);
//        header("location:$url");
//    }
}