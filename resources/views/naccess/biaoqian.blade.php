  <center>
        <h3><a href="{{url('naccess/get_label')}}">添加标签</a></h3>
        <h3><a href="{{url('naccess/get_list')}}">粉丝列表</a></h3>
        <br />
        <br />
        <table border="3" width="50%">
            <tr>
                <th>ID</th>
                <th>标签名</th>
                <th>标签下粉丝数</th>
                <th>操作</th>
            </tr>
            @foreach($info as $v)
            <tr>
                <td>{{$v->id}}</td>
                <td>{{$v->name}}</td>
                <td>{{$v->count}}</td>
                <td>
                    <a href="{{url('naccess/naccess_del')}}?id={{$v->id}}">删除该标签</a> |
                    <a href="{{url('naccess/naccess_user')}}?id={{$v->id}}">该标签下的粉丝列表</a>   |
                    <a href="{{url('naccess/index')}}?tag_id={{$v->id}}">为粉丝打标签</a> |
                    <a href="{{url('naccess/update',['name'=>$v->name])}}?id={{$v->id}}">编辑</a> |
                    <a href="{{url('naccess/naccess_push')}}?tag_id={{$v->id}}">消息推送</a>
                </td>
            </tr>
            @endforeach
        </table>
    </center>