@extends('layouts.app')
@section('content')

<!-- @if(isset(Auth::user()->email))
   <div class="alert alert-danger success-block">
     <strong>Welcome {{ Auth::user()->name }}</strong>
     <br/>
    </div>
   @else
    <script>window.location = "/login";</script>
   @endif -->
 <!-- @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif -->
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        @if(count($product) > 0)
@foreach($product as $products)
      <div class="col-md-6">
	    <img src="{{url('/home_assets/images')}}/{{$products->image}}" alt="profile Pic" height="200" width="200">
     
      <div class="col-md-6">
	    <h2>{{$products->product_name}}</h2></div>
      <div class="col-md-6">
      <h2>{{$products->product_price}}</h2></div>
      
     <!--  <form action="/addtocart" method="POST">
        @csrf
        <input type="hidden" class="form-control" name="product_id" 
        value="{{$products->id}}" name="id" id="id" required> -->
        <a href="{{route('add-cart', [$products->id])}}" class="btn btn-success btn-block">Add to cart</a>
      </form>
	    
  @endforeach
 @endif
</div>
</body>
</html>
@endsection