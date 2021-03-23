@extends('layouts.app')
@section('content')

<div class="container">
@if(isset(Auth::user()->email))
   <div class="alert alert-danger success-block">
     <strong>Welcome {{ Auth::user()->name }}</strong>
     <br/>
    </div>
   @else
   @endif
 @if(session('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
      
        @if(count($product) > 0)
        
            <div class="row">
             
                
                @foreach($product as $products)
                <div class="col-sm-2 col-md-4 col-sm-12">
                    <img class="mx-auto d-block" src="{{url('/home_assets/images')}}/{{$products->image}}" alt="profile Pic" height="200" width="200">

                    <h3 class="text-center">{{$products->product_name}}</h3>

                    <h4 class="text-center"><small>Rs.{{$products->product_price}}</small></h4>
<input class="btn btn-success btn-block fade show" id="msg" type="submit" name="">
                   <!--  <a  href="#" class="btn btn-success btn-block fade show">Add to cart</a> -->
                    </div>
                @endforeach
                
         </div>
    </div>
     
  
 @endif
 <script>
          $(document).ready(function() {
            var members = {!!  json_encode($member)  !!};
            console.log(members);
            var arr = [];
            $("#s").autocomplete({
                source: members,
                select: function (event, ui) {
                    arr.push(ui);
                    console.log(arr);
                }
            });
      </script>

@endsection