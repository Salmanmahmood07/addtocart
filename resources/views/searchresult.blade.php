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
        @if(count($products) > 0)
        
            <div class="row">
             
            @if($products->isNotEmpty())
                @foreach($products as $product)
                <div class="col-sm-2 col-md-4 col-sm-12">
                    <img class="mx-auto d-block" src="{{url('/home_assets/images')}}/{{$product->image}}" alt="profile Pic" height="200" width="200">

                    <h3 class="text-center">{{$product->product_name}}</h3>

                    <h4 class="text-center"><small>Rs.{{$product->product_price}}</small></h4>

                    <a href="{{route('add-cart', [$product->id])}}" class="btn btn-success btn-block fade show">Add to cart</a>
                    </div>
                @endforeach
                @else 
                <div>
                    <h2>No posts found</h2>
                </div>
            @endif
         </div>
    </div>
     
  
 @endif


@endsection