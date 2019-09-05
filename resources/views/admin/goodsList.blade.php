
@extends('layout.goodsparent')
@section('title','商品列表')
@section('body')
{{Session::get('username')}}
<form action="{{url('admin/goods')}}" method="get">
            姓名：<input type="text" name="search" value="{{$search}}">
            <input type="submit" value="搜索">
        </form>
<table class="layui-table">
  <colgroup>
    <col width="150">
    <col width="200">
    <col>
  </colgroup>
  <thead>
    <tr>
      <th>id</th>
      <th>name</th>
      <th>pic</th>
      <th>price</th>
      <th>number</th>
      <th>添加时间</th>
      <th>操作</th>
    </tr> 
  </thead>
  <tbody>
  
    <tr>
    @foreach($goods as $key=>$item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->goods_name }}</td>
                <td><img src="{{asset($item->goods_pic)}}" id="img"/></td>
                <td>{{ $item->goods_price}}</td>
                <td>{{ $item->goods_number }}</td>
                <td>{{date('Y-m-d H:i:s',$item->add_time)}}</td>
                <td>
                    <a href="{{url('admin/update')}}?id={{$item->id}}">修改</a>|<a href="{{url('admin/delete')}}?id={{$item->id}}">删除</a>
                </td>
            </tr>
            @endforeach
    </tr>
  </tbody>
</table>
    <center>{{ $goods->links() }}</center>
@endsection

@section('js')

@endsection