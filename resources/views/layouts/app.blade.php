<?php 
// use App\Http\Controllers\ProductsController;
// $totalorder= ProductsController::cartitem();
//({{$totalorder}})
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
   <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">


<!-- jQuery library -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 -->
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

</head>

<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
	<ul class="navbar-nav">
  <li><a class="nav-link" href="{{('/')}}">Home</a></li>
  <li><a class="nav-link" href="{{('/cart')}}">Cart</a></li>
  <li><a class="nav-link" href="{{('/orders')}}">Orders</a></li>
  @if(Auth::check())
    <li><a class="nav-link" href="{{ route('logout') }}">Logout</a></li>
    @else
    <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
    <li><a class="nav-link" href="{{('/signup')}}">Signup</a></li>
   @endif
 @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
  <form class="form-inline" action="{{ route('search') }}" method="GET">
    <input class="form-control mr-sm-2" name="search" type="text" placeholder="Search" required="">
    <button class="btn btn-success" type="submit">Search</button>
  </form> 
  
  </li>  
   
    </ul>
  </div>  
</nav>
</head>
<body>

@yield('content')
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</body>
</html>
