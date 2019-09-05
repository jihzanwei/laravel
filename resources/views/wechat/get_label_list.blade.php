@extends('layout.admin')
@section('title','列表页面')
@section('body')
    <center>
        <h3><a href="{{url('wechat/get_label')}}">添加标签</a></h3>
        <h3><a href="{{url('wechat/index')}}">粉丝列表</a></h3>
        <h3><a href="{{url('wechat/ticket')}}">生成公众号二维码</a></h3>
        <br />
        <br />
        <br />
        <table border="3" width="50%">
            <tr>
                <th>ID</th>
                <th>标签名</th>
                <th>标签下粉丝数</th>
                <th>操作</th>
            </tr>
            @foreach($info as $v)
            <tr>
                <td>{{$v->id}}</td>
                <td>{{$v->name}}</td>
                <td>{{$v->count}}</td>
                <td>
                    <a href="{{url('wechat/tang_del')}}?id={{$v->id}}">删除</a> |
                    <a href="{{url('wechat/tang_user')}}?id={{$v->id}}">该标签下的粉丝列表</a>   |
                    <a href="{{url('wechat/index')}}?tag_id={{$v->id}}">为粉丝打标签</a> |
                    <a href="{{url('wechat/get_update',['name'=>$v->name])}}?id={{$v->id}}">编辑</a> |
                    <a href="{{url('wechat/push_tang')}}?tag_id={{$v->id}}">消息推送</a>
                </td>
            </tr>
            @endforeach
        </table>
    </center>
@endsection