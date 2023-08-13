
@extends('admin.layouts.master')
@section('title', 'Order List')

@section('content')

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <!-- DATA TABLE -->
                            <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2 text-center">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Gender</th>
                                            <th>Phone</th>
                                            <th>Role</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dataList">
                                       @foreach ( $users as $user)
                                        <tr>
                                            <td class="col-2">
                                            @if ($user->image==null)
                                                @if ($user->gender == 'male')
                                                    <img src="{{ asset('image/default_user_boy.png')}}" class="shadow-sm" >
                                                @else
                                                    <img src="{{ asset('image/default_user_girl.png')}}" class="shadow-sm" >
                                                @endif
                                            @else
                                            <img src="{{ asset('storage/'. $user->image)}}" class="shadow-sm" >

                                            @endif
                                            </td>

                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->gender}}</td>
                                            <td>{{$user->phone}}</td>
                                            <input type="hidden" id="userId" value="{{$user->id}}">
                                            <td>
                                                <select class="form-control changeStatus">
                                                    <option value="user" @if($user->role == 'user' ) selected @endif >User</option>
                                                    <option value="admin" @if($user->role =='admin' ) selected @endif >Admin</option>
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
        $('.changeStatus').change(function(){
             $currectStatus = $(this).val();
             $parentNode = $(this).parents("tr");
             $userId= $parentNode.find('#userId').val();
             $data={
                'userId' :$userId,
                'role':$currectStatus
             };

             $.ajax({
                type:'get',
                url:'/user/change/role',
                data : $data,
                dataType:'json' ,
             })
            location.reload();
        })
    })
 </script>

@endsection
