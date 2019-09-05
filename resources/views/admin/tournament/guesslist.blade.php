<script src="/mstore/js/jquery.min.js"></script>

<center>
    <h1><b>竞猜结果</b> </h1>
    @foreach($data as $v)
    <table border=1>
        <tr>
       
            <td><span>{{$v->one}}</span> <b>vs</b> <span>{{$v->two}}</span></td>
            @if($time > $v->guess_time)
            <a href="{{url('admin/tournament/result')}}?id={{$v->id}}">查看结果</a>
            @else
            <a href="{{url('admin/tournament/guessing')}}?id={{$v->id}}">竞猜</a>
            @endif
        </tr>
       
    </table>
        
    @endforeach
</center>

<script>
  
</script>