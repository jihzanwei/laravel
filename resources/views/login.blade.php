@extends('layout.common')
@section('title','登录喽')
@section('login')
    <!-- <center>
        <h1>登录</h1>
        <form action="{{url('student/do_login')}}" method="post">
            @csrf
            用户名<input type="text" name="name"><br>
            密码<input type="password" name="password" id=""><br>
            <input type="submit" value="提交">
        </form>
    </center> -->
    <div class="pages section">
		<div class="container">
			<div class="pages-head">
				<h3>LOGIN</h3>
			</div>
			@if($errors->any())
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        	@endif
			<div class="login">
				<div class="row">
                    <form class="col s12" action="{{url('home/do_login')}}">
                    @csrf
						<div class="input-field">
							<input type="text" class="validate" placeholder="USERNAME" name="name" required>
						</div>
						<div class="input-field">
							<input type="password" class="validate" placeholder="PASSWORD" name="password" required>
						</div>
						<a href=""><h6>Forgot Password ?</h6></a>
                        <!-- <a href="" class="btn button-default">LOGIN</a> -->
                        <center><input type="submit" value="登录"></center>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
<script>
    $(function(){
    
    })
</script>
@endsection