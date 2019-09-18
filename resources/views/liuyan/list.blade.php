
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<center>
 
    <form action="{{url('liuyan/liuyan_add')}}" method="post">
        @csrf
       
    <table border="6" align="center">
        <h1>粉丝列表</h1>
                      
        <tr><th></th>
            <th>id</th>
            <th>名字</th>
            <th>openid</th>
            
        </tr>
        @foreach($data as $v)

        <tr>
            <td>
              <input type="checkbox" name="id_list[]" value="{{$v->openid}}"> 
            </td> 
            <td>{{$v->id}}</td>
            <td>{{$v->nickname}}</td>
            <td>{{$v->openid}}</td>
             
        </tr>
        @endforeach
    </table>
        <td><button>发送留言</button></td>
</form>
</center>

</body>
</html>
