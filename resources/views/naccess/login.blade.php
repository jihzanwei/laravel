<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>登录</h3>
    <form action="">
       
        <button type="button" class="stu">提交</button>
    </form>
    <script src="/js/app.js"></script>
    <script>
        $(function(){
            $('.stu').click(function(){
                window.location.href="{{url('naccess/do_login')}}";
            })
        })
    </script>
</body>
</html>