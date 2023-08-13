
@extends('admin.layouts.master')
@section('title', 'Account Details')

@section('content')

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="row">
                   <div class="col-3 offset-7 mb-3">
                    @if (session('updateSuccess'))
                    <div class="">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('updateSuccess')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                   @endif
                   </div>

                </div>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-lg-10 offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <div class="ms-5">
                                        <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                                    </div>
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Pizza info</h3>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-3">
                                            <img src="{{ asset('storage/'.$pizza->image)}}"  class="shadow-sm"/>
                                        </div>

                                        <div class="col-9" >
                                            <div class="my-2  btn bg-danger text-white d-block w-50 fs-5"> {{$pizza->name}}</div>
                                            <span class="my-2 btn bg-dark text-white"><i class="fa-solid fa-money-bill-1-wave me-2 fs-5"></i> {{ $pizza->price}}</span>
                                            <span class="my-2 btn bg-dark text-white"><i class="fa-solid fa-clock me-2 fs-5"></i> {{$pizza->waiting_time }}</span>
                                            <span class="my-2 btn bg-dark text-white"><i class="fa-solid fa-eye me-2 fs-5"></i> {{$pizza->view_count }}</span>
                                            <span class="my-2 btn bg-dark text-white"><i class="fa-solid fa-clone me-2 fs-5"></i>{{ $pizza->category_name}}</span>
                                            <span class="my-2 btn bg-dark text-white"><i class="fa-solid fa-user-clock me-2 fs-5"></i> {{$pizza->created_at ->format('j / F / y')}}</span>
                                            <div class="my-3"><i class="fa-solid fs-4 fa-file-lines me-2"></i>Details</div>
                                            <div class="">{{ $pizza->description}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->

@endsection

