@extends('layout.goodsparent')
@section('title','添加商品')
@section('body')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>添加</title>
</head>
<body>
    <center>
    @if($errors->any())
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif
        <form method="post" action="{{url('/admin/do_add_goods')}}" enctype="multipart/form-data">
            @csrf
            <h1>添加</h1><br>
        <table>
            商品名称<input type="text" name="goods_name"><br><br>
            提交商品<input type="file" name="goods_pic"><br> <br>
            商品价格<input type="text" name="goods_price"><br>
            商品库存<input type="text" name="goods_number"><br>
            <input type="submit" value="提交">
        </table>
        </form>
    </center>
</body>
</html>
@endsection