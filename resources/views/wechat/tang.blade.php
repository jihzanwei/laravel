@extends('layout.admin')
@section('title','用户粉丝详情')
@section('body')
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table align="center" border="1">
        <tr>
            <th>编号</th>
            <th>OPENID</th>
            <th>名字</th>
            <th>头像</th>
            <th>操作</th>
        </tr>
        <tr>
            <td>{{$data->id}}</td>
            <td>{{$data->openid}}</td>
            <td>{{$data->nickname}}</td>
            <td>
                <img src="{{$data->headimgurl}}" width="80" height="80" alt="">
            </td>
            <td>
                <a href="{{url('wechat/index')}}">返回</a>
            </td>
        </tr>
    </table>
</body>
</html>
@endsection