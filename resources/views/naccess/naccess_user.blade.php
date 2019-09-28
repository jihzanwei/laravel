    <h1>
    <table align="center" border="1">
        <tr>
            <th>粉丝列表</th>
        </tr>
        @foreach($arr as $v)
        <tr>
            <td>{{$v}}</td>
        </tr>
        @endforeach
    </table>
    </h1>