@extends('layout.goodsparent')
@section('title','车票添加')
@section('body')
<center>
    <form action="{{url('admin/do_add_ticket')}}" method="post">
    @csrf
        <table border=1>
            <tr>
                <td>车次</td>
                <td><input type="text" name='carnum'></td>
            </tr>
            <tr>
                <td>出发地</td>
                <td><input type="text" name="start_place"></td>
            </tr>
            <tr>
                <td>目的地</td>
                <td><input type="text" name="end_place"></td>
            </tr>
            <tr>
                <td>价钱</td>
                <td><input type="text" name="price"></td>
            </tr>
            <tr>
                <td>张数</td>
                <td><input type="text" name="number"></td>
            </tr>
            <tr>
                <td>出发时间/到达时间</td>
                <td><input type="text" name="time"></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                <input type="submit" value="添加"></td>
            </tr>
        </table>
    </form>
</center>
@endsection