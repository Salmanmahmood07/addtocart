@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center">Cart Page</h1>
        <div class="row">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th width="50%">Product</th>
                    <th width="22%">Total</th>
                    <th width="10%"></th>
                </tr>
                </thead>
                <tbody>
                
                    @foreach($products as $id => $product)
                       
                        <tr>
                            <td>
                                <img
                                    src="{{url('/home_assets/images')}}/{{$product->user_id}}"
                                    alt="{{$product->name}}"
                                    class="img-fluid"
                                    width="150"
                                >
                                <span>{{$product['name']}}</span>
                            </td>
                            <td>Rs.{{$product->totalprice}}</td>
                            <td>
                                
                            </td>
                            <td>Rs.{{$sub_total}}</td>
                            <td>
                                <a href="{{route('remove', [$id])}}" class="btn btn-danger btn-sm">X</a>
                            </td>
                        </tr>
                    @endforeach
           
                </tbody>
                <tfoot>
                <tr>
                    <td>
                        <a href="{{route('products')}}"
                           class="btn btn-warning"
                        >Continue Shopping</a>
                       <!--  <form action="#" method="post">
                            @csrf
                            <input type="hidden" name="amount" value="{{$total}}">
                            <button type="submit"
                                    class="btn btn-success"
                            >Proceed to Pay
                            </button>
                        </form> -->
                        <form action="{{route('order')}}" class="d-flex">
                            <button
                                        type="submit"
                                        value="up"
                                        name="change_to"
                                        class="btn btn-danger btn-sm"
                                    >
                                        Proceed to Checkout
                                    </button>

                             

                    </td>
                    <td>
                    
                         <a href="{{route('emptyCart')}}" class="btn btn-danger btn-sm">Clear cart</a>
                            
                    </td>
                    <td colspan="2"></td>
                    <input type="hidden" class="form-control" value="{{$total}}" name="total" id="title" required >
                    <td><strong>Total Rs.{{$total}}</strong></td>
                    </form>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
