<?php 
use App\Http\Controllers\CartController;
$totalcart= CartController::cartitem();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add to cart</title>
  <link href="{{url('/home_assets')}}/css/signup.css" rel="stylesheet" type="text/css" media="all" />

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

 <table class="table cart-table text-center">
                                <!-- Table Head -->
                                <thead>
                                    <tr>
                                        <th class="number">#</th>
                                        <th class="name">product name</th>
                                        <th class="price">price</th>
                                        <th class="image">image</th>
                                        <th class="qty">quantity</th>
                                        <th class="remove">Action</th>
                                    </tr>
                                </thead>
                                        <tbody>
                                          @php
                                          $count=1;
                                          @endphp

                                         @foreach($products as $items)
                                            <tr>
                                                <td><a href="javascript:void(0)">{{$count++}}</a></td>
                                              
                                                <!-- <td>{{$items->id}}</td> -->
                                                 <td>{{$items->product_name}}</td>
                                                 <td>{{$items->product_price}}</td>

                                                 
                                                  <td><img src="{{url('/home_assets/images')}}/{{$items->image}}" alt="profile Pic" height="150" width="180"></td>

                                                   @foreach($detail as $qnts)

                                                <form method="post" action="{{route('upcart')}}">
                                                {!! csrf_field() !!}

                                                <td>
                                                  <div class="product-quantity">
                                                <input type="text" value="{{$qnts->quantity}}" name="quantity">
                                                </div>
                                              </td>

                                                @endforeach
                                                
                                                <input type="hidden" class="form-control" value="{{$items->id}}" name="product_id" id="title" required >


                                               <!--  <td><p class="cart-pro-price">{{$items->product_price}}</p></td> -->


                                                <td>
                                                <!-- <a class="btn waves-effect waves-light   btn-warning" href="#">Update</a> -->
                                                <!-- <button class="btn waves-effect waves-light" type="submit">Update</button> -->
                                              
                                               

                                                  
                                                <a class="btn waves-effect waves-light   btn-warning" href="/dcart/{{$items->cart_id}}">Delete</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            <input type="hidden" class="form-control" value="{{$items->cart_id}}" name="cart_id" id="cart_id" >
                                            <a class="btn waves-effect waves-light   btn-warning" href="/order">
                                                  order
                                                </a>

                                        </tbody>
                                    </table>
</div>
<!-- Page Conent -->
      <main class="page-content">
<!-- Shopping Cart -->
        <div class="cr-section cart-section ptb--150 bg--white">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        
                        <div class="row pt--60">
                            
                            
                            <!-- Cart Checkout Progress -->
                            <div class="cart-checkout-process col-lg-4 col-md-6 col-12 mb--30">
                                    <div class="small-title">
                                        <h4>Process Checkout</h4>
                                    </div>
                                     <div class="small-title">
                                        <h4>Total Quantity</h4>
                                         <h1 name="quantity"><span> {{$totalcart}} </span></h1>
                                    </div>

                                <h5><span>Grand total =</span></h5>
                                <h1><span> {{$total}} </span></h1>
                                <input type="hidden" class="form-control" value="{{$total}}" name="newprice" id="title" required >
                                <button class="btn waves-effect waves-light   btn-warning">checkout</button>
                            </div>
                             </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- //Shopping Cart -->
        </main><!-- //Page Conent -->
</body>
</html>