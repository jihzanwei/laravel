    <center>
    <form action="{{url('naccess/do_naccess_push')}}" method="post">
        @csrf
        消息推送：
        <select name="push_type" id="">
            <option value="1">文本消息</option>
            <option value="2">图片消息</option>
        </select>
        <br/><br/><br/>
        <input type="hidden" name="tag_id" value="{{$tag_id}}">
        消息内容: <textarea name="message" id="" cols="30" rows="10"></textarea>
        <br/><br/><br/>
        素材ID：<input type="text" name="media_id" id="">
        <br/><br/><br/>
        <input type="submit" value="提交">
    </form>
    </center>