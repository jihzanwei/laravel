@extends('layout.admin')
@section('title','用户粉丝列表')
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
<center>
    <h2><a href="{{url('wechat/index')}}">刷新粉丝列表</a></h2>
    <h2><a href="{{url('wechat/get_label_list')}}">公众号列表</a></h2>
    <h1>粉丝列表</h1>
    <form action="{{url('wechat/add_tang')}}" method="post">
        @csrf
        <input type="hidden" name="tagid" value="{{$tag_id}}">
    <table border="1" align="center">
        <tr>
            <th>选择</th>
            <th>编号</th>
            <th>时间</th>
            <th>名字</th>
            <th>是否关注</th>
            <th>备注</th>
            <th>操作</th>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>
                <input type="checkbox" name="id_list[]" value="{{$v->id}}">
            </td>
            <td>{{$v->id}}</td>
            <td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
            <td>{{$v->nickname}}</td>
            <td>
                @if(($v->subscribe)==1)
                已关注
                @else
                未关注
                @endif
            </td>
            <td>
                <a href="{{url('wechat/tang',['id'=>$v->id])}}">查看详情</a>
            </td>
            <td>
                <a href="{{url('wechat/get_user_tang')}}?openid={{$v->openid}}">获取标签</a>
            </td>
        </tr>
        @endforeach
    </table>

    <input type="submit" value="提交">
</form>
</center>
</body>
</html>
@endsection