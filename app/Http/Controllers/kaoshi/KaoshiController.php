<?php
namespace App\Http\Controllers\kaoshi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Tools\Wechat;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use DB;
use phpDocumentor\Reflection\Location;

/**
 *
 */
class kaoshiController extends Controller
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

     public function huifu()
    {

        $data = file_get_contents("php://input");
        // dd($data);
        //解析XML
        $xml = simplexml_load_string($data,'SimpleXMLElement', LIBXML_NOCDATA);        //将 xml字符串 转换成对象
        $xml = (array)$xml; //转化成数组
        $log_str = date('Y-m-d H:i:s') . "\n" . $data . "\n<<<<<<<";
        file_put_contents(storage_path('logs/wx_event.log'),$log_str,FILE_APPEND);
       // dd($xml);
        if($xml['MsgType']=='event'){
            if($xml['Event']=='subscribe'){
                if(isset($xml['EventKey'])){
                    $agent_code=explode('_',$xml['EventKey'])[1];
                    $dataa=DB::connection('naccess')->table('user_agent')->where(['openid'=>$xml['FromUserName']])->first();
                    if(empty($dataa)){
                        $datas=DB::connection('naccess')->table('user_agent')->insert(['uid'=>$agent_code,'openid'=>$xml['FromUserName'],'add_time'=>time()]);
                    }
                    $message = '你好,111!';
                    $xml_str='<xml><ToUserName><![CDATA['.$xml['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$xml['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$message.']]></Content></xml>';
                    echo $xml_str;
                }
            }
        }elseif($xml['MsgType']=='text'){
            $message = '你好!222';
            $xml_str = '<xml><ToUserName><![CDATA['.$xml['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$xml['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$message.']]></Content></xml>';
            echo $xml_str;
        }

    }




}