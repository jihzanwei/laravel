@extends('layout.aadmin')
@section('title','绑定账号')
@section('content')
		<center>
			<h2>绑定账号</h2>
		<form class="form-inline" action="{{url('aadmin/do_insert')}}" method='post'>
			@csrf
		<tr>
			<td>
			账号：<input type="text" name ='name'>
			</td>
			<td>
			密码：<input type="password" name ='pwd'>
			</td>
			<button type="submit"class="btn btn-primary block full-width m-b">登 录</button>
		</tr>
		</form>
		</center>
@endsection