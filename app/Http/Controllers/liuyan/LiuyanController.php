<?php

namespace App\Http\Controllers\liuyan;
use App\Http\Tools\Wechat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LiuyanController extends Controller
{
	public function __construct(Request $request,Wechat $wechat)
    {
        $this->request = $request;
        $this->wechat = $wechat;
    }
    public function token()
	{
		$access_token=$this->wechat->get_access_token();	
		// dd($access_token);
	}
    //登录 
    public function login()
    {
        return view('liuyan.login');
    }

	public function do_login()
    {
//        echo 111;
        $data="http://www.laravel.com/liuyan/code";//
        $url='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('WECHAT_APPID').'&redirect_uri='.urlencode($data).'&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect';
      // dd($url);
        header('Location:'.$url);

    }
    public function get_list(Request $request)
    {
        $access_token=$this->wechat->get_access_token();
//        dd($access_token);
        // 拉取关注用户列表
        $info=file_get_contents("https://api.weixin.qq.com/cgi-bin/user/get?access_token={$access_token}&next_openid=");
        $access_info=json_decode($info,1);
      	 // dd($access_info);
        $data=$access_info['data'];
       // dd($data);
        foreach($data['openid'] as $v){
//            
            $xiangqing=file_get_contents("https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid={$v}&lang=zh_CN");

           // dd($xiangqing);

            $access_dudu=json_decode($xiangqing,1);
            $dudus[]=$access_dudu;
        }
       // dd($dudus);
        foreach($dudus as $v){
            $obj=DB::connection('access')->table('liuyan')->insert(
                ['openid'=>$v['openid'],'nickname'=>$v['nickname']]
            );
          
        }
        return redirect('liuyan/index');

    }
      public function index(Request $request){
         $data=DB::connection('access')->table('liuyan')->get();
       // dd($data);
        return view('liuyan/list',['data'=>$data]);
    }

    public function liuyan_add(Request $request)
    {
        // echo 11;die;
        $req = $request->all();
        // dd($req);
    	return view('liuyan.liuyan_add',['id'=>json_encode($req['id_list'])]);
                                        
    }

    public function liuyan_doadd(Request $request)
    {
    {
        $access_token= $this->wechat->get_access_token();
        // dd($access_token);
        $req = $request->all();
        // dd($req);
        $url = 'https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token='.$access_token;
            $data = [
                       "touser"=>[json_decode($req['id'],1)],
                        "msgtype"=>"text",
                        "text"=>[
                            'content'=>$req['send_info']
                        ]
                    ];
        $re = $this->wechat->post($url,json_encode($data));
        //我的留言
        return $re;
    }


    }


    public function code(Request $request)
    {
    	$req = $request->all();
        // dd($req);
    	$res = $req['code'];

    	// dd($re);
    	$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=wxf12564b613cc53f0&secret=fa568a0395ab709f18dcd82ddb7913c8&code=".$res."&grant_type=authorization_code";
    	// dd($url);
    	// dd($re);
        $re =file_get_contents($url);
    	$result = json_decode($re,1);
    	// dd($result);
    	//登录网站
    	$user_wechat=DB::connection('access')->table('liuyan')->where(['openid'=>$result['openid']])->first();
    	// dd($user_wechat);
    	if(!empty($user_wechat)){
    		//已注册 组要登录操作
    		return redirect('liuyan/index');

    	}else{
    		//未注册 需要注册 然后登录  
    	echo '注册去';
    	}
    }

    


}
