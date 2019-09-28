<?php
namespace App\Http\Controllers\kaoshi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Tools\Wechat;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use DB;
use phpDocumentor\Reflection\Location;;

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

	


}