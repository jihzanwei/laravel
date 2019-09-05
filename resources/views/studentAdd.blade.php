<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>学生添加</title>
</head>
<body>
    <center>
    @if($errors->any())
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif
        <form action="{{url('student/do_add')}}" method="post">
        @csrf
            学生名：<input type="text" name="name"><br>
            年龄：<input type="text" name="age"><br>
            性别：<input type="radio" name="sex" id="" value="男" checked>男
           <input type="radio" name="sex" id="" value="女">女<br>
            <input type="submit" value="提交">

        </form>
    </center>
</body>
</html>