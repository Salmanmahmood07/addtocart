@extends('admin.layouts.app')
@section('content')

	<!-- main -->
	<div class="main-w3layouts wrapper">
		<h1>Admin Login</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<!-- @if(isset(Auth::user()->email))
					    <script>window.location="/home";</script>
					   @endif -->

					   @if ($message = Session::get('error'))
					   <div class="alert alert-danger alert-block">
					    <button type="button" class="close" data-dismiss="alert">×</button>
					    <strong>{{ $message }}</strong>
					   </div>
					   @endif

					   @if (count($errors) > 0)
					    <div class="alert alert-danger">
					     <ul>
					     @foreach($errors->all() as $error)
					      <li>{{ $error }}</li>
					     @endforeach
					     </ul>
					    </div>
					   @endif
				<form class="form-horizontal form-material"  method="POST" id="loginform" action="{{url('/admin_authenticate')}}">

					{!! csrf_field() !!}
					
					<input class="text email" type="email" name="email" placeholder="Email" value="{{old('email')}}" required="">
					<input class="text" type="password" name="password" placeholder="Password" value="{{old('password')}}" required="">

					@if(Session::has('login_feedback'))
                        <div class="alert alert-danger">
                        	<button class="close" data-dismiss="alert"></button>
                        	<strong>Error! </strong>{{Session::get('login_feedback')}}.</div>
                    @endif

					<input type="submit" value="SIGNIN">
				</form>
				
			</div>
		</div>
		<!-- copyright -->
		<div class="colorlibcopy-agile">
			<p>© 2018 Colorlib Signin Form. All rights reserved | Design by <a href="https://colorlib.com/" target="_blank">Colorlib</a></p>
		</div>
		<!-- //copyright -->
		<ul class="colorlib-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
	<!-- //main -->

	@endsection