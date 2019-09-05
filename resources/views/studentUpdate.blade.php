<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>修改</title>
</head>
<body>
    <center>
        <form action="{{url('student/do_update')}}" method="post">
        @csrf
        <input type="hidden" name="id" value="{{$student_info->id}}">
            学生名字<input type="text" name="name" value="{{$student_info->name}}"><br>
            学生年龄<input type="text" name="age" value="{{$student_info->age}}"><br>
            <input type="submit" value="修改">
        </form>
    </center>
</body>
</html>