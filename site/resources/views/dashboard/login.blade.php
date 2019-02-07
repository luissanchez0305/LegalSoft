@extends('layouts.plain')

@section('body')

	<div class="container-fluid">
		<div class="login-container">
			<div class="login-box">
				<div class="card card-default login-wrapper">
					<div class="card-header text-center login-title">
						<h1>Digisale</h1>
					</div>
					<div class="login-body grid-bx">
						<form>
							<div class="username-input form-group input-group">
								<i class="fa icons fa-user input-group-addon"></i><input type="email" class="input-lg input-box form-control form-control-lg" id="exampleInputEmail1" placeholder="USERNAME">
							</div>
							<div class="password-input form-group input-group">
								<i class="fa icons fa-lock input-group-addon"></i><input type="password" class="input-lg input-box form-control" id="exampleInputPassword1" placeholder="PASSWORD">						
							</div>

							<div class="checkbox-wrapper">
								<div class="onoffswitch remember-btn">
								    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked>
								    <label class="onoffswitch-label" for="myonoffswitch"></label>
								</div>
								<div class="remember-title">Remember</div> 
								<a href="/signup" class="pull-right">FORGOT?</a>
							</div>
							<a type="submit" href="/" class="btn btn-info btn-lg btn-block login-btn">SIGN IN</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop