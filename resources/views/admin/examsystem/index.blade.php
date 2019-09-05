<script src="/mstore/js/jquery.min.js"></script>

<input type="hidden" name="session" class="session" value="{{Session::get('name')}}">

<center><h1>添加题库</h1></center>
<center>
<form action="{{url('admin/exam/add')}}">
    <select name="type">
    <option value="">--请选择--</option>
    @foreach($data as $v)
        <option value="{{$v->type}}" id="achoice">{{$v->type}}</option>
        @endforeach
        <!-- <option value="单选" id="achoice">单选</option>
        <option value="多选" id="bchoice">多选</option>
        <option value="判断" id="cchoice">判断</option> -->
    </select>
    <input type="submit" value="添加题库">
    </form>
</center>
<script>
var session=$('.session').val();

//  console.log(session);return false;

    if(session==""){
            alert('请先登录');
            location.href="{{url('admin/exam/login')}}";
        }
        // alert('您已经进入后台考试系统')
        // $('#achoice').click(function(){
        //     // alert(111)
            
        //     location.href="{{url('admin/exam/aadd')}}";
        // });
</script>