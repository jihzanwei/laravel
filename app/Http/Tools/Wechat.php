<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/8/5
 * Time: 10:37
 */
namespace  App\Http\Tools;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class Wechat{

    public  $request;
    public  $client;
    public  $app;
    public function __construct(Request $request,Client $client)
    {
        $this->request = $request;
        $this->client = $client;
      
    }

    public function tag_user($tag_id)
    {
        $url='https://api.weixin.qq.com/cgi-bin/user/tag/get?access_token='.$this->get_access_token();
        $data=[
          'tagid'=>$tag_id,
          'next_openid'=>''
        ];
        $re=$this->post($url,json_encode($data));
        $obj=json_decode($re,1);
        return $obj;
    }

    public function wechat_tang_list()
    {
        $url='https://api.weixin.qq.com/cgi-bin/tags/get?access_token='.$this->get_access_token();
        $re=file_get_contents($url);
        $tag_info=json_decode($re);
        return $tag_info;
    }
    
    public function get_info($openid)
    {
        $access_token=$this->get_access_token();
        $tang=file_get_contents("https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid."&lang=zh_CN");
        $access_tang=json_decode($tang,1);
//        dd($access_tang);
        return $access_tang;

    }

    /***
     * @param $up_type
     * @param $type
     * @param string $title
     * @param string $desc
     * @return \Psr\Http\Message\StreamInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * 上传微信素材资料
     */
    public function upload_source($up_type,$type,$title='',$desc='')
    {
        $file=$this->request->file($type);
//        dd($file);
        $file_ext=$file->getClientOriginalExtension();  // 获取文件扩展名
        $file_name=time().rand(1000,9999).'.'.$file_ext;
        $save_file_path=$file->storeAs('wechat/voice',$file_name);  // 返回成功后的路径
        $path='./storage/'.$save_file_path;
        if($up_type == 1){
            $url='https://api.weixin.qq.com/cgi-bin/media/upload?access_token='.$this->get_access_token().'&type='.$type;
        }elseif($up_type == 2){
            $url = 'https://api.weixin.qq.com/cgi-bin/material/add_material?access_token='.$this->get_access_token().'&type='.$type;
        }
        $multipart=[
        [
            'name'=>'media',
            'contents'=>fopen(realpath($path),'r')
        ],
    ];
        if($type == 'video' && $up_type == 2){
            $multipart[] = [
                'name'     => 'description',
                'contents' => json_encode(['title'=>$title,'introduction'=>$desc])
            ];
        }
        $response=$this->client->request('POST',$url,[
            'multipart'=>$multipart
        ]);
        $body=$response->getBody(); 
        unlink($path);
        return $body;

    }

    /***
     * 获取access_token
     */
    public function get_access_token(){
        // 获取access_token
        $access_token="";
        $redis=new \Redis();
        $redis->connect('127.0.0.1','6379');
        $access_token_key='wechat_access_token';
        if($redis->exists($access_token_key)){
            // 去缓存拿
            $access_token=$redis->get($access_token_key);
        }else{
            // 去微信接口拿
            $access_info=file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".env('WECHAT_APPID')."&secret=".env('WECHAT_APPSECRET'));
            $access_data=json_decode($access_info,1);
//        dd($access_info);
            $access_token=$access_data['access_token'];
            $expire_time=$access_data['expires_in'];
            // 加人缓存
            $redis->set($access_token_key,$access_token,$expire_time);
        }

        return $access_token;
    }

    public function post($url, $data = []){
        //初使化init方法
        $ch = curl_init();
        //指定URL
        curl_setopt($ch, CURLOPT_URL, $url);
        //设定请求后返回结果
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //声明使用POST方式来进行发送
        curl_setopt($ch, CURLOPT_POST, 1);
        //发送什么数据
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        //忽略证书
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        //忽略header头信息
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //设置超时时间
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        //发送请求
        $output = curl_exec($ch);
        //关闭curl
        curl_close($ch);
        //返回数据
        return $output;
    }
}