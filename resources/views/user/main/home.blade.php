
@extends('user.layouts.master')
@section('content')



    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Category List</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class=" d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="price-all">
                            <label class="custom-control-label" for="price-all">Category</label>
                            <span class="badge border font-weight-normal text-black">{{count($Category)}}</span>
                        </div>
                        <div class=" d-flex align-items-center justify-content-between mt-2">
                            <a href="{{ route('user#home')}} " class="text-dark"><label class="custom-control-label" for="price-5">All</label></a>
                        </div>
                        @foreach ($Category as $C )
                        <div class=" d-flex align-items-center justify-content-between mt-2">
                            <a href="{{ route('user#filter',$C->id)}} " class="text-dark"><label class="custom-control-label" for="price-5">{{$C->name}}</label></a>
                        </div>
                        @endforeach
                    </form>
                </div>
                <!-- Price End -->


                <!-- Size Start -->
                <div class="">
                    <button class="btn btn btn-warning w-100">Order</button>
                </div>
                <!-- Size End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                               <a href="{{ route('user#cartList')}}">
                                   <button type="button" class="btn btn-primary position-relative">
                                    <i class="fas fa-shopping-cart text-dark"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                      {{count($cart) }}
                                      <span class="visually-hidden">unread messages</span>
                                    </span>
                                   </button>
                               </a>
                               <a href="{{ route('user#history')}}">
                                <button type="button" class="btn btn-primary position-relative">
                                    <i class="fa-solid fa-clock-rotate-left"></i> History
                                 <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                   {{count($history) }}
                                   <span class="visually-hidden">unread messages</span>
                                 </span>
                                </button>
                            </a>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sorting" class="form-control" id="sortingOption">
                                        <option value="">Choose Option..</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="row" id="dataList">
                    @if (count($pizza) != 0)
                    @foreach ( $pizza as $p)
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                     <div class="product-item bg-light mb-4" id="myFrom">
                         <div class="product-img position-relative overflow-hidden">
                             <img class="img-fluid w-100" style="height: 250px" src="{{asset('storage/'. $p->image)}}" alt="">
                              <div class="product-action">
                                 <a class="btn btn-outline-dark  btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                 <a class="btn btn-outline-dark btn-square" href="{{ route('user#pizzaDetails', $p->id)}}"><i class="fa-solid fa-circle-info"></i></a>
                             </div>
                         </div>
                         <div class="text-center py-4">
                             <a class="h6 text-decoration-none text-truncate" href="">{{ $p->name}}</a>
                             <div class="d-flex align-items-center justify-content-center mt-2">
                                 <h5>{{ $p->price}} kyats</h5>
                             </div>

                         </div>
                     </div>
                    </div>
                    @endforeach
                    @else
                    <h1 class="text-center shadow-sm fs-1 col-6 offset-3 py-3">There is not avaible</h1>
                    @endif
                    </div>

                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection

@section('scriptSource')
<script>
   $(document).ready(function(){
    // $.ajax({
    //     type:'get',
    //     url :'http://localhost:8000/user/ajax/pizza/list',
    //     dataType : 'json',
    //     success : function(response){
    //         console.log(response)
    //     }

    // })
    $('#sortingOption').change(function(){
        $eventOpition = $('#sortingOption').val();

        if($eventOpition == 'asc'){
            $.ajax({
                type : 'get',
                url : '/user/ajax/pizza/list',
                data : { 'status' : 'asc'},
                dataType : 'json',
                success : function(response){
                    $list = '';
                    for($i=0; $i<response.length; $i++){
                        // console.log(`${response[$i].name}`)
                        $list += `
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                         <div class="product-item bg-light mb-4" id="myFrom">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="height: 250px" src="{{asset('storage/${response[$i].image}')}}" alt="">
                                 <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5> ${response[$i].price} kyats</h5>
                                </div>

                            </div>
                         </div>
                        </div>
                        `;
                    }
                    $('#dataList').html($list);
                }
            })
        }else if( $eventOpition == 'desc'){

             $.ajax({
                type : 'get',
                url : '/user/ajax/pizza/list',
                data : { 'status' : 'desc'},
                dataType : 'json',
                success : function(response){
                    $list = '';
                    for($i=0; $i<response.length; $i++){
                        // console.log(`${response[$i].name}`)
                        $list += `
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                         <div class="product-item bg-light mb-4" id="myFrom">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="height: 250px" src="{{asset('storage/${response[$i].image}')}}" alt="">
                                 <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5> ${response[$i].price} kyats</h5>
                                </div>

                            </div>
                         </div>
                        </div>
                        `;
                    }
                    $('#dataList').html($list);
                }
            })
        }


    })
   });
 </script>

@endsection
