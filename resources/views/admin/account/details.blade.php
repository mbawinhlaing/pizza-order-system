
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

                                    <div class="card-title">
                                        <h3 class="text-center title-2">Account infor</h3>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-3 offset-1">
                                            @if (Auth::user()->image == null)
                                                    @if (Auth::user()->gender == 'male')
                                                    <img src="{{ asset('image/default_user_boy.png')}}" class="shadow-sm" >
                                                @else
                                                    <img src="{{ asset('image/default_user_girl.png')}}" class="shadow-sm" >
                                                @endif
                                            @else
                                            <img src="{{ asset('storage/'.Auth::user()->image)}}"/>
                                            @endif
                                        </div>

                                        <div class="col-5 offset-1" >
                                            <h3 class="my-2"><i class="fa-solid fa-user-pen"></i> {{ Auth::user()->name}}</h3>
                                            <h3 class="my-2"><i class="fa-regular fa-envelope"></i> {{ Auth::user()->email}}</h3>
                                            <h3 class="my-2"><i class="fa-solid fa-mobile"></i> {{ Auth::user()->phone}}</h3>
                                            <h3 class="my-2"><i class="fa-solid fa-map-location"></i> {{ Auth::user()->address}}</h3>
                                            <h3 class="my-2"><i class="fa-solid fa-mars-and-venus"></i>{{ Auth::user()->gender}}</h3>
                                            <h3 class="my-2"><i class="fa-solid fa-user-clock"></i> {{ Auth::user()->created_at->format('j / F / y')}}</h3>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-4 offset-1 mt-3">
                                            <a href="{{ route('admin#edit')}}">
                                                <div class="btn bg-dark text-white">
                                                    <i class="fa-solid fa-pen-to-square me-2"></i> Edit Profile
                                                </div>
                                            </a>
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

