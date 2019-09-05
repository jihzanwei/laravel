<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class Liuyan extends Controller
{
    public function liuyan_info(Request $request){
        if(empty($request->all()['access_token']) || $request->all()['access_token'] != '12345'){
            return json_encode(['errno'=>'40014']);
        }
        $info=DB::connection('mysql')->table('student')->get()->toArray();
        $info=json_decode(json_encode($info),1);
        echo json_encode($info);
       
    }
}
