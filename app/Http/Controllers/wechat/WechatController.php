<?php

namespace App\Http\Controllers\wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Tools\Wechat;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use DB;
use phpDocumentor\Reflection\Location;

class WechatController extends Controller
{
    public $request;
    public $wechat;
    public function __construct(Request $request,Wechat $wechat)
    {
        $this->request = $request;
        $this->wechat = $wechat;
    }

  



    public function get_list(Request $request)
    {
        $access_token=$this->wechat->get_access_token();
//        dd($access_token);
        // 拉取关注用户列表
        $info=file_get_contents("https://api.weixin.qq.com/cgi-bin/user/get?access_token={$access_token}&next_openid=");
        $access_info=json_decode($info,1);
//        dd($access_info);
        $data=$access_info['data'];
       // dd($data);
        foreach($data['openid'] as $v){
//            $v='oUu1QwTNVoPux9LPWhUK_AGSbecQ';
            $tang=file_get_contents("https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid={$v}&lang=zh_CN");
//            dd($tang);
            $access_tang=json_decode($tang,1);
            $tangs[]=$access_tang;
        }
//        dd($tangs);
        foreach($tangs as $v){
            $obj=DB::connection('access')->table('token')->insert(
                ['openid'=>$v['openid'],'add_time'=>$v['subscribe_time'],'subscribe'=>$v['subscribe'],'nickname'=>$v['nickname'],'headimgurl'=>$v['headimgurl']]
            );

        }

//        dd($obj);
        if($obj){
            return redirect('wechat/index');
        }
    }
    // 粉丝列表
    public function index(Request $request){
        $tag_id=!empty($request->all()['tag_id'])?$request->all()['tag_id']:'';
        // dd($tag_id);
        $openid_info=DB::connection('access')->table('token')->get();
        // dd($openid_info);
        return view('wechat/index',['data'=>$openid_info,'tag_id'=>$tag_id]);
//        $data=DB::connection('access')->table('token')->get();
//        return view('wechat/index',['data'=>$data]);
    }

    public function tang($id){
        $data=DB::connection('access')->table('token')->where('id','=',$id)->first();
//        dd($data);
        return view('wechat/tang',['data'=>$data]);
    }

    public function code(Request $request)
    {
//        echo 111;
        $req=$request->all();
        $code=$req['code'];
//        dd($code);
        // 获取access_token
        $url='https://api.weixin.qq.com/sns/oauth2/access_token?appid='.env('WECHAT_APPID').'&secret='.env('WECHAT_APPSECRET').'&code='.$code.'&grant_type=authorization_code';
        $re=file_get_contents($url);
        $result=json_decode($re,1);
        $access_token=$result['access_token'];
        $openid=$result['openid'];
//        dd($openid);
        $where=[
          ['openid','=',$openid]
        ];
//        dd($where);
//        $wechat_user_info = $this->wechat->get_info($openid);
        $count=DB::connection('access')->table('openid')->where($where)->first();
//        dd($count);
        if($count){
//            $openid='oUu1QwUy4T7-ifYNCtP7V8YHYxn8';
            $url='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->wechat->get_access_token();
            $data=[
                'touser'=>$openid,
                'template_id'=>'0lLfn1P5eaiFIzbN8LaqogJOt2uQmLZ-1nJSzlRXC4M',
                'url'=>'http://www.baidu.com',
                'data'=>[
                    'first'=>[
                        "value"=>"欢迎",
                        "color"=>""
                    ]
                ]
            ];
            $re=$this->wechat->post($url,json_encode($data));
            return redirect('/User/index');
        }else{
            $data=DB::connection('access')->table('openid')->insert(
                ['openid'=>$openid]
            );
            if($data){
                $request->session()->put('data',$data);
                return redirect('/User/index');
            }else{
                echo "<script>history.go(-1)</script>";
            }
        }
//        if(!empty($count)){
//            // 有数据
//            $user_info = DB::connection('access')->table("user")->where(['id'=>$count->uid])->first();
//            $request->session()->put('username',$user_info['name']);
//            if($user_info){
//                return redirect('User/index');
//            }
//        }else{
//            // 没有数据
//            DB::connection("access")->beginTransaction();
//            $user_result = DB::connection('access')->table('user')->insertGetId([
//                'password' => '',
//                'name' => $wechat_user_info['nickname'],
//                'reg_time' => time()
//            ]);
//            $openid_result = DB::connection('access')->table('openid')->insert([
//                'uid'=>$user_result,
//                'openid' => $openid,
//            ]);
//            DB::connection('access')->commit();
//            // 登录操作
//            $user_info = DB::connection('access')->table("user")->where(['id'=>$count->uid])->first();
//            $request->session()->put('username',$user_info['name']);
//            if($user_info){
//                return redirect('User/index');
//            }
//        }
//
    }

