<center>
<h1>比赛结果</h1>
@foreach($data as $v)
<table>
    <tr>
    {{$v->guess_result}}
        <h3>{{$v->one}}</h3> vs <h3>{{$v->two}}</h3> 
        <!-- @if($v->guess_result=='胜') -->
        <!-- <input type="radio" name="guess_result" id="" value="胜" checked="checked">胜
        <input type="radio" name="guess_result" id="" value="负">负
        <input type="radio" name="guess_result" id="" value="平">平<br> -->
<!-- ------------------
        @elseif($v->guess_result=='负')
        <!-- <input type="radio" name="guess_result" id="" value="胜">胜
        <input type="radio" name="guess_result" id="" value="负" checked>负
        <input type="radio" name="guess_result" id="" value="平">平<br> -->

        <!-- @elseif($v->guess_result=='平') -->
        <!-- <input type="radio" name="guess_result" id="" value="胜">胜
        <input type="radio" name="guess_result" id="" value="负">负
        <input type="radio" name="guess_result" id="" value="平" checked>平<br> -->

        <!-- @endif -->
        --------------------------------------
    </tr>
</table>
@endforeach
</center>