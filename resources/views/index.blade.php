<!DOCTYPE html>
<html>
<head>
	<title>Add to cart</title>
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
</style>
</head>
<body>
	<ul>
  <li><a class="active" href="{{('/home')}}">Home</a></li>
  <li><a href="{{('/signup')}}">Signup</a></li>
  <li><a href="{{('/login')}}">Login</a></li>
  <li><a href="{{('/cart')}}">Cart</a></li>
</ul>
<div>
	<img src="{{url('/')}}/home_assets/images/blue.png" alt="profile Pic" height="200" width="200">
	<h1>Blue</h1>
	<button href="{{('/cart')}}">Add to cart</button>
</div>
</body>
</html>