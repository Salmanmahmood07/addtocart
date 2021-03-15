@extends('layouts.app')
@section('content')

	<div class="main-w3layouts wrapper">
		<h1>Creative SignUp Form</h1>
		<div class="main-agileinfo">
			<div class="agileits-top">
				<form class="form-horizontal form-material" id="user-form" enctype="multipart/form-data">
					{!! csrf_field() !!}
					<input class="text" id="user-form" type="text" name="name" placeholder="name" value="{{old('name')}}" required="">
					<input class="text email" type="email" name="email" placeholder="Email" value="{{old('email')}}" required="">
					<input class="text" type="password" name="password" placeholder="Password" value="{{old('password')}}" required="">
					<!-- <input class="text w3lpass" type="password" name="cpassword" placeholder="Confirm Password" required=""> -->
					<div class="wthree-text">
						<label class="anim">
							<input type="checkbox" class="checkbox" required="">
							<span>I Agree To The Terms & Conditions</span>
						</label>
						<div class="clear"> </div>
					</div>
					<input type="submit" value="SIGNUP">
				</form>
				<p>Don't have an Account? <a href="{{('/login')}}"> Login Now!</a></p>
			</div>
		</div>
		<!-- copyright -->
		<div class="colorlibcopy-agile">
			<p>© 2018 Colorlib Signup Form. All rights reserved | Design by <a href="https://colorlib.com/" target="_blank">Colorlib</a></p>
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
<script src="{{url('/home_assets')}}/js/bootbox.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<script type="text/javascript">
               
              jQuery(document).ready(function(){
                jQuery('#user-form').submit(function(e){
                  e.preventDefault();
                  $.ajaxSetup({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                  });
                  var myForm = document.getElementById('user-form');
                  var formData = new FormData(myForm);
                    jQuery.ajax({
                      url: "{{ url('/usersignup') }}",
                      method : 'post',
                      data: formData,
                      contentType: false,
                       cache: false,
                       processData: false,
                      success: function(result){
                        if(result.success == 0){
                                  bootbox.alert({
                        title: "Message",
                        message:result.message,
                        callback: function(){
                            
                          }
                      });
                        }
                        else{
                          bootbox.alert({
                title: "Message",
                message:result.message,
                callback: function(){
                   //$(location).attr('href', '/tutor');
                }
              });
                        }
                      }});
                  });
              });
            </script>
            </body>
</html>
@endsection