    public function login()
    {
//        echo 111;
        $data="http://www.myshop.com/wechat/code";
        $url='https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('WECHAT_APPID').'&redirect_uri='.urlencode($data).'&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect';
//       dd($url);
        header('Location:'.$url);
    }

    public function template_list()
    {
        $data='https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token='.$this->wechat->get_access_token();
        $user_info=file_get_contents($data);
        dd(json_decode($user_info,1));
    }

    public function del_template()
    {
        $url='https://api.weixin.qq.com/cgi-bin/template/del_private_template?access_token='.$this->wechat->get_access_token();
        $data=[
            'template_id'=>'-CcIjhVIkzfIITo3msLKFwFyj7Z_FsP9BYTxoESLCdM'
        ];
//        dd($data);
        $re=$this->wechat->post($url,json_encode($data));
        dd($re);
    }

    public function push_template()
    {
        $openid='oUu1QwTNVoPux9LPWhUK_AGSbecQ';
        $url='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->wechat->get_access_token();
        $data=[
            'touser'=>$openid,
            'template_id'=>'0lLfn1P5eaiFIzbN8LaqogJOt2uQmLZ-1nJSzlRXC4M',
            'url'=>'hhttp://www.baidu.com',
            'data'=>[
                'first'=>[
                    "value"=>"欢迎",
                    "color"=>""
                ]
            ]
        ];
        $re=$this->wechat->post($url,json_encode($data));
        dd($re);
    }

    public function upload_source()
    {
       // $url = 'https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token='.$this->wechat->get_access_token();
       // $data = ['type'=>'image','offset'=>0,'count'=>20];
        //$re = $this->wechat->post($url,json_encode($data));
//        echo '<pre/>';
//        print_r(json_decode($re,1));
        return view('wechat/upload_source');
    }

    public function do_upload(Request $request)
    {
        $upload_type=$request['up_type'];
        $re='';
        if($request->hasFile('image')){
            // 图片类型
            $re=$this->wechat->upload_source($upload_type,'image');
        }elseif($request->hasFile('voice')){
            // 语音类型
            $re=$this->wechat->upload_source($upload_type,'voice');
        }elseif($request->hasFile('video')){
            // 视频类型
            $re=$this->wechat->upload_source($upload_type,'video','视频标题','视频描述');
        }elseif($request->hasFile('thumb')){
            // 缩略图类型
            $path=$request->file('thumb')->store('wechat/thumb  ');
        }
        echo $re;
        dd();
    }

    public function get_voice_source()
    {
        $media_id='hozLdyDtMlASo_GeLpQxfC63JBWj6IlsNJRQuFpF3rdMohjkVlN7qYbGsX5BPCfp';
        $url='https://api.weixin.qq.com/cgi-bin/media/get?access_token='.$this->wechat->get_access_token().'&media_id='.$media_id;
//        echo $url;echo '</br>';
        $client= new Client();
        $response=$client->get($url);
        $file_info=$response->getHeader('Content-disposition');
        $file_name=substr(rtrim($file_info[0],'"'),-20);
        $path= 'wechat/voice/'.$file_name;
        $re=Storage::put($path,$response->getBody());
        echo env('APP_URL').'/storage/'.$path;
        dd($re);

    }

    public function get_source()
    {
        $media_id='aSigzw6FkcXjvivp17ptAUl1nmBhSkkQYYywcgYy9_olcZiylgJLz0n_eT9EOMqD';
        $url='https://api.weixin.qq.com/cgi-bin/media/get?access_token='.$this->wechat->get_access_token().'&media_id='.$media_id;
//        echo $url;echo "</br>";
        $client = new Client();
        $response=$client->get($url);
        $file_info=$response->getHeader('Content-disposition');
        $file_name=substr(rtrim($file_info[0],'"'),-20);
//        dd($file_name);
        $path='wechat/image/'.$file_name;
        $re=Storage::put($path,$response->getBody());
        echo env('APP_URL').'/storage/'.$path;
        dd($re);
    }

