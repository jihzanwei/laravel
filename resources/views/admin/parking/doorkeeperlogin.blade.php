<center>
    <h1>门卫登录</h1>
    <form action="{{url('parking/do_doorkeeperlogin')}}" method="post">
    @csrf
        账户<input type="text" name="doorkeeper_name">
        密码<input type="password" name="password" id="">
        <input type="submit" value="登录">
    </form>
    
</center>