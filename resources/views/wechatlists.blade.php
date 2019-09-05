<center>
  <table border=1>
    <tr>
      <th>id</th>
      <th>openid</th>
      <th>操作</th>
    </tr>
    @foreach($data as $v)
    <tr>
      <td>{{$v->id}}</td>
      <td>{{$v->openid}}</td>
      <td><a href="{{url('wechat/detail')}}?id={{$v->id}}">详情</a></td>
    </tr>
    @endforeach
  </table>

</center>