    public function get_video_source()
    {
        $media_id='N1omZZXB8Hkve0u32KGZwL46wXBcV81NA22FCzu1uetM8zcQPqPZjkuECeUQMXSb';
        $url='https://api.weixin.qq.com/cgi-bin/media/get?access_token='.$this->wechat->get_access_token().'&media_id='.$media_id;
//        dd($url);
        $client= new Client();
        $response=$client->get($url);
        $video_url=json_decode($response->getBody(),1)['video_url'];
        $file_name=explode('/',parse_url($video_url)['path'])[2];
        // 设置超时参数
        $opts=array(
          "http"=>array(
              "method"=>"GET",
              "timeout"=>3  // 单位秒
          ),
        );
        // 创建数据流上下文
        $context=stream_context_create($opts);
        $read=file_get_contents($video_url,false,$context);
        $re=file_put_contents('./storage/wechat/video/'.$file_name,$read);
        var_dump($re);
        die();
    }

    // 用户标签管理
    public function get_label()
    {
        return view('wechat/get_label');
    }
    public function do_get_label(Request $request)
    {
        $url='https://api.weixin.qq.com/cgi-bin/tags/create?access_token='.$this->wechat->get_access_token();
        $data=[
          'tag'=>['name'=>$request->all()['name']]
        ];
        $re=$this->wechat->post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        if($re){
            return redirect('wechat/get_label_list');
        }
    }
    // 用户标签列表
    public function get_label_list()
    {
        $tag_info=$this->wechat->wechat_tang_list();
//        dd($tag_info);

        return view('wechat/get_label_list',['info'=>$tag_info->tags]);
    }

    public function tang_del(Request $request)
    {
        $url='https://api.weixin.qq.com/cgi-bin/tags/delete?access_token='.$this->wechat->get_access_token();
        $data=[
          'tag'=>['id'=>$request->all()['id']]
        ];
        $re=$this->wechat->post($url,json_encode($data));
        $result=json_decode($re,1);
        if($result){
            return redirect('wechat/get_label_list');
        }
    }

    public function tang_user(Request $request)
    {
        $url='https://api.weixin.qq.com/cgi-bin/user/tag/get?access_token='.$this->wechat->get_access_token();
        $data=[
          'tagid'=>$request->all()['id'],
          'next_openid'=> ''
        ];
        $re=$this->wechat->post($url,json_encode($data));
        $arr=json_decode($re,1)['data']['openid'];
//        dd($arr);
        return view('wechat/tang_user',['arr'=>$arr]);
    }

