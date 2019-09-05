<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<h1>登陆</h1>
	<form action="" method='post'>
		<tr>
			<td>
				用户名：<input type="text" name = 'name'>
			</td>
		</tr>
		<tr>
			<td>
				密码：<input type="text" name = 'password'>
			</td>
		</tr>
		<tr>
			<td>
				<a href="{{url('/liuyan/login')}}">登录</a>
			</td>
		</tr>
	</form>
	
</body>
</html>