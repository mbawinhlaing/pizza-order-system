
@extends('admin.layouts.master')
@section('title', 'Order List')

@section('content')

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <!-- DATA TABLE -->
                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <div class="overview-wrap">
                                        <h2 class="title-1">Order List</h2>

                                    </div>
                                </div>

                            </div>

                           <div class="row">
                                <div class="col-3">
                                    <h4 class="text-secondary"> Search Key: <samp class="text-danger"> {{ request('key')}}</samp></h4>
                                </div>


                                <div class="col-3 offset-6">
                                    <form action="{{ route('product#list')}}" method="get">
                                        @csrf
                                        <div class="d-flex">
                                            <input type="text" name="key" class="form-control" placeholder="Search..." value="{{ request('key')}}">
                                            <button class="btn bg-dark text-white" type="submit">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                           <form action="{{ route('admin#changeStatus')}}" method="get">
                            @csrf
                            <div class="d-flex">
                                <label for="" class="mt-2 me-4">
                                    <h3> <i class="fa-solid fa-database"></i> -  {{ count($order)}} </h3>
                                </label>
                                <select name="orderStatus" class="form-select col-2">
                                    <option value="">All</option>
                                    <option value="0"@if(request('orderStatus')==0 ) selected @endif >Pending</option>
                                    <option value="1"@if(request('orderStatus')==1 ) selected @endif >Accept</option>
                                    <option value="2"@if(request('orderStatus')==2 ) selected @endif  >Reject</option>
                                </select>

                                <button type="submit" class="btn sm bg-dark text-white"> search</button>
                            </div>
                           </form>

                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2 text-center">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>User name</th>
                                            <th>Order Date</th>
                                            <th>Order Code</th>
                                            <th>Account</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataList">
                                        @foreach ($order as $o )
                                         <tr class="tr-shadow">
                                            <input type="hidden" class="orderId" value="{{$o->id}}">
                                            <td >{{ $o->user_id}}</td>
                                            <td >{{ $o->user_name}}</td>
                                            <td >{{ $o->created_at->format('F-j_Y')}}</td>
                                            <td >
                                                <a href="{{ route('admin#listInfo',$o->order_code)}}" class="text-danger">{{ $o->order_code}}</a>
                                            </td>
                                            <td class="amount">{{ $o->total_price}} Kyats</td>
                                            <td >
                                                <select name="status" id="" class="form-control statusChange">
                                                    <option class="text-info" value="0" @if ($o->status == 0) selected @endif >Pending</option>
                                                    <option class="text-success" value="1" @if ($o->status == 1) selected @endif >Accept</option>
                                                    <option class="text-danger" value="2" @if ($o->status == 2) selected @endif >Reject</option>
                                                </select>
                                            </td>
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

@section('scriptSection')

<script>
    $(document).ready(function(){
        // $('#orderStatus').change(function(){
        //     $status = $('#orderStatus').val();
        //     $.ajax({
        //         type:'get',
        //         url:'/order/ajax/status',
        //         data:{
        //             'status': $status
        //         },
        //         dataType:'json',
        //         success: function(response){
        //             $list = '';
        //             for($i=0; $i<response.length; $i++){

        //                 $months = ['January','February','March','April','May','June','July','August','September','October','November','December'];
        //                 $dbDate = new Date(response[$i].created_at);
        //                 $finalDate = $months[$dbDate.getMonth()]+ '-'+ $dbDate.getDate() +'-'+ $dbDate.getFullYear();

        //                 if(response[$i].status == 0){
        //                     $statusMessage = `
        //                     <select name="status" id="" class="form-control">
        //                         <option value="0" selected >Pending</option>
        //                         <option value="1" >Accept</option>
        //                         <option value="2" >Reject</option>
        //                     </select>`
        //                 }else if(response[$i].status == 1){
        //                     $statusMessage = `
        //                     <select name="status" id="" class="form-control">
        //                         <option value="0"  >Pending</option>
        //                         <option value="1" selected>Accept</option>
        //                         <option value="2" >Reject</option>
        //                     </select>`
        //                 }else if(response[$i].status == 2){
        //                     $statusMessage = `
        //                     <select name="status" id="" class="form-control">
        //                         <option value="0"  >Pending</option>
        //                         <option value="1" >Accept</option>
        //                         <option value="2" selected>Reject</option>
        //                     </select>`
        //                 }
        //                 $list += `
        //                 <tr class="tr-shadow">
        //                                     <td >${response[$i].user_id}</td>
        //                                     <td >${response[$i].user_name}</td>
        //                                     <td >${$finalDate}</td>
        //                                     <td >${response[$i].order_code}</td>
        //                                     <td >${response[$i].total_price} Kyats</td>
        //                                     <td >${$statusMessage}</td>
        //                                  </tr>`;
        //             }
        //             $('#dataList').html($list);
        //         }
        //     })
        // })

        // Change Status
        $('.statusChange').change(function(){
            $currentStatus = $(this).val();
            $parentNode = $(this).parents('tr');
            $orderId = $parentNode.find('.orderId').val();

            $data = {
                'status': $currentStatus,
                'orderId':$orderId
            };
                console.log($data)
            $.ajax({
                type:'get',
                url: '/order/ajax/change/status',
                data: $data,
                dataType:'json',
            })

        })
    })
</script>
@endsection
