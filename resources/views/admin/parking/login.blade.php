@extends('layout.goodsparent')
@section('body')
<center>
    我是车车管理员，美滋滋！
<h1>物业管理员登录</h1>
<form action="{{url('admin/parking/do_login')}}">
    <table border=1>
        <tr>
           <td> 用户名：<input type="text" name="name"></td>
            <td>密码：  <input type="password" name="password"></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="登录"></td> 
        </tr>
    </table></form>
</center>
    

@endsection