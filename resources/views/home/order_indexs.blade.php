@extends('layout.parent')
@section('pages_section')
<table align="center" border=1>
	<tr>
		<td>订单号</td>
		<td>订单状态</td>
		<td>收货人姓名</td>
		<td>收货人邮件</td>
		<td>收货人电话</td>
		<td>订单添加时间</td>
		<td>操作</td>
		<td>距订单过期还有</td>
	</tr>
	@foreach($data as $item)
	<tr>
		<td>{{$item->oid}}</td>
		<td>
			@if($item->state==1)
			未支付
			@elseif($item==2)
			已支付
			@else
			已过期
			@endif
		</td>
		<td>{{$item->address_name}}</td>
		<td>{{$item->address_email}}</td>
		<td>{{$item->address_tel}}</td>
		<td>{{date('Y-m-d H:i:s',$item->add_time)}}</td>
		<td>
			<a href="{{url('pay')}}?oid={{$item->oid}}">去付款</a>
		</td>
		<td id="go">30s</td>
	</tr>
	@section('footer')
	@endsection
	@endforeach
</table>
@endsection
@section('js')
<script>

	$(function(){
		// alert($);
		var now={{$now}};
		// alert(now);
		
		

	});
</script>
@endsection