    public function add_tang(Request $request)
    {
        // dd($request->all());
        $openid_info=DB::connection('access')->table('token')->whereIn('id',$request->all()['id_list'])->select(['openid'])->get()->toArray();
        $openid_list=[];
        foreach($openid_info as $v){
            $openid_list[] = $v->openid;
        }
        //dd($openid_list);
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

    public function get_user_tang(Request $request)
    {
//        dd($request->all());
        $url='https://api.weixin.qq.com/cgi-bin/tags/getidlist?access_token='.$this->wechat->get_access_token();
//        dd($url);
        $data=['openid'=>$request->all()['openid']];
//        dd($data);
        $re=$this->wechat->post($url,json_encode($data));
//        dd($re);
        $info=json_decode($re,1);
//        dd($info);
        $tag_info=$this->wechat->wechat_tang_list();
//        dd($tag_info);
        $obj=json_decode(json_encode($tag_info),1);
//        dd($obj);
        $tag_arr=$obj['tags'];
//        dd($tag_arr);
        foreach($tag_arr as $v){
            foreach($info['tagid_list'] as $vv){
                if($vv == $v['id']){
                    echo $v['name']."<a href='".env('APP_URL').'/wechat/del_user_tang'.'?tag_id='.$v['id'].'&openid='.$request->all()['openid']."'>删除</a>";
                }
            }
        }
    }

    public function del_user_tang(Request $request)
    {
        $url='https://api.weixin.qq.com/cgi-bin/tags/members/batchuntagging?access_token='.$this->wechat->get_access_token();
        if(!is_array($request->all()['openid'])){
            $openid_list=[$request->all()['openid']];
        }else{
            $openid_list=$request->all()['openid'];
        }
        $data=[
            'openid_list'=>$openid_list,
            'tagid'=>$request->all()['tag_id']
        ];
        $re=$this->wechat->post($url,json_encode($data));
        $obj=json_decode($re,1);
        if($obj){
            return redirect('wechat/get_user_tang');
        }
    }

    public function get_update(Request $request,$name)
    {
        $data=$request->all();
//        dd($data,$name);
        return view('wechat/get_update',['data'=>$data,'name'=>$name]);
    }
    public function do_get_update(Request $request)
    {
//        dd($request->all());
        $url='https://api.weixin.qq.com/cgi-bin/tags/update?access_token='.$this->wechat->get_access_token();
        $data=[
          'tag'=>[
          'id'=>$request->all()['id'],
          'name'=>$request->all()['name']
            ]
        ];
        $re=$this->wechat->post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        $obj=json_decode($re,1);
//        dd($obj);
        if($obj){
            return redirect('wechat/get_label_list');
        }
        
    }
    // 根据标签为用户推送消息
    public function push_tang(Request $request)
    {
        $re=$this->wechat->tag_user($request->all()['tag_id']);
//        dd($re);
        return view('wechat/push_tang',['tag_id'=>$request->all()['tag_id']]);
    }
    // 执行
    public function do_push_tang(Request $request)
    {
//        dd($request->all());
        $url='https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token='.$this->wechat->get_access_token();
        $push_type=$request->all()['push_type'];
        if($push_type == 1){
            // 文本消息
            $data=[
                'filter'=>['is_to_all'=>false,'tag_id'=>$request->all()['tag_id']],
                'text'=>['content'=>$request->all()['message']],
                'msgtype'=>'text'
            ];
//            dd($data);
        }elseif($push_type == 2){
            // 素材消息 图
            $data=[
                'filter'=>['is_to_all'=>false,'tag_id'=>$request->all()['tag_id']],
                'text'=>['media_id'=>$request->all()['media_id']],
                'msgtype'=>'image'
            ];
        }
        $re=$this->wechat->post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        $obj=json_decode($re,1);
        if($obj){
            return redirect('wechat/get_label_list');
        }
    }
    // 创建二维码
    public function ticket()
    {
        $url='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$this->wechat->get_access_token();
        $data=[
            "expire_seconds"=> 604800,
            "action_name"=> "QR_SCENE",
            "action_info"=> [
                "scene"=>[
                    "scene_id"=>123
                ]
            ]
        ];
//        dd($data);
        $re=$this->wechat->post($url,json_encode($data));
        $obj=json_decode($re,1);
//        dd($obj);
        $ticket=$obj['ticket'];
//        dd($ticket);
        $ticket_url=urlencode($ticket);
//        dd($ticket_url);
        $url_to="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=$ticket_url";
//        dd($url_to);
        header("location:$url_to");
    }
    // 微信消息推送
    public function tangtang()
    {
//        $data=file_get_contents("php://input");
//        dd($data);
        $data = file_get_contents("php://input");
        //解析XML
        $xml = simplexml_load_string($data,'SimpleXMLElement', LIBXML_NOCDATA);        //将 xml字符串 转换成对象
        $xml = (array)$xml; //转化成数组
        $log_str = date('Y-m-d H:i:s') . "\n" . $data . "\n<<<<<<<";
        file_put_contents(storage_path('logs/wx_event.log'),$log_str,FILE_APPEND);
//        dd($xml);
        if($xml['MsgType']=='event'){
            if($xml['Event']=='subscribe'){
                if(isset($xml['EventKey'])){
                    $agent_code=explode('_',$xml['EventKey'])[1];
                    $dataa=DB::connection('access')->table('user_agent')->where(['openid'=>$xml['FromUserName']])->first();
                    if(empty($dataa)){
                        $datas=DB::connection('access')->table('user_agent')->insert(['uid'=>$agent_code,'openid'=>$xml['FromUserName'],'add_time'=>time()]);
                    }
                    $message = '你好,欢迎关注本服务号!';
                    $xml_str='<xml><ToUserName><![CDATA['.$xml['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$xml['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$message.']]></Content></xml>';
                    echo $xml_str;
                }
            }
        }elseif($xml['MsgType']=='text'){
            $message = '你好!';
            $xml_str = '<xml><ToUserName><![CDATA['.$xml['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$xml['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$message.']]></Content></xml>';
            echo $xml_str;
        }

    }
        















    // 接口清零
    public function aa()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/clear_quota?access_token='.$this->wechat->index_1();
        $data = [
            'appid' => env('WECHAT_APPID'),
        ];
        $datas = $this->wechat->post($url,json_encode($data));
//        dd(json_decode($datas));

    }





}