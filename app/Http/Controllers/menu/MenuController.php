<?php
namespace App\Http\Controllers\menu;

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
class MenuController extends Controller
{
	public $wechat;
	
	public function __construct(Wechat $wechat)
	{
		$this->wechat = $wechat;

	}

	//菜单管理主页
	public 	function menu_list()
	{

		 $menu_info = DB::connection('access')->table('menu')->groupBy('menu_name')->select(['menu_name'])->orderBy('menu_name')->get()->toArray();
        $info = [];
        foreach($menu_info as $k=>$v){
            $sub_menu = DB::connection('access')->table('menu')->where(['menu_name'=>$v->menu_name])->orderBy('menu_name')->get()->toArray();

            if(!empty($sub_menu[0]->second_menu_name)){
                $info[] = [
                    'menu_str'=>'|',
                    'menu_type'=>2,
                    'menu_name'=>$v->menu_name,
                    'second_menu_name'=>'',
                    'menu_num'=>0,
                    'event_type'=>'',
                    'menu_tag'=>''
                ];
                foreach($sub_menu as $vo){
                    $vo->menu_str = '|';
                    $info[] = (array)$vo;
                }
            }else{
                $sub_menu[0]->menu_str = '|';
                $info[] = (array)$sub_menu[0];
               
            }
        }
        //print_r($info);
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token='.$this->wechat->get_access_token();
        $re = file_get_contents($url);
        // print_r(json_decode($re,1));



		return view('menu.menu_list',['info'=>$info]);
	}

	public function do_add_menu(Request $request)
	{
		     $req = $request->all();
        //echo "<pre>";print_r($req);
        $data = [];
        $result = DB::connection('access')->table('menu')->insert([
            'menu_name' => $req['menu_name'],
            'second_menu_name'=>empty($req['second_menu_name'])?'':$req['second_menu_name'],
            'menu_type'=>$req['menu_type'],
            'event_type'=>$req['event_type'],
            'menu_tag'=>$req['menu_tag']
        ]);
        if($req['menu_type'] == 1){ //一级菜单
            $first_menu_count = DB::connection('access')->table('menu')->where(['menu_type'=>1])->count();
        }
        // dd($req['menu_tag']);
        $this->reload_menu();
    
	}

	    /**
     * 自定义菜单查询接口
     */
    public function display_menu()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token='.$this->wechat->get_access_token();
        $re = file_get_contents($url);
        echo "<pre>";
        print_r(json_decode($re,1));
    }
    /**
     * 刷新菜单
     */
    public function reload_menu()
    {
        $menu_info = DB::connection('access')->table('menu')->groupBy('menu_name')->select(['menu_name'])->orderBy('menu_name')->get()->toArray();
        foreach($menu_info as $v){
            $menu_list = DB::connection('access')->table('menu')->where(['menu_name'=>$v->menu_name])->get()->toArray();
            $sub_button = [];
            foreach($menu_list as $k=>$vo){
                if($vo->menu_type == 1){ //一级菜单
                    if($vo->event_type == 'view'){
                        $data['button'][] = [
                            'type'=>$vo->event_type,
                            'name'=>$vo->menu_name,
                            'url'=>$vo->menu_tag
                        ];
                    }else{
                        $data['button'][] = [
                            'type'=>$vo->event_type,
                            'name'=>$vo->menu_name,
                            'key'=>$vo->menu_tag
                        ];
                    }
                }
                if($vo->menu_type == 2){ //二级菜单
                    //echo "<pre>";print_r($vo);
                    if($vo->event_type == 'view'){
                        $sub_button[] = [
                            'type'=>$vo->event_type,
                            'name'=>$vo->second_menu_name,
                            'url'=>$vo->menu_tag
                        ];
                    }elseif($vo->event_type == 'media_id'){
                    }else{
                        $sub_button[] = [
                            'type'=>$vo->event_type,
                            'name'=>$vo->second_menu_name,
                            'key'=>$vo->menu_tag
                        ];
                    }
                }
            }
            if(!empty($sub_button)){
                $data['button'][] = ['name'=>$v->menu_name,'sub_button'=>$sub_button];
            }
        }
        // echo "<pre>";print_r($data);
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->wechat->get_access_token();
        //    $data = [
        //     'button' => [
        //         [
        //             'type'=>'click',
        //             'name'=>'今日歌曲',
        //             'key'=>'V1001_TODAY_MUSIC'
        //         ],
        //         [
        //             'name'=>'菜单',
        //             'sub_button' =>[
        //                 [
        //                     'type'=>'view',
        //                     'name'=>'搜索',
        //                     'url'=>'http://www.soso.com/'
        //                 ],
        //                 [
        //                     "type"=>"click",
        //                     "name"=>"赞一下我们",
        //                     "key"=>"V1001_GOOD"
        //                 ]
        //             ]
        //         ],
        //         [
        //             'type'=>'click',
        //             'name'=>'明日歌曲',
        //             'key'=>'V1001_TODAY_MUSIC111'
        //         ]
        //     ],
        // ];
        $re = $this->wechat->post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        echo json_encode($data,JSON_UNESCAPED_UNICODE).'<br/>';
        echo "<pre>"; print_r(json_decode($re,1));
    }

}