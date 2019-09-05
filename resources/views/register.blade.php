
@extends('layout.common')
@section('title','注册')
@section('login')
	<!-- register -->
	<div class="pages section">
		<div class="container">
			<div class="pages-head">
				<h3>REGISTER</h3>
			</div>
		
		<div class="register">
				<div class="row">
					<form class="col s12" action="{{url('home/do_register')}}">
					@csrf
						<div class="input-field">
							<input type="text" class="validate" placeholder="NAME" name="name" required>
						</div>
						<div class="input-field">
							<input type="email" placeholder="EMAIL" class="validate" name="email" required>
						</div>
						<div class="input-field">
							<input type="password" placeholder="PASSWORD" class="validate" name="password" required>
						</div>
						<!-- <div class="btn button-default">REGISTER</div> -->
						<input type="submit" value="提交">
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end register -->
@endsection

	