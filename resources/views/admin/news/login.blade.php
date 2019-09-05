<center>
    <h1>后台登录</h1>
    <form action="{{url('news/do_login')}}">
        <table border=1>
            <tr>
                <td>用户名</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>密码</td>
                <td><input type="password" name="password" id=""></td>
            </tr>
            <tr>
            
                <td colspan="2"><input type="submit" value="登录">
            </tr>
        </table>
    </form>
</center>