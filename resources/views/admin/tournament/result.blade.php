
<center>
<h1>竞猜结果</h1>
<h2>对阵结果：</h2>{{$one}} <b>{{$guess_result}}</b> {{$two}}
<h3>你的竞猜：</h3>{{$one}} <b>{{$guesss}}</b> {{$two}}
<h3>结果：
    @if($guess_result==$guesss)
    <h3>兄嘚，猜对了！</h3>
    @else
    <h3>哎呀，你猜错了！</h3>
    @endif
</h3>
</center>