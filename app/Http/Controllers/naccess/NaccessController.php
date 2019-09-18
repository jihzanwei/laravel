<?php
namespace App\Http\Controllers\naccess;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use DB;
use App\Http\Tools\Tools;
/**
 * 
 */
class NaccessController extends Controller
{
	public $tools;
    public function __construct(Tools $tools)
    {
        $this->tools = $tools;
    }

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
    	$url= "https://api.w eixin.qq.com/cgi-bin/user/get?access_token=$token&next_openid=";
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
	  public function guzzle_upload($url,$path,$client){
        $result = $client->request('POST',$url,[
            'multipart' => [
                [
                    'name'     => 'media',
                    'contents' => fopen($path, 'r')
                ]
            ]
        ]);
        return $result->getBody();
    }
    /**
     * 调用频次清0
     */
    public function  clear_api(){

    	  $url = 'https://api.weixin.qq.com/cgi-bin/clear_quota?access_token='.$this->tools->get_wechat_access_token();
        $data = ['appid'=>env('WECHAT_APPID')];
        $this->tools->curl_post($url,json_encode($data));
    }


	 /**
     * 上传
     */
    public function upload(){
        return view('naccess.upload',[]);
    }
    /**
     * image video voice thumb
     * id media_id type[类型] path ['/storage/wechat/image/imagename.jpg'] add_time
     * @param Request $request
     */
    public function do_upload(Request $request,Client $client){
        $type = $request->all()['type'];
        // dd($type);
        $source_type = '';
        switch ($type){
            case 1: $source_type = 'image'; break;
            case 2: $source_type = 'voice'; break;
            case 3: $source_type = 'video'; break;
            case 4: $source_type = 'thumb'; break;
            default;
        }
        // dd($source_type);
        $name = 'file_name';
        if(!empty($request->hasFile($name)) && request()->file($name)->isValid()){
            //大小 资源类型限制
            $ext = $request->file($name)->getClientOriginalExtension();  //文件类型
            // dd($ext);
            $size = $request->file($name)->getClientSize() / 1024 / 1024;
            // dd($size);
            if($source_type == 'image'){
                if(!in_array($ext,['jpg','png','jpeg','gif'])){
                    dd('图片类型不支持');
                }
                if($size > 2){
                    dd('太大');
                }
            }elseif($source_type == 'voice'){}
            $file_name = time().rand(1000,9999).'.'.$ext;
            $path = request()->file($name)->storeAs('wechat/'.$source_type,$file_name);
            $storage_path = '/storage/'.$path;
            // dd($storage_path);
            $path = realpath('./storage/'.$path);
            // dd($path);
            $url = 'https://api.weixin.qq.com/cgi-bin/material/add_material?access_token='.$this->token().'&type='.$source_type;
            //$result = $this->curl_upload($url,$path);
            // $result = $this->guzzle_upload($url,$path,$client);
             if($source_type == 'video'){
                $title = '标题'; //视频标题
                $desc = '描述'; //视频描述
                $result = $this->guzzle_upload($url,$path,$client,1,$title,$desc);
            }else{
                $result = $this->guzzle_upload($url,$path,$client);
            }

            $re = json_decode($result,1);
            // dd($re);
            //插入数据库
            $sql=DB::connection('access')->table('wechat_source')->insert([
                'media_id'=>$re['media_id'],
                'type' => $source_type,
                'path' => $re['url'],
                'add_time'=>time()
            ]);
            if($sql){
            	echo 'ok';
            }else{
            	echo 'no';
            }
            
        }
    }
  //标签 展示页面
    public function biaoqian()
    {

        $info=$this->naccess_list();
//        dd($info);
        return view('naccess.biaoqian',['info'=>$info->tags]);
    }
    //添加标签
    public function get_label(Request $request)
    {

    	return view('naccess.get_label');
    }

    public  function do_get_label(Request $request)
    {
        $data = $request->all();
//        dd($data);
    	$url = 'https://api.weixin.qq.com/cgi-bin/tags/create?access_token='.$this->token();
//    	dd($url);
        $data=[
            'tag'=>['name'=>$request->all()['name']]
        ];
//        dd($data);
        $re=$this->HttpPost($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        if($re){
            return redirect('naccess/biaoqian');
        }
    }
    //删除
    public function naccess_del(Request $request)
    {
//        $www = $request->all();
//        dd($www);
        $url = 'https://api.weixin.qq.com/cgi-bin/tags/delete?access_token='.$this->token();
        $data = [
            "tag"=>['id'=>$request->all()['id']]
        ];
        $req=$this->HttpPost($url,json_encode($data));
          $result=json_decode($req,1);
//          dd($result);
           if($result){
               return redirect('naccess/biaoqian');
            }
    }

    //修改标签
    public function update(Request $request,$name)
    {
        $data=$request->all();
//        dd($data,$name);
        return view('naccess/update',['data'=>$data,'name'=>$name]);
    }
    public function do_update(Request $request)
    {
//        dd($request->all());
        $url='https://api.weixin.qq.com/cgi-bin/tags/update?access_token='.$this->token();
        $data=[
            'tag'=>[
                'id'=>$request->all()['id'],
                'name'=>$request->all()['name']
            ]
        ];
        $re=$this->HttpPost($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        $obj=json_decode($re,1);
//        dd($obj);
        if($obj){
            return redirect('naccess/biaoqian');
        }

    }
    //获取标签列表
    public function naccess_list()
    {
        $url='https://api.weixin.qq.com/cgi-bin/tags/get?access_token='.$this->token();
        $re=file_get_contents($url);
        $tag_info=json_decode($re);
        return $tag_info;
    }
    //粉丝列表
    public function index(Request $request)
    {

        $tag_id=!empty($request->all()['tag_id'])?$request->all()['tag_id']:'';
//        $aa = $request->all()['tag_id'];
//         dd($aa);
//         dd($tag_id);
        $openid_info=DB::connection('access')->table('token')->get();
//         dd($openid_info);
        return view('naccess/index',['data'=>$openid_info,'tag_id'=>$tag_id]);
    }
    //打标签
    public function add_ll(Request $request)
    {
//        dd($request->all());
        $openid_info=DB::connection('access')->table('token')->whereIn('id',$request->all()['id_list'])->select(['openid'])->get()->toArray();
        $openid_list=[];
        foreach($openid_info as $v){
            $openid_list[] = $v->openid;
        }
        dd($openid_list);
        $url='https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token='.$this->wechat->get_access_token();
        $data=[
            'openid_list'=>$openid_list,
            'tagid'=>$request->all()['tagid'],
        ];
        //dd($data);
        $re=$this->wechat->post($url,json_encode($data));
//        dd($re);
        $arr=json_decode($re,1);
//        dd($arr);
        if($arr['errcode']==0){
            return redirect('wechat/get_label_list');
        }else{
            echo "未知错误";
        }
    }

    //获取标签下的粉丝
    public function naccess_git_list()
    {
        $url='https://api.weixin.qq.com/cgi-bin/tags/get?access_token='.$this->token();
        $re=file_get_contents($url);
        $tag_info=json_decode($re);
        return $tag_info;
    }

    public function naccess_user()
    {
        $ww =$this->naccess_git_list();
//        dd($ww);
    }


    


} 