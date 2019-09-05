<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登录</title>
</head>
<body>
   <center>
   <form action="{{url('admin/exam/do_login')}}" method="post">
   @csrf
   <table>

        <input type="text" name="name"><br>
        <input type="password" name="password"><br>
        <input type="submit" value="登录">

    </table>
    </form>
   </center>
</body>
</html>