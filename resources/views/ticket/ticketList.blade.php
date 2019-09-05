@extends('layout.goodsparent')

@section('title','列表')

@section('body')

<form action="" method="get">
            出发地：<input type="text" name="start_place" value="{{$start_place}}">
            目的地：<input type="text" name="end_place" value="{{$end_place}}">
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
      <th>车次</th>
      <th>出发地</th>
      <th>目的地</th>
      <th>price</th>
      <th>剩余张数</th>
      <th>添加时间</th>
        <th>操作</th>
    </tr> 
  </thead>
  <tbody>
  @foreach($data as $key=>$item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->carnum}}</td>
            <td>{{$item->start_place}}</td>
            <td>{{$item->end_place}}</td>
            <td>￥{{$item->price}}</td>

            <td>
            @if($item->number>100)
            有
            @elseif($item->number==0)
            无
            @else
            {{$item->number}}
            @endif
            </td>
            <td>{{date('Y-m-d H:i:s',$item->add_time)}}</td>
            <td>
                @if($item->number==0)
                <button disabled>预定</button>
                @else
                <button>购买</button>
                @endif
            </td>
        </tr>
    @endforeach
  </tbody>
</table>

@endsection
<script src="/mstore/js/jquery.min.js"></script>
@section('js')
    <script>
        $('.buy').click(function(){
            var _this=$(this);
  
            $num=$(this).parent().prev().prev().text();
            // alert($num)
            // if($num==0){
                
            // }
        })
    </script>
@endsection
