<!DOCTYPE html>
<html lang="en">
<head>
<script src="/mstore/js/jquery.min.js"></script>
<link rel="stylesheet" href="/css/page.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <input type="hidden" name="session" class="session" value="{{Session::get('name')}}">
    <button class='addnews'>新闻添加</button>
    <center>
    <h1>新闻列表</h1>

        <table border=1>
      
            <tr>
                <td>id</td>
                <td>新闻标题</td>
                <td>作者</td>
                <td>详情</td>
                <td>新闻图片</td>
                <td>添加时间</td>
                <td>操作</td>
            </tr>
            @foreach($data as $v)
            <tr>
                <th>{{$v->id}}</th>
                <th>{{$v->news_title}}</th>
                <th>{{$v->author}}</th>
                <th>{{$v->news_content}}</th>
                <th><img src="{{asset($v->goods_pic)}}" style="width:200px;height:100px;" id="img"/></th>
                <th>{{date('Y-m-d H:i:s',$v->add_time)}}</th>
                <th><button class="delete" href="{{url('news/delete')}}?id={{$v->id}}">删除</button>
                    <a href="{{url('news/show')}}?id={{$v->id}}">前往详情页</a>
                </th>
            </tr>

        @endforeach
        </table>
        <center>{{ $data->links() }}</center>
        
    </center>
</body>
</html>
    <script>
    var session=$('.session').val();
    // alert(session)
        // alert($('.session').val())
        if($('.session').val()==''){
            alert('请先登录')
            location.href="{{url('news/login')}}"
        }
        $('.addnews').click(function(){
            location.href="{{url('news/add_news')}}"
        })
        $('.delete').click(function(){
           var a = $(this).parent().prev().prev().prev().prev().text();
        //    alert(a)
            var id=$(this).parent().prev().prev().prev().prev().prev().prev().text();
            // alert(id)
        if(a!==session){
            alert('你只能删除自己的新闻');die();
        }else{
            location.href="{{url('news/delete')}}?id={{$v->id}}"
        }
     
            
        })
    </script>