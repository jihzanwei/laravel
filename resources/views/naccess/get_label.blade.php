
    <form action="{{url('naccess/do_get_label')}}" method="post" align="center">
        @csrf
        标签名：<input type="text" name="name" id=""></br></br>
        <input type="submit" value="提交">
    </form>
