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
		 $data = [
            'button' => [
                            [
                                'type'=>'view',
                                'name'=>'嘀嘀嘀',
                                "url"=>"http://www.laravel.com/naccess/login"
                            ],
              
                        ],
             'button1' => [
                            [
                                'type'=>'view',
                                'name'=>'嘟',
                                "url"=>"http://www.laravel.com/access/login"
                            ],
              
                        ]

        ];
         // var_dump($data);die;

		  $re = $this->wechat->post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
		  // echo json_encode($data,JSON_UNESCAPED_UNICODE).'<br/>';die;
		  $res = json_decode($re);
	    	dd($res);
	}

}