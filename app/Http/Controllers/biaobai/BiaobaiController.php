<?php
namespace App\Http\Controllers\biaobai;

use App\Http\Tools\Wechat;
use Illuminate\Http\Request;
use EasyWeChat\Kernel\Messages\Text;
use App\Http\Controllers\Controller;
use DB;

class BiaobaiController extends Controller
{
    public $wechat;
    public function __construct(Wechat $wechat)
    {
        $this->wechat = $wechat;
    }
    public function index(Request $request)
    {
        // dd(111);
        $uid = $request->session()->get('uid');
        // echo $uid.'<br/>';die;
        $openid_list = $this->wechat->app->user->list($nextOpenId = null);
//        $openid_info  = $openid_list['data']['openid'];
       // dd($openid_info);
        return view('biaobai.index',['info'=>$openid_list['data']['openid']]);
    }
    public function send(Request $request)
    {
        return view('biaobai.send',['openid'=>$request->all()['openid']]);
    }
    public function do_send(Request $request)
    {
        $req = $request->all();
        //$uid = $request->session()->get('uid');33
        $openid = 'o9Ctgs-q1QeT8KBGAWtduMqZ9IJw';
        $user = $this->wechat->app->user->get($openid);
        //模板消息
        $this->wechat->app->template_message->send([
            'touser' => $req['openid'],
            'template_id' => '5vN3Vi1FQzqkhd_QzimD45UncwaMO1WEvox_IuWDk-0',
            'url' => env('APP_URL').'/biaobai/index',
            'data' => [
                'first' => $req['user_type'] == 2?'匿名用户':$user['nickname'],
                'keyword1' => $req['content'],
            ],
        ]);
        //入库
        $result = DB::connection('access')->table('biaobai')->insert([
            'from_user'=>$openid,
            'content'=>$req['content'],
            'to_user'=>$req['openid'],
            'add_time'=>time()
        ]);
    }

    public function xxoo(){
        echo 111;
    }
}