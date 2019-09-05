<center>
<h1>比赛结果</h1>
请下注
<form action="{{url('admin/tournament/do_add_guessing')}}">
<h2><input type="text" value="{{$one}}" name="one">   vs <span><input type="text" name="two" value="{{$two}}"></h2>
<input type="radio" name="guess_result" id="" value="胜" checked>胜
<input type="radio" name="guess_result" id="" value="负">负
<input type="radio" name="guess_result" id="" value="平">平<br><br>
<input type="submit" value="确认竞猜"></form>
</center>