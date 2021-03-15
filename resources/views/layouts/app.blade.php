<?php 
use App\Http\Controllers\CartController;
$totalorder= CartController::cartitem();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LaraCart</title>
    <link rel="stylesheet" href="{{url('/home_assets')}}/css/app.css">
    <link href="{{url('/home_assets')}}/css/signup.css" rel="stylesheet" type="text/css" media="all" />
    <link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
   
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
  <li><a class="active" href="{{('/')}}">Home</a></li>
  <li><a href="{{('/signup')}}">Signup</a></li>
  <li><a href="{{('/login')}}">Login</a></li>
  <li><a href="{{('/addproduct')}}">Add Product</a></li>
  <li><a href="{{('/cart')}}">Cart</a></li>
  <li><a href="{{('/order')}}">Orders({{$totalorder}})</a></li>
  <li> <a href="{{ url('/home/logout') }}">Logout</a></li>

</ul>
</head>
<body>

@yield('content')
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</body>
</html>
