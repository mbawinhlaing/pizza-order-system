@extends('user.layouts.master')

@section('content')


            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-lg-10 offset-1">
                            <div class="card">
                                <div class="card-body">

                                    <div class="card-title">
                                        <h3 class="text-center title-2">Account Profile</h3>
                                    </div>
                                    <hr>

                                    @if (session('updateSuccess'))
                                    <div class="col-12">
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            {{ session('updateSuccess')}}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>
                                   @endif

                                    <form action="{{ route('user#accountChange', Auth::user()->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-4 offset-1">

                                                <div class="row">
                                                    @if (Auth::user()->image == null)
                                                    <img src="{{ asset('image/default_user_boy.png')}}"  class="shadow-sm"/>
                                                    @else
                                                    <img src="{{ asset('storage/'.Auth::user()->image)}}"/>
                                                    @endif
                                                </div>

                                                 <div class="mt-3">
                                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                                    @error('image')
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
                                                    <input id="cc-pament" name="name"  type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name',Auth::user()->name)}}"aria-required="true" aria-invalid="false" placeholder="New Admin...">
                                                    @error('name')
                                                    <div class="inalid-feedback">
                                                        {{ $message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Email</label>
                                                    <input id="cc-pament" name="email"  type="email" class="form-control @error('email') is-invalid @enderror"value="{{old('email',Auth::user()->email)}}" aria-required="true" aria-invalid="false" placeholder="New text...">
                                                    @error('email')
                                                    <div class="inalid-feedback">
                                                        {{ $message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Phone</label>
                                                    <input id="cc-pament" name="phone"  type="number" class="form-control @error('phone') is-invalid @enderror"value="{{old('phone',Auth::user()->phone)}}" aria-required="true" aria-invalid="false" placeholder="New text...">
                                                    @error('phone')
                                                    <div class="inalid-feedback">
                                                        {{ $message}}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Gender</label>
                                                    <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                                        <option value=""> Choose Gender..</option>
                                                        <option value="male" @if (Auth::user()->gender == 'male') selected @endif>Mal</option>
                                                        <option value="female" @if (Auth::user()->gender == 'female') selected @endif>Female</option>
                                                    </select>
                                                    @error('gender')
                                                    <div class="inalid-feedback">
                                                        {{ $message}}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Address</label>
                                                    <textarea name="address" id="" cols="30" class="form-control @error('address') is-invalid @enderror" rows="10">{{old('address',Auth::user()->address)}}</textarea>
                                                    @error('address')
                                                    <div class="inalid-feedback">
                                                        {{ $message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Role</label>
                                                    <input id="cc-pament" name="role"  type="text" class="form-control"value="{{old('role',Auth::user()->role)}}" aria-required="true" aria-invalid="false" disabled>
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

