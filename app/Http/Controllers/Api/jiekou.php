<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class jiekou extends Controller
{
    //测试
    public function test(){
        $data = "http://api.map.baidu.com/geocoder/v2/?address=北京市昌平区沙河地铁站&output=json&ak=CxF13N48UHZ12G8sIVpa2YTG";
        return response()->json(err('对应数据不存在'));
        return response()->json(['status'=>1,'msg'=>'查询成功！','data'=>$data]);
        return view('index');
    }
}
