@extends('admin.layouts.app')
@section('content')
   <!-- column -->

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Users </h4>
                                <div class="table-responsive table-hover">
                                   
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                 <th>Image</th>
                                                 <th>Action</th>

                                                <!-- <th>Total Items</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @php
                                          $count=1;
                                          @endphp

                                          @foreach($products as $or)
                                            <tr>
                                                <td>
                                                    <a href="{{route('orderitems', $or->id)}}">{{$count++}}</a>
                                                </td>
                                                <div class="content">

                                                <td>{{ $or->product_name }}</div></td>
                                                <td>{{$or->product_price}}</td>
                                                <td>
                                                 <img id="blah" src="{{url('/home_assets/images/')}}/{{$or->image}}" height="170" width="190"/></td>
                                                
                                                <td><a href="{{route('editproduct', $or->id)}}"><button type="button" class="btn waves-effect waves-light   btn-warning">Edit</button></a>
                                                <a href="{{route('destroy', [$or->id]) }}"><button type="button" class="btn waves-effect waves-light   btn-danger">Delete</button></a>
                                                </td>
                                            </tr>
                                            

                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- column -->
@endsection
