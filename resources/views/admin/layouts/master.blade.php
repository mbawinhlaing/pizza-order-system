<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title> @yield('title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin/css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{asset('admin/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Vendor CSS-->
    <link href="{{ asset('admin/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('admin/css/theme.css')}}" rel="stylesheet" media="all">

    {{-- fontsweon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="#">
                    <img src="{{asset('admin/images/icon/logo.png')}}" alt="Cool Admin" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        {{-- <li class="active has-sub">
                            <a class="js-arrow" href="index.html">
                                <i class="fas fa-tachometer-alt"></i>Home Page
                            </a>
                        </li>
                        <li>
                            <a href="category.html">
                                <i class="fas fa-chart-bar"></i>Category</a>
                        </li> --}}
                        <li>
                            <a href="{{ route('category#list')}}">
                                <i class="fa-solid fa-list"></i>Category</a>
                        </li>
                        <li>
                            <a href="{{ route('product#list')}}">
                                <i class="fa-solid fa-pizza-slice"></i>Products</a>
                        </li>

                        <li>
                            <a href="{{ route('admin#orderList')}}">
                                <i class="fa-solid fa-folder-plus fa-bounce"></i>Order List</a>
                        </li>

                        <li>
                            <a href="{{ route('admin#userList')}}">
                                <i class="fa-solid fa-users"></i>User List</a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->
        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <samp class="form-header">
                                <H1> Admin Dashborad Pannel</H1>
                                {{-- <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button> --}}
                            </samp>
                            <div class="header-button">

                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">

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
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{ Auth::user()->name}}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        @if (Auth::user()->image == null)
                                                             @if (Auth::user()->gender == 'male')
                                                                <img src="{{ asset('image/default_user_boy.png')}}" class="shadow-sm" >
                                                            @else
                                                                <img src="{{ asset('image/default_user_girl.png')}}" class="shadow-sm" >
                                                            @endif
                                                        @else
                                                        <img src="{{ asset('storage/'.Auth::user()->image)}}"/>
                                                        @endif
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#">{{ Auth::user()->name}}</a>
                                                    </h5>
                                                    <span class="email">{{ Auth::user()->email}}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('admin#deails')}}">
                                                        <i class="fa-solid fa-user"></i>Account</a>
                                                </div>
                                            </div>

                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('admin#list')}}">
                                                        <i class="fa-solid fa-users"></i>Admin List</a>
                                                </div>
                                            </div>

                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('admin#changePasswordPage')}}">
                                                        <i class="fa-solid fa-key"></i>Change Password</a>
                                                </div>
                                            </div>

                                            <div class="account-dropdown__footer my-3">
                                                <form action="{{ route('logout')}}" method="post" class="d-flex justify-content-center">
                                                    @csrf
                                                    <button class="btn bg-dark text-white col-10" type="submit">
                                                            <i class="zmdi zmdi-power"></i>Logout</a>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->
            @yield('content')

            <!-- END PAGE CONTAINER-->
        </div>



    </div>

    <!-- Jquery JS-->
    <script src="{{ asset('admin/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('admin/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('admin/vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{ asset('admin/vendor/wow/wow.min.js')}}"></script>
    <script src="{{asset('admin/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('admin/vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{ asset('admin/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('admin/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('admin/vendor/select2/select2.min.js')}}">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Main JS-->
    <script src="{{asset('admin/js/main.js')}}"></script>

</body>
@yield('scriptSection')
</html>
<!-- end document-->
