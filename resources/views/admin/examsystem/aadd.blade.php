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
<form action="{{url('admin/exam/do_aadd')}}" method="get">

<table>
<tr>
        <td>
            <input type="text" name="title">    <br>
            <input type="radio" name="answer" value="a" id="">a  <input type="text" name="a"><br>
            <input type="radio" name="answer" value="b" id="" >b <input type="text" name="b"><br>
            <input type="radio" name="answer" value="c" id="">c <input type="text"name="c"><br>
            <input type="radio" name="answer" value="d" id="">d <input type="text" name="d"><br>
        </td>
        <td>
            <input type="submit" value="添加题目">
        </td>
</tr>
<div id="box">
            <span>多选</span><br/>
            题目：<input type="text" name="box" value=""><br/>
            A:<input type="checkbox" name="box_answer[]" value="1">
            <input type="text" name="box_a"><br/>
            B:<input type="checkbox" name="box_answer[]" value="2">
            <input type="text" name="box_c"><br/>
            C:<input type="checkbox" name="box_answer[]" value="3">
            <input type="text" name="box_b"><br/>
            D:<input type="checkbox" name="box_answer[]" value="4">
            <input type="text" name="box_d"><br/>
        </div>

</table>
   </form>

</center>
</body>
</html>