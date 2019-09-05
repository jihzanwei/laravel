<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<center><h1>添加车辆总数</h1>
<form action="{{url('admin/parking/do_add_cartnumber')}}" method="post">
@csrf
数量：<input type="text" name="number"><br><br>
    <input type="submit" value="添加">
</form>

</center>
    
</body>
</html>