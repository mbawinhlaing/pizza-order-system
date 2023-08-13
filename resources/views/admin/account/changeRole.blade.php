
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
                                    <a href="{{ route('admin#list')}}">
                                        <div class="ms-5">
                                            <i class="fa-solid fa-arrow-left text-dark" ></i>
                                        </div>
                                    </a>
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Change Role</h3>
                                    </div>
                                    <hr>

                                    <form action="{{ route('admin#change', $account->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-4 offset-1">
                                                 @if ($account->image == null)
                                                    @if ($account->gender == 'male')
                                                        <img src="{{ asset('image/default_user_boy.png')}}" class="shadow-sm" >
                                                    @else
                                                        <img src="{{ asset('image/default_user_girl.png')}}" class="shadow-sm" >
                                                    @endif
                                                 @else
                                                 <img src="{{ asset('storage/'.$account->image)}}"/>
                                                 @endif


                                                 <div class="mt-3">
                                                    <button class="btn bg-dark text-white col-12" type="submit">
                                                        Change Role <i class="fa-solid fa-arrow-right-to-bracket"></i>
                                                    </button>
                                                 </div>

                                            </div>
                                            <div class="row col-6">
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Name</label>
                                                    <input id="cc-pament" name="name" disabled type="text" class="form-control @error('name') is-invalid @enderror" value="{{old('name',$account->name)}}"aria-required="true" aria-invalid="false" placeholder="New Admin...">
                                                    @error('name')
                                                    <div class="inalid-feedback">
                                                        {{ $message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Role</label>
                                                    <select name="role" class="form-control">
                                                        <option value="admin" @if($account->role == 'admin') selected @endif>Admin</option>
                                                        <option value="user" @if($account->role == 'user') selected @endif>User</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Email</label>
                                                    <input id="cc-pament" name="email" disabled type="email" class="form-control @error('email') is-invalid @enderror"value="{{old('email',$account->email)}}" aria-required="true" aria-invalid="false" placeholder="New text...">
                                                    @error('email')
                                                    <div class="inalid-feedback">
                                                        {{ $message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Phone</label>
                                                    <input id="cc-pament" name="phone" disabled type="number" class="form-control @error('phone') is-invalid @enderror"value="{{old('phone',$account->phone)}}" aria-required="true" aria-invalid="false" placeholder="New text...">
                                                    @error('phone')
                                                    <div class="inalid-feedback">
                                                        {{ $message}}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Gender</label>
                                                    <select name="gender" disabled class="form-control @error('gender') is-invalid @enderror">
                                                        <option value=""> Choose Gender..</option>
                                                        <option value="male" @if ($account->gender == 'male') selected @endif>Mal</option>
                                                        <option value="female" @if ($account->gender == 'female') selected @endif>Female</option>
                                                    </select>
                                                    @error('gender')
                                                    <div class="inalid-feedback">
                                                        {{ $message}}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label mb-1">Address</label>
                                                    <textarea name="address" id="" cols="30" disabled class="form-control @error('address') is-invalid @enderror" rows="10">{{old('address',$account->address)}}</textarea>
                                                    @error('address')
                                                    <div class="inalid-feedback">
                                                        {{ $message}}
                                                    </div>
                                                    @enderror
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

