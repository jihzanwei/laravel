<center><h1><b>添加竞猜球队</b></h1>
@if($errors->any())
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif
<form action="{{url('admin/tournament/do_add')}}">
    <table>
        <tr>
            <input type="text" name="one" id="one"> VS <input type="text" name="two" id="two"><br><br>
            <b>结束竞猜时间</b><input type="text" name="guess_time"><br>
            <input type="submit" value="添加">
        </tr>
    </table>
</form></center>
<script src="/mstore/js/jquery.min.js"></script>
<script>
  
</script>