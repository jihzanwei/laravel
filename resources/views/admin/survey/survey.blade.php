<!DOCTYPE html>
<html lang="en">
<head>
<script src="/mstore/js/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <center>
        <!-- <select name="survey">
            <option value="">--请选择--</option>
            @foreach($data as $v)
            <option class="option" value="{{$v->id}}">{{$v->survey}}</option>
            @endforeach
        </select><br> -->
        <form action="{{url('add_survey')}}">
        <table border=1>
        <tr>
        <td align="center">调查卷</td>  
        
        </tr>  
        
        
        @foreach($data as $v)
           <tr>
                <td>
                <input type="radio" value="{{$v->id}}" name="survey" class="radio">
                {{$v->survey}}
                </td>
           </tr>
      
            @endforeach
        </table>
        </form>
       
    </center>
</body>
</html>
<script>
$(function(){
    $('.radio').click(function(){
        var id=$(this).val()
        location.href="{{url('admin/survey/surveys')}}?id="+id
    });
})
   
</script>