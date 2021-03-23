@extends('layouts.app')
@section('content')

	<!-- main -->
	<div class="main-w3layouts wrapper">
		<h1>Creative SignIn Form</h1>
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
				<!-- <form class="form-horizontal form-material"  method="POST" id="loginform" action="{{url('/user_authenticate')}}">

					{!! csrf_field() !!} -->
					<form class="form-horizontal form-material" method="POST" action="{{ route('login') }}">
                        @csrf

					<input class="text email @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email" value="{{old('email')}}" required="">

					@error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

					<input class="text @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" value="{{old('password')}}" required="">

					@error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

					@if(Session::has('login_feedback'))
                        <div class="alert alert-danger">
                        	<button class="close" data-dismiss="alert"></button>
                        	<strong>Error! </strong>{{Session::get('login_feedback')}}.</div>
                    @endif

					<!-- <input type="submit" value="SIGNIN"> -->
					<button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
				</form>
				<p>Don't have an Account? <a href="{{('/signup')}}"> Signup Now!</a></p>
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