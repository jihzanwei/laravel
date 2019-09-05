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
<center><table>
@foreach($data as $v)
<tr>
<td>{{$v->survey}}</td>
<td><a id="use" "{{url('admin/survey/use')}}?id={{$v->id}}">启用</a></td>
<td><a href="">删除</a></td>
</tr>
@endforeach
</table>
    </center>

</body>
</html>
<script>
    $('#use').click(function(){
       
</script>