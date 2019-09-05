<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>修改</title>
</head>
<body>

    <center>
        <form action="{{url('admin/do_update')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$goods_info->id}}">
            商品名称<input type="text" name="goods_name" value="{{$goods_info->goods_name}}"><br>
            商品价格<input type="text" name="goods_price" value="{{$goods_info->goods_price}}"><br>
            商品库存<input type="text" name="goods_number" value="{{$goods_info->goods_number}}"><br>
            <img style="width:400px;height:500px;" name="goods_pic" src="{{asset($goods_info->goods_pic)}}" alt=""><br>
            <input type="submit" value="修改">
        </form>
    </center>
</body>
</html>