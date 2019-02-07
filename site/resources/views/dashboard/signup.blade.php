@extends('layouts.plain')

@section('body')

	<div class="container-fluid">
		<div class="signup-container">
			<div class="signup-box">
				<div class="card card-default card  signup-wrapper">
					<div class="card-header grid-bx text-center signup-title">
						<h1>Digisale</h1>
					</div>
					<div class="card-block signup-body">
						<form>
							<div class="username-input form-group input-group">
								<i class="fa icons fa-user input-group-addon"></i><input type="text" class="input-lg input-box form-control" placeholder="NAME">
							</div>
							<div class="username-input form-group input-group">
								<i class="fa icons fa-at input-group-addon"></i><input type="email" class="input-lg input-box form-control" id="exampleInputEmail1" placeholder="EMAIL">
							</div>
							<div class="password-input form-group input-group">
								<i class="fa icons fa-lock input-group-addon"></i><input type="password" class="input-lg input-box form-control" id="exampleInputPassword1" placeholder="PASSWORD">						
							</div>
							<div class="password-input form-group input-group">
								<i class="fa icons fa-lock input-group-addon"></i><input type="password" class="input-lg input-box form-control" id="exampleInputPassword2" placeholder="CONFIRM PASSWORD">						
							</div>
							
							<a type="submit" class="btn btn-info btn-lg btn-block signup-btn" href="/">REGISTER</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop