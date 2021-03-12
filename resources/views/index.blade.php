<?php 
use App\Http\Controllers\CartController;
$totalcart= CartController::cartitem();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add to cart</title>
  <link href="{{url('/home_assets')}}/css/signup.css" rel="stylesheet" type="text/css" media="all" />
  <link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="{{url('/home_assets')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{url('/home_assets')}}/css/plugins.css">
    <link rel="stylesheet" href="{{url('/home_assets')}}/style.css">

    <!-- Cusom css -->
     <link rel="stylesheet" href="{{url('/home_assets')}}/css/custom.css">

    <!-- Modernizer js -->
    <script src="{{url('/home_assets')}}/js/vendor/modernizr-3.5.0.min.js"></script>
<style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}

   .box{
    width:600px;
    margin:0 auto;
    border:1px solid #ccc;
   }

</style>
</head>

<body>
	<ul>
  <li><a class="active" href="{{('/home')}}">Home</a></li>
  <li><a href="{{('/signup')}}">Signup</a></li>
  <li><a href="{{('/login')}}">Login</a></li>
  <li><a href="{{('/addproduct')}}">Add Product</a></li>
  <li><a href="{{('/cart')}}">Cart({{$totalcart}})</a></li>
  <li> <a href="{{ url('/home/logout') }}">Logout</a></li>

</ul>
@if(isset(Auth::user()->email))
   <div class="alert alert-danger success-block">
     <strong>Welcome {{ Auth::user()->name }}</strong>
     <br/>
    </div>
   @else
    <script>window.location = "/login";</script>
   @endif

@foreach($product as $products)
      <div class="col-md-6">
	    <img src="{{url('/home_assets/images')}}/{{$products->image}}" alt="profile Pic" height="200" width="200">
     
      <div class="col-md-6">
	    <h2>{{$products->product_name}}</h2></div>
      <div class="col-md-6">
      <h2>{{$products->product_price}}</h2></div>
      
      <form action="/addtocart" method="POST">
        @csrf
        <input type="hidden" class="form-control" name="product_id" 
        value="{{$products->id}}" name="id" id="id" required>
        <button class="btn btn-success">Add to cart</button>
      </form>
	    
  @endforeach

</div>
</body>
</html>