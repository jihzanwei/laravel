<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>用户名详细</title>
</head>
<link rel="stylesheet" type="text/css" href="{{asset('css/page.css')}}">
<body>

    <table border=1>
        <tr>
            <td>用户openid</td>
            <td>用户名</td>
            <td>用户头像</td>
          
        </tr>
    	@foreach($data as $k=>$v)
        <tr>
            <td>{{$v['openid']}}</td>
            <td>{{$v['nickname']}}</td>
            <td>
            	<img src="{{$v['headimgurl']}}">
            </td>
          
        </tr>
    	@endforeach
    </table>
</body>
</html>
