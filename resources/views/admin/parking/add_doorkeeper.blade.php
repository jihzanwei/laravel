<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<center>

<h1>请添加看大门的老大爷！</h1>
<form method="post" action="{{url('admin/parking/do_add_doorkeeper')}}">
@csrf
    <table>
        <tr>
            老大爷名称：<input type="text" name="doorkeeper_name"><br>
            密码：<input type="password" name="password" id=""><br>
            <input type="submit" value="添加老大爷">
        </tr>
    </table>
</form>
    
</center>
</body>
</html>


<script src="/mstore/js/jquery.min.js"></script>
<script>
    
</script>