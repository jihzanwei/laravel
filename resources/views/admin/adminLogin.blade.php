<center><h1>·后台登陆·</h1><h3>警告：只有拥有管理员权限的用户才拥有访问此后台的资格！！！</h3>
Warning: Only users with administrator privileges are eligible to access this background!!!</center>
<form action="{{url('admin/do_login')}}">
<center>
    <table border="1">   
        <tr>
            <td>管理员名称<input type="text" name="name"></td>
            <td>密码<input type="password" name="password" id=""></td>
            <td><input type="submit" value="登录"></td>
        </tr>
        <br><br><br><br>
    </table>
    </center>
    
</form>