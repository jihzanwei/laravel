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
    <h1>详情页</h1><table border=1>
       题目：{{$data->title}} <br>
        <tr>
            <td>A:</td>
            <td>{{$data->a}}</td>
        </tr> 
        <tr>
            <td>B:</td>
            <td>{{$data->b}}</td>
        </tr>
        <tr>
            <td>C:</td>
            <td>{{$data->c}}</td>
        </tr>
        <tr>
            <td>D:</td>
            <td>{{$data->d}}</td>
        </tr>
        <tr>
            <td>正确答案：</td>
            <td>{{$data->answer}}</td>
        </tr>
       
       
    </table></center>
</body>
</html>