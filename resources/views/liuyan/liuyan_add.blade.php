
<html lang="en">
<head>
    <title>留言</title>
</head>
<body>
<center>
    <h2>留言</h2>
    
    <form action="{{url('liuyan/liuyan_doadd')}}" method="post">
      <input type="hidden" value="{{$id}}" name="id">
        @csrf

    <table border="6" align="center">
       <textarea name="send_info" id="" cols="50" rows="20"></textarea>

       <button>提交</button>
    </table>

</form>
</center>
</body>
</html>
