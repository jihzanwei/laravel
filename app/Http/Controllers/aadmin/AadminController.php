<?php

namespace App\Http\Controllers\aadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

use App\Http\Tools\Tools;
class AadminController extends Controller
{

public function __construct(Tools $tools)
    {
    	
        $this->tools = $tools;
    }


    
	public function login(){

		return view('aadmin.login');
	}
	public function index(){

		return view('aadmin.index');
	}
	public function insert()
	{
		$openid = $this->tools->getOpenid();
		return view('aadmin.insert');
	
	}
	public function do_insert(Request $request)
	{
		$openid = session('openid');
		$data = $request->all();
		// dd($data);
		$name=$data['name'];
		$pwd=$data['pwd'];
		$info=DB::connection('access')->table('aadmin')->first();

		if($name==$info->name && $pwd==$info->pwd){
			$info=DB::connection('access')->table('aadmin')->where(['name'=>$name,'pwd'=>$pwd])->update([
				'openid'=>$openid
			]);
		}
	}
	public function do_code(Request $request)
	{
		$data = $request->all();
		// dd($data);
		$name=$data['name'];
		$pwd=$data['pwd'];
		$info=DB::connection('access')->table('aadmin')->where(['name'=>$name,'pwd'=>$pwd])->first();
		
		$openid = $info->openid;
		$code=rand(1000,9999);
		$this->tools->redis->set('code',$code,180);
        $this->moban_add($code,$openid);
	}

	 public function moban_add($code,$openid)
    {
        $token = $this->tools->token();

        $url ='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->tools->token();
        $data = [
            'touser'=>$openid,
            'template_id'=>'HZVVtrXERmGMipf31qmDDu0YDn500aSY3AwbyIoDxMk',
            'data'=>[
                'first'=>[
                    'value'=>'滴滴',
                    'color'=>'red'
                ],
                'keyword1'=>[
                    'value'=>$code,
                ],
                'keyword2'=>[
                    'value'=>date('Y-m-d H:i:s')
                ]
                ]

        ];
        $aa=$this->tools->Httppost($url,json_encode($data));
        $a=json_decode($aa);
        dd($a);

    }


     public function send_code(Request $request){
	      $data=$request->all();
	      // dd($data);
	      $code=$data['code'];
	       // dd($data);
	        $db=$this->tools->redis->get('code');
	//        dd($db);
	        if($code==$db){
	            return json_encode(['ret'=>1,'content'=>'登陆成功']);
	        }else{
	            return json_encode(['ret'=>0,'content'=>'登陆失败']);
	        }
	    }


    }

  
