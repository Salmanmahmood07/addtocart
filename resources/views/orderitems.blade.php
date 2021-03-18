@extends('layouts.app')
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
                                                <th>id</th>
                                                <th>Products Id</th>
                                                 <th>Quantity</th>
                                                <th>Base Price</th>
                                                <!-- <th>Total Items</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @php
                                          $count=1;
                                          @endphp

                                          @foreach($orderitem as $or)
                                            <tr>
                                                <td><a href="javascript:void(0)">{{$count++}}</a></td>
                                                <div class="content">
                                                <td>{{ $or->id }}</td>
                                                <td>{{ $or->product_id }}</td>
                                                <td>{{ $or->quantity }}</td>
                                                <td>{{ $or->price }}</td>
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
