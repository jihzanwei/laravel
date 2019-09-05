
@extends('layout.goodsparent')
@section('title','考试题列表')
@section('body')


<table class="layui-table">
  <colgroup>
    <col width="150">
    <col width="200">
    <col>
  </colgroup>
  <thead>
    <tr>
      <th>id</th>
      <th>title</th>
      <th>answer</th>
      <th>添加时间</th>
      <th>操作</th>
    </tr> 
  </thead>
  <tbody>
  
    <tr>
    @foreach($data as $key=>$item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->title }}</td>         
                <td>{{ $item->answer}}</td>
                <td>{{date('Y-m-d H:i:s',$item->add_time)}}</td>
                <td><a href="{{url('exam/detail')}}?id={{$item->id}}">详情</a></td>
            </tr>
            @endforeach
    </tr>
  </tbody>
</table>
@endsection

