@extends('layout.admin')
@section('title','用户添加页面')
@section('body')
    <form action="{{url('agent/do_add')}}" method="post" align="center">
        @csrf
        用户名：<input type="text" name="name" id=""><br/><br/>
        <input type="submit" value="添加">
    </form>
@endsection