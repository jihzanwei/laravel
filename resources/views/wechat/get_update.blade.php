@extends('layout.admin')
@section('title','修改页面')
@section('body')
    <form action="{{url('wechat/do_get_update')}}" method="post" align="center">
        @csrf
        <input type="hidden" name="id" value="{{$data['id']}}">
        标签名：<input type="text" name="name" value="{{$name}}" id=""></br></br>
        <input type="submit" value="修改">
    </form>
@endsection