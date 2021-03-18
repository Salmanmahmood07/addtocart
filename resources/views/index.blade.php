@extends('layouts.app')
@section('content')

<div class="container">
@if(isset(Auth::user()->email))
   <div class="alert alert-danger success-block">
     <strong>Welcome {{ Auth::user()->name }}</strong>
     <br/>
    </div>
   @else
    <script>window.location = "/login";</script>
   @endif
 @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
        @if(count($product) > 0)
        
            <div class="row">
             @foreach($product as $products)
                <div class="col-sm-4">
                    <img src="{{url('/home_assets/images')}}/{{$products->image}}" alt="profile Pic" height="200" width="200">

                    <h3>{{$products->product_name}}</h3>

                    <h4>{{$products->product_price}}</h4>

                    <a href="{{route('add-cart', [$products->id])}}" class="btn btn-success btn-block">Add to cart</a>
     
                </div>
         </div>
    </div>
     
  @endforeach
 @endif


@endsection