@extends('layout.admin')
@section('title','用户列表页面')
@section('body')
    <h2 align="center"><a href="{{url('agent/add')}}">用户添加</a></h2>
    <table border="1" align="center">
        <tr>
            <th>用户uid</th>
            <th>用户名</th>
            <th>用户专属二维码</th>
            <th>操作</th>
        </tr>
        @foreach($tang as $v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->name}}</td>
            <td>
                @if(($v->qrcode_url)=='')
                尚未生成
                @else
                    <img src="{{$v->qrcode_url}}" width="100" height="100" alt="">
                @endif
            </td>
            <td>
                <a href="{{url('agent/creat_qrcode')}}?id={{$v->id}}">生成用户专属二维码</a> |
                <a href="{{url('agent/agent_list')}}?id={{$v->id}}">用户推广用户列表</a> |
                @if(($v->agent_code)=='')
                还未生成
                @else
                <a href="{{$v->qrcode_url}}"> 查看二维码</a>
                @endif
            </td>
        </tr>
        @endforeach    
    </table>
@endsection