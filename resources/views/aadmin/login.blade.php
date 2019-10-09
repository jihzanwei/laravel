
<!DOCTYPE html>
<html>

<head>
<base href="/hadmin/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <title> - 登录</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico"> <link href="css/bootstrap.min.css?v=3.3.6" rel="stylesheet">
    <link href="css/font-awesome.css?v=4.4.0" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css?v=4.1.0" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
</head>

<body class="gray-bg">/
    @csrf
    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">h</h1>

            </div>
            <h3>欢迎使用 hAdmin</h3>

            <form class="m-t" role="form">
                <div class="form-group">
                    <input type="text" id= 'name'class="form-control" placeholder="用户名" >
                </div>
                <div class="form-group">
                    <input type="password"id= 'pwd' class="form-control" placeholder="密码" >
                </div>
                 <div class="form-group">
                    <input type="text"  id = 'code' class="form-control" placeholder="验证码">
                    <input type="button" id='q'  class="btn btn-primary block full-width m-b" value = "获取验证码" >

                </div>
                <button type="submit" id='a' class="btn btn-primary block full-width m-b">登 录</button>

                
                <img alt="image" class="img-circle" src="img\123.jpg">  
                <p class="text-muted text-center"> <a href="login.html#"><small>忘记密码了？</small></a> | <a href="register.html">注册一个新账号</a>
                </p>

            </form>
        </div>
    </div>

    <!-- 全局js -->
    <script src="{{asset('/js/jquery.min.js?v=2.1.4')}}"></script>
    <script src="{{asset('/js/bootstrap.min.js?v=3.3.6')}}"></script>
    
    <script>
     $(function(){
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });

         $('#q').click(function(){
        // alert(111);die;
        var name=$('#name').val();
        var pwd=$('#pwd').val();
        // alert(11)
//        var tel=$('#tel').val();
        // alert(cart)
        $.ajax({
            url: "{{url('aadmin/do_code')}}" ,
            type: 'POST',
            data: {name:name,pwd:pwd},
            dataType: 'json',
            success: function(data){
                alert(data.content);
            }
        });
        return false;
    });


    $('#a').click(function(){
        var code=$('#code').val();
        $.ajax({
            url: "{{url('aadmin/send_code')}}" ,
            type: 'POST',
            data: {code:code},
            dataType: 'json',
            success: function(data){
                alert(data.content);
            }
        });
        return false;
    });
    $('#q').click(function(){
        var name=$('#name').val();
        var password=$('#password').val();
        // alert(11)
//        var tel=$('#tel').val();
        // alert(cart)
        $.ajax({
            url: "{{url('aadmin/do_code')}}" ,
            type: 'POST',
            data: {name:name,password:password},
            dataType: 'json',
            success: function(data){
                alert(data.content);
            }
        });
        return false;
    });


    $('#a').click(function(){
        var code=$('#code').val();
        $.ajax({
            url: "{{url('aadmin/send_code')}}" ,
            type: 'POST',
            data: {code:code},
            dataType: 'json',
            success: function(data){
                alert(data.content);
            }
        });
        return false;
    })

    });
    

</script>
    
    

</body>


</html>
