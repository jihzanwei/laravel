<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class AdminLogin extends Controller
{
    public function AdminLogin()
    {
        return view('admin.adminLogin');
    }
    public function Admin_do_login(Request $request)
    {
        $req=$request->all();
        // dd($req);
        $name=$req['name'];
        $password=$req['password'];
        $data=DB::table('user')->where(['name'=>$name,'password'=>$password])->first();
        // dd($data->state);
        // dd($data->password);
        if(empty($data)){
            dd('你输入了无效的用户');
        }else{
            if($data->state==1){
                return redirect('admin/goods');
            }else{
                echo "<script>alert('你貌似在逗我，没有看到页面提示么，给我滚回去！')</script>";
            }
            
        } 
        
      
            
        
    }
}
