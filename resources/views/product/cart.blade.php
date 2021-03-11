<!DOCTYPE html>
<html>
<head>
	<title>Add to cart</title>
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
  <li><a class="active" href="{{('/home')}}">Home</a></li>
  <li><a href="{{('/signup')}}">Signup</a></li>
  <li><a href="{{('/login')}}">Login</a></li>
  <li><a href="{{('/addproduct')}}">Add Product</a></li>
  <li><a href="{{('/cart')}}">Cart</a></li>
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

 <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Products</th>
                                                
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @php
                                          $count=1;
                                          @endphp

                                         @foreach($product as $products)
                                            <tr>
                                                <td><a href="javascript:void(0)">{{$count++}}</a></td>
                                              
                                                <td>{{$products->user_id}}</td>

                                                <td><a href="{{url('/cart/edit_cart',$products->id)}}"><button type="button" class="btn waves-effect waves-light   btn-warning">Edit</button></a>
                                                  <a href="{{url('/dcart/{id}',$products->id)}}">
                                                  <button type="button" class="btn waves-effect waves-light  btn-danger del-button">Delete</button></a>
                                                </td>
                                            </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
</div>
</body>
</html>