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
    <h2><a href="{{url('wechat/get_label_list')}}">公众号粉丝列表</a></h2>
    <form action="{{url('wechat/add_get_list')}}" method="post">
        @csrf
       
    <table border="6" align="center">
        <tr>
                        
            <th>id</th>
            <th>名字</th>
            <th>操作</th>
        </tr>
        @foreach($data as $v)
        <tr>
        
            <td>{{$v->id}}</td>
            <td>{{$v->nickname}}</td>
            <td><a href="{{url('liuyan/liuyanadd',$id=$v->id)}}">留言</a></td>
           
           
        </tr>
        @endforeach
    </table>

</form>
</center>
</body>
</html>
@endsection