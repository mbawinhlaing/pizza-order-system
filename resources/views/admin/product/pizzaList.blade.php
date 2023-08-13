
@extends('admin.layouts.master')
@section('title', 'Products List')

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
                                        <h2 class="title-1">Products List</h2>

                                    </div>
                                </div>
                                <div class="table-data__tool-right">
                                    <a href="{{ route('product#createPage')}}">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="fa-solid fa-plus"></i>add Pizza
                                        </button>
                                    </a>
                                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                        CSV download
                                    </button>
                                </div>
                            </div>

                           @if (session('deleteSuccess'))
                            <div class="col-4 offset-8">
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ session('deleteSuccess')}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                           @endif

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


                            <div class="row mt-2">
                                <div class="col-1 offset-10 bg-white shadow-sm p-2 text-center">
                                    <h3> <i class="fa-solid fa-database"></i> - {{ $pizzas->total()}} </h3>
                                </div>
                            </div>

                            @if ( count($pizzas) != 0)
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2 text-center">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>Price</th>
                                            <th>Categorey</th>
                                            <th>View Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pizzas as $p )
                                         <tr class="tr-shadow">
                                            <td class="col-2"> <img src="{{ asset('storage/'. $p->image)}}" class="shadow-sm" ></td>
                                            <td>{{ $p->name}}</td>
                                            <td>{{ $p->price}}</td>
                                            <td>{{ $p->category_name}}</td>
                                            <td> <i class="fa-solid fa-eye"></i> {{$p->view_count}}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{ route('product#edit',$p->id)}}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('product#updatePage',$p->id)}}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                    </a>

                                                    <a href="{{ route('product#delete',$p->id)}}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </a>

                                                </div>
                                            </td>
                                         </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $pizzas->links()}}
                            </div>
                            @else
                            <h1 class="text-secondary text-center mt-5">There is not Pizza</h1>
                            <!-- END DATA TABLE -->
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->

@endsection

