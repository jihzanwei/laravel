<!DOCTYPE html>
<html lang="en">
<head>
    <script src="/mstore/js/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <input type="hidden" name="session" class="session" value="{{Session::get('name')}}">
    
</body>
</html>
<script>
   var session=$('.session').val();
//    alert(session)
if(session==''){
    alert('请先登录')
    location.href="{{url('admin/parking/login')}}"
}
</script>