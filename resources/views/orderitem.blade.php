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
                                                <th>Order_id</th>
                                                <th>Username</th>
                                                <th>Total Price</th>
                                                <th>Created At</th>
                                                <!-- <th>Total Items</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @php
                                          $count=1;
                                          @endphp

                                          @foreach($order as $or)
                                            <tr>
                                                <td><a href="javascript:void(0)">{{$count++}}</a></td>
                                                <div class="content">

                                                <td>{{$or->id}}</div></td>
                                                <td>{{$or->user_id}}</td>
                                                <td>{{$or->totalprice}}</td>
                                                <td>
                                                    {{$or->created_at->format('d/m/Y')}}
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
