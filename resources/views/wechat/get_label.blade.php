@extends('layout.admin')
@section('title','添加页面')
@section('body')
    <form action="{{url('wechat/do_get_label')}}" method="post" align="center">
        @csrf
        标签名：<input type="text" name="name" id=""></br></br>
        <input type="submit" value="提交">
    </form>
@endsection