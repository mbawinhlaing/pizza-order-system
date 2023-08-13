
@extends('admin.layouts.master')
@section('title', 'Order List')

@section('content')

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <div class="table-responsive table-responsive-data2">
                                <a href="{{ route('admin#orderList')}}" class="text-dark"><i class="fa-solid fa-arrow-back"></i></a>

                                <div class="row col-5">
                                    <div class="card mt-4">
                                        <div class="card-body">
                                            <div class="card-body">
                                                <h3><i class="fa-solid fa-clipboard"></i> Order info</h3>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col"><i class="fa-solid fa-user"></i>Customer name</div>
                                                <div class="col">{{strtoupper($orderList[0]->user_name)}}</div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col"><i class="fa-thin fa-bags-shopping"></i> Order Code</div>
                                                <div class="col">{{ $orderList[0]->order_code}}</div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col"><i class="fa-regular fa-calendar-clock"></i> Order Time</div>
                                                <div class="col">{{$orderList[0]->created_at->format('F-j-Y')}}</div>
                                            </div>
                                            <div class="row mb-4">
                                                <div class="col"><i class="fa-regular fa-money-bills"></i> Total Amount</div>
                                                <div class="col">{{$order->total_price}}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <table class="table table-data2 text-center">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>User Id</th>
                                            <th>Product Iamge</th>
                                            <th>Product Name</th>
                                            <th>Order Date</th>
                                            <th>Qty</th>
                                            <th>Account</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataList">
                                        @foreach ($orderList as $o)
                                        <tr class="tr-shadow">
                                            <td></td>
                                            <td>{{$o->id}}</td>
                                            <td class="col-2"><img src="{{ asset('storage/'.$o->product_image)}}" alt=""></td>
                                            <td>{{$o->product_name}}</td>
                                            <td>{{ $o->created_at->format('F-j-Y')}}</td>
                                            <td>{{$o->qty}}</td>
                                            <td>{{$o->total}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- {{ $order->links()}} --}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->

@endsection
