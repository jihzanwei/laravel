@extends('layout.admin')
@section('title','用户推广列表页面')
@section('body')
    <h2 align="center"><a href="{{url('agent/user_list')}}">用户列表</a></h2>
    <br/><br/>
    <table align="center" border="1">
        <tr>
            <th>推广ID</th>
            <th>扫过的人数</th>
            <th>OPENID</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        @foreach($obj as $v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->uid}}</td>
            <td>{{$v->openid}}</td>
            <td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
            <td></td>
        </tr>
        @endforeach
    </table>
@endsection