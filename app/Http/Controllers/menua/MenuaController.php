<?php
namespace App\Http\Controllers\menua;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Tools\Wechat;


/**
 * 
 */
class MenuaController extends Controller
{

	public $wechat;
	public function __construct(Request $request,Wechat $wechat)
    {
        $this->request = $request;
        $this->wechat = $wechat;
    }
    public function token()
	{
		$access_token=$this->wechat->get_access_token();	
		 // dd($access_token)
	}

	public function index()
	{

		$url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->wechat->get_access_token();
		$data['button']=
            [[
                'name'=>'签到',
                'type'=>'view',
                'url'=>'http://www.jishiwl.cn/menua/index'
            ],
            [
                'name'=>'绑定账号',
                'type'=>'view',
                'url'=>'http://www.jishiwl.cn/aadmin/insert'
            ]];
        // var_dump(json_encode($data));die;
         // var_dump($data);die;

		  $re = $this->wechat->post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
		  // echo json_encode($data,JSON_UNESCAPED_UNICODE).'<br/>';die;
		  $res = json_decode($re);
	    	dd($res);
	}
     public function event()
    {
//        dd($_POST);
        $xml_string = file_get_contents('php://input'); // 获取微信发过来的xml数据
        $wechat_log_path = storage_path('/logs/wechat/'.date("Y-m-d").'.log');  // 生成日志文件
        file_put_contents($wechat_log_path,"<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<\n",FILE_APPEND);
        file_put_contents($wechat_log_path,$xml_string,FILE_APPEND);
        file_put_contents($wechat_log_path,"\n<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<\n\n",FILE_APPEND);

//        dd($xml_string);
        $xml_obj = simplexml_load_string($xml_string,'SimpleXMLElement',LIBXML_NOCDATA);
        $xml_arr = (array)$xml_obj;
        \Log::Info(json_encode($xml_arr,JSON_UNESCAPED_UNICODE));
//        echo $_GET['echostr'];


        // 业务逻辑（防止刷业务）
        if ($xml_arr['MsgType'] == 'event') {
            if ($xml_arr['Event'] == 'subscribe') {
                $share_code = explode('_',$xml_arr['EventKey'])[1];
                $user_openid = $xml_arr['FromUserName']; // 粉丝的openid
                // 判断是否已经在日志里
                $wechat_openid = DB::table('wechat_openid')->where('openid',$user_openid)->first();
                if (empty($wechat_openid)) {
                    DB::table('users')->where('id',$share_code)->increment('share_num',1);
                    DB::table('wechat_openid')->insert([
                        'openid' => $user_openid,
                        'add_time' => time()
                    ]);
                }
            }
        }

        $message = '干啥的  你';
        $xml_str = '<xml><ToUserName><![CDATA['.$xml_arr['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$xml_arr['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$message.']]></Content></xml>';
        echo $xml_str;
    }

}