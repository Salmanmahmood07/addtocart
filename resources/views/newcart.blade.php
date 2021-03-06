@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center">Cart Page</h1>
        <div class="row">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th width="50%">Product</th>
                    <th width="10%">Price</th>
                    <th width="8%">Quantity</th>
                    <th width="22%">Sub Total</th>
                    <th width="10%"></th>
                </tr>
                </thead>
                <tbody>
                @php $total = 0; @endphp
                @if(session('cart'))
                    @foreach(session('cart') as $id => $product)
                        @php
                            $sub_total = $product['price'] * $product['quantity'];
                            $total += $sub_total;
                            Session::put('total',$total);
                        @endphp
                        <tr>
                            <td>
                                <img
                                    src="{{url('/home_assets/images')}}/{{$product['image']}}"
                                    alt="{{$product['name']}}"
                                    class="img-fluid"
                                    width="150"
                                >
                                <span>{{$product['name']}}</span>
                            </td>
                            <td>Rs.{{$product['price']}}</td>
                            <td>
                                <form action="{{route('change_qty', $id)}}" class="d-flex">
                                    <button
                                        type="submit"
                                        value="down"
                                        name="change_to"
                                        class="btn btn-danger"
                                    >
                                        @if($product['quantity'] === 1) x @else - @endif
                                    </button>
                                    <input
                                        type="number"
                                        value="{{$product['quantity']}}"
                                        disabled>
                                    <button
                                        type="submit"
                                        value="up"
                                        name="change_to"
                                        class="btn btn-success"
                                    >
                                        +
                                    </button>
                                </form>
                            </td>
                            <td>Rs.{{$sub_total}}</td>
                            <td>
                                <a href="{{route('remove', [$id])}}" class="btn btn-danger btn-sm">X</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
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

                        <form action="{{route('order')}}"  class="d-flex">
                         
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
