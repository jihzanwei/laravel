<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<center>
<h1>新闻添加</h1>
<form action="{{url('news/do_add_news')}}" method="post" enctype="multipart/form-data">
@if($errors->any())
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
@endif
@csrf
    <table border=1>
        <tr>
            <td>新闻标题</td>
            <td><input type="text" name="news_title"></td>
        </tr>
        <tr>
            <td>作者</td>
            <td><input type="text" name="author"></td>
        </tr>
        <tr>
            <td>新闻详情</td>
            <td><textarea name="news_content" id="" cols="30" rows="10"></textarea></td>
        </tr>
        <tr>
            <td>图片</td>
            <td>提交商品<input type="file" name="goods_pic"></td>
        </tr>
        <tr>
            <td>提交</td>
            <td><input type="submit" value="添加"></td>
        </tr>
    </table>
</form>
    
</center>

</body>
</html>