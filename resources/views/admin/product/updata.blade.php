
@extends('admin.layouts.master')
@section('title', 'Edit')

@section('content')

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-lg-10 offset-1">
                            <div class="card">
                                <div class="card-body">
                                    <a href="{{ route('product#list')}}">
                                        <div class="ms-5">
                                            <i class="fa-solid fa-arrow-left text-dark" ></i>
                                        </div>
                                    </a>
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Pizza Update</h3>
                                    </div>
                                    <hr>

                                    <form action="{{ route('product#update')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-4 offset-1">
                                                <input type="hidden" name="pizzaId" value="{{ $pizza->id}}">
                                                 <img src="{{ asset('storage/'.$pizza->image)}}"  class="shadow-sm"/>
                                                 <div class="mt-3">
                                                    <input type="file" name="pizzaImage" class="form-control @error('pizzaImage') is-invalid @enderror">
                                                    @error('pizzaImage')
                                                    <div class="inalid-feedback">
                                                        {{ $message}}
                                                    </div>
                                                    @enderror
                                                 </div>
                                                 <div class="mt-3">
                                                    <button class="btn bg-dark text-white col-12" type="submit">
                                                        Update Account Profie <i class="fa-solid fa-arrow-right-to-bracket"></i>
                                                    </button>
                                                 </div>

                                            </div>
                                            <div class="row col-6">
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Name</label>
                                                    <input id="cc-pament" name="pizzaName"  type="text" class="form-control @error('pizzaName') is-invalid @enderror"
                                                        value="{{old('pizzaName',$pizza->name)}}"aria-required="true"
                                                        aria-invalid="false" placeholder="New Admin...">
                                                    @error('pizzaName')
                                                    <div class="inalid-feedback">
                                                        {{ $message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Description</label>
                                                    <textarea name="pizzaDescription" id="" cols="30" class="form-control @error('pizzaDescription') is-invalid @enderror" rows="10">{{old('pizzaDescription',$pizza->description)}}</textarea>
                                                    @error('pizzaDescription')
                                                    <div class="inalid-feedback">
                                                        {{ $message}}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Cagetory</label>
                                                    <select name="pizzaCategory" class="form-control @error('pizzaCategory') is-invalid @enderror">
                                                        <option value=""> Choose Cagetory..</option>
                                                        @foreach ($category as $c )
                                                            <option value="{{$c->id}}"@if($pizza->category_id == $c->id) selected @endif> {{ $c->name}}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('pizzaCategory')
                                                    <div class="inalid-feedback">
                                                        {{ $message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Price</label>
                                                    <input id="cc-pament" name="pizzaPrice"  type="text" class="form-control @error('pizzaPrice') is-invalid @enderror"
                                                        value="{{old('pizzaPrice',$pizza->price)}}"aria-required="true"
                                                        aria-invalid="false" placeholder="New Admin...">
                                                    @error('pizzaPrice')
                                                    <div class="inalid-feedback">
                                                        {{ $message}}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Waiting Time</label>
                                                    <input id="cc-pament" name="pizzaWaitingTime"  type="text" class="form-control @error('pizzaWaitingTime') is-invalid @enderror"
                                                        value="{{old('pizzaWaitingTime',$pizza->waiting_time)}}"aria-required="true"
                                                        aria-invalid="false" >
                                                    @error('pizzaWaitingTime')
                                                    <div class="inalid-feedback">
                                                        {{ $message}}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">View Count</label>
                                                    <input id="cc-pament" name="viewCount" disabled type="text" class="form-control"
                                                        value="{{old('viewCount',$pizza->view_count)}}"aria-required="true"
                                                        aria-invalid="false">

                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Create Data</label>
                                                    <input id="cc-pament" name="created_at"  type="text" class="form-control"value="{{$pizza->created_at ->format('j / F / y')}}" aria-required="true" aria-invalid="false" disabled>
                                                </div>
                                            </div>
                                         </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->

@endsection

