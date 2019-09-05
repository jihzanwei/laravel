@extends('layout.admin')
@section('title','用户粉丝列表')
@section('body')
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>留言</title>
</head>
<body>
<center>
    <h2>留言</h2>
    
    <form action="{{url('liuyan/liuyan_doadd')}}" method="post">
        @csrf
       
    <table border="6" align="center">
       <textarea name="" id="" cols="50" rows="20"></textarea>

       <button>提交</button>
    </table>

</form>
</center>
</body>
</html>
@endsection