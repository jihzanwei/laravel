@extends('layout.admin')
@section('title','微信上传素材')
@section('body')
    <form action="{{url('wechat/do_upload')}}" method="post" enctype="multipart/form-data" align="center">
        @csrf
        素材类型：<select name="up_type" id="">
            <option value="1">临时</option>
            <option value="2">永久</option>
        </select></br></br>
        <span>上传图片</span>
        文件：<input type="file" name="image" id=""></br></br>
        <span>上传语音</span>
        文件：<input type="file" name="voice" id=""></br></br>
        <span>上传视频</span>
        文件：<input type="file" name="video" id=""></br></br>
        <span>上传缩略图</span>
        文件：<input type="file" name="thumb" id=""></br></br>
        <input type="submit" value="上传">
    </form>
@endsection