<?php
namespace App\Http\Controllers\moban;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Tools\Tools;

class MobanController extends Controller
{
    public $tools;
    public function __construct(Tools $tools)
    {
        $this->tools = $tools;
    }

    public function moban_add()
    {
        $token = $this->tools->token();

        $url ='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->tools->token();
        $data = [
            'touser'=>'o9Ctgs-q1QeT8KBGAWtduMqZ9IJw',
            'template_id'=>'UmW31-iGShXGo6UuRXrr31wQC7hOKIOWQU3HVaNRXps',
            'data'=>[
                'first'=>[
                    'value'=>'滴滴',
                    'color'=>'red'
                ],
                'keyword1'=>[
                    'value'=>'阿萨德飞规划局',
                ]
                ]

        ];
        $aa=$this->tools->Httppost($url,json_encode($data));
        $a=json_decode($aa);
        dd($a);

    }

}
?>