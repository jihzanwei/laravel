<script src="/mstore/js/jquery.min.js"></script>
<center>
<form action="{{url('admin/survey/add_question')}}">
<input type="hidden" name="s_id"  value="{{$id}}">
调研问题 ：<input type="text" name="question"><br>
            问题选择：<input type="radio" name="choice" id="radio" value="单选">单选
            <input type="radio" name="choice" id="checkbox" value="多选">多选<br>
                <div class="radio">
                a<input type="radio" name="answer" id="" value="a"><input type="text" name="a1"><br>
                b<input type="radio" name="answer" id="" value="b"><input type="text" name="b1"><br>
                c<input type="radio" name="answer" id="" value="c"><input type="text" name="c1"><br>
                d<input type="radio" name="answer" id="" value="d"><input type="text" name="d1"><br>
                </div>


            <div class="checkbox">
                a<input type="checkbox" name="answer[]" value="a" id=""><input type="text" name="a"><br>
                b<input type="checkbox" name="answer[]" value="b" id=""><input type="text" name="b"><br>
                c<input type="checkbox" name="answer[]" value="c" id=""><input type="text" name="c"><br>
                d<input type="checkbox" name="answer[]" value="d" id=""><input type="text" name="d"><br>
                
            </div>
            <input type="submit" value="添加题目">
</form>
</center>


        <script>
                $('.radio').hide();
                $('.checkbox').hide();
                $('#radio').click(function(){
                    $('.radio').show();
                });
                $('#checkbox').click(function(){
                     $('.checkbox').show();
                })
               
        </script>
 