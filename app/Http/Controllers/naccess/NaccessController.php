<?php
namespace App\Http\Controllers\naccess;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;

/**
 * 
 */
class NaccessController extends Controller
{
	public function token()
	{

		 $redis = new \Redis();
       	 $redis->connect('127.0.0.1','6379');
       	 //加入缓存
        $access_token_key = 'wechat_access_token';
        if($redis->exists($access_token_key)){
            //存在
            return $redis->get($access_token_key);
        }else{
            //不存在
            $result = file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.env('WECHAT_APPID').'&secret='.env('WECHAT_APPSECRET'));
            $re = json_decode($result,1);
            $redis->set($access_token_key,$re['access_token'],$re['expires_in']);  //加入缓存
            return $re['access_token'];
        }
		// dd($token);

	}

	

	  /**
     * 获取用户列表
     */
    public function get_info()
    {
    	$token =$this->token();
    	$url= "https://api.weixin.qq.com/cgi-bin/user/get?access_token=$token&next_openid=";
    	$user = file_get_contents($url);
    	// $user = '{"total":3,"count":3,"data":{"openid":["o9Ctgszba4fqicoXdzd8IeMRe2eI","o9Ctgs-q1QeT8KBGAWtduMqZ9IJw","o9Ctgs9dT6l8-0k_iuiyF9Sgtzf8"]},"next_openid":"o9Ctgs9dT6l8-0k_iuiyF9Sgtzf8"}';
    	// dd($user);
    	$use = json_decode($user,true);
    	 // dd($use);
    	 return $use['data']['openid'];
    }
    public function get_list()
    {	
    	$token =$this->token();
    	// dd($token);
    	$use=$this->get_info();
    	// dd($use);
    	$arr = [];
    	foreach ($use as $k => $v) {
    		$arr[$k]['openid'] = $v;
    	}
    	$url = "https://api.weixin.qq.com/cgi-bin/user/info/batchget?access_token=$token";
	   	$data = [
	   		'user_list'=>$arr,	
	   	];
	   	$data = json_encode($data,JSON_UNESCAPED_UNICODE);
	   	$info = $this->HttpPost($url,$data);
	   	$data = json_decode($info,1)['user_info_list'];
	   	// dd($data);
	   	return view('naccess/list',compact('data'));
    }
    /*
 *   php访问url路径，post请求
 *
 *   durl   路径url
 *   post_data   array()   post参数数据
 */
public function HttpPost($url,$post_data){
    //初始化
    $curl = curl_init();
    //设置抓取的url
    curl_setopt($curl, CURLOPT_URL, $url);
    //设置头文件的信息作为数据流输出
    curl_setopt($curl, CURLOPT_HEADER, 0);
    //设置获取的信息以文件流的形式返回，而不是直接输出。
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE); // https请求 不验证证书和hosts
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //设置post方式提交
    curl_setopt($curl, CURLOPT_POST, 1);
    //设置post数据
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
    //执行命令
    $data = curl_exec($curl);
    //关闭URL请求
    curl_close($curl);
    //显示获得的数据
    return $data;
}

	//微信登录
	public function login()
	{
		return view('naccess/login');
	}
	public function do_login()
	{

		$redirect_uri ='http://www.laravel.com/naccess/code';
		$url ='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('WECHAT_APPID').'&redirect_uri='.urlencode($redirect_uri).'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
		header('Location:'.$url);
	}
	//接收code
	public function code(Request $request)
	{
		// echo 111;exit;
		$req = $request ->all();
		// dd($req);
		 $result = file_get_contents('https://api.weixin.qq.com/sns/oauth2/access_token?appid='.env('WECHAT_APPID').'&secret='.env('WECHAT_APPSECRET').'&code='.$req['code'].'&grant_type=authorization_code');
        $re = json_decode($result,1);
        // var_dump($re);die;
        $user_info = file_get_contents('https://api.weixin.qq.com/sns/userinfo?access_token='.$re['access_token'].'&openid='.$re['openid'].'&lang=zh_CN');
        $wechat_user_info = json_decode($user_info,1);
        // dd($wechat_user_info);
        	$o = $wechat_user_info['openid'];
        	// dd($o);
        $openid = DB::connection('access')->table('user_agent')->where(['openid'=>$o])->first();

         if(!empty($openid)){
            //存在
            // echo 11;die;
            $request->session()->put('uid',$openid);
        }else{
            //不存在
            // echo 22;die;
            DB::beginTransaction();
            $openid=DB::connection('access')->table('users')->insertGetId([
                'name'=>$wechat_user_info['city'],
                'pwd'=>'',
                'add_time'=>time(),
                'openid'=>$wechat_user_info['openid']
            ]);
            // var_dump($openid);die;
            $data=DB::connection('access')->table('user_agent')->insert([
                'uid'=>$openid,
                'openid'=>$wechat_user_info['openid'],
                'add_time'=>time()

            ]);
            DB::rollBack();
            $request->session()->put('uid',$openid);
        }
        
	}
} 