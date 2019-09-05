@extends('layout.admin')
@section('title','添加页面')
@section('body')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<table>
		<form action="{{url('kaoshi/do_kaoshi')}}" method="post">
			@csrf
			<h3>课程添加</h3>
			<tr>
				
				
				<td>
				第一节课：
				<select name="one" id="">
					<option value="1">php</option>
					<option value="2">java</option>
					<option value="3">语文</option>
					<option value="4">生物</option>
				</select>
				</td>
				<td>
					第二节课：
					<select name="two" id="" >
						    <option value="1">php</option>
							<option value="2">java</option>
							<option value="3">语文</option>
							<option value="4">生物</option>
					</select>
				</td>
				<td>
							第3节课：
					<select name="three" id="" >
						    <option value="1">php</option>
							<option value="2">java</option>
							<option value="3">语文</option>
							<option value="4">生物</option>
					</select>
					
				</td>
				<td>
							第4节课：
					<select name="four" id="" >
						    <option value="1">php</option>
							<option value="2">java</option>
							<option value="3">语文</option>
							<option value="4">生物</option>
					</select>
				</td>
				<td>
				<button>提交</button>
				</td>
			</tr>
		</form>
	</table>
</body>
</html>
@endsection