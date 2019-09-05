<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <center>
        <h1>车库管理系统</h1>
        <h3>小区车位：<span id="have">{{$number}}</span></h3>
        <h3>剩余车位：<span id="residue">{{$number}}</span></h3>
        <button id="entry">车辆入库</button>
        <button id="out">车辆出库</button>
    </center>
</body>
</html>
<script src="/mstore/js/jquery.min.js"></script>
<script>
    $('#entry').click(function(){
        location.href="{{url('parking/entry')}}"
    });
</script>