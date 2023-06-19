<!DOCTYPE html>
<html lang="en">

<head>
    <title>MITSU Backend</title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="Gradient Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords"
        content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="codedthemes" />
    <!-- Favicon icon -->

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">
    <!-- Required Fremwork -->

    <!-- <link rel="stylesheet" type="text/css" href="{{asset('files/bower_components/bootstrap/css/bootstrap.min.css')}}"> -->

    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('files/assets/icon/themify-icons/themify-icons.css')}}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{asset('files/assets/icon/icofont/css/icofont.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{asset('files/assets/icon/font-awesome/css/font-awesome.min.cs')}}s">
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css"
        href="{{asset('files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{asset('files/assets/pages/data-table/css/buttons.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{asset('files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('files/assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('files/assets/css/jquery.mCustomScrollbar.css')}}">

      <!-- jpro forms css -->
      <link rel="stylesheet" type="text/css" href="{{asset('files/assets/pages/j-pro/css/demo.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('files/assets/pages/j-pro/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('files/assets/pages/j-pro/css/j-pro-modern.css')}}">
      <!-- Switch component css -->
      <link rel="stylesheet" type="text/css" href="{{asset('files/bower_components/switchery/css/switchery.min.css')}}">

    <!-- เสริม -->
    <!-- sweet alert framework -->
    <link rel="stylesheet" type="text/css" href="{{asset('files/bower_components/sweetalert/css/sweetalert.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{asset('files/assets/icon/font-awesome/css/font-awesome.min.css')}}">
    <!-- animation nifty modal window effects css -->
    <link rel="stylesheet" type="text/css" href="{{asset('files/assets/css/component.css')}}">
    <!-- เสริม -->


    <!-- ตาปิดเปิด -->
    <!-- https://www.w3resource.com/icon/font-awesome/web-application-icons/eye-slash.php -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
       <!-- ตาปิดเปิด -->



    <!-- เรียงลำดับ -->
    <style>
    .sortable {
        list-style-type: none;
        margin: 0;
        padding: 0;
        width: 1500px;
    }

    .sortable li {
        margin: 3px 3px 3px 0;
        padding: 1px;
        float: left;
        width: 100px;
        height: 90px;
        font-size: 4em;
        text-align: center;
    }
    </style>
    <!-- เรียงลำดับ -->



    <link rel="icon" href="{{asset('img/back.jpg')}}">

    <script src="https://cdn.tiny.cloud/1/lbofybl1owssztg9a8memm8o5ydzb5mn8y1qt9e3yfki6jkq/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <!-- <script>tinymce.init({ selector:'#tt' });</script> -->
    <script>
    tinymce.init({
        selector: '#tt1'
    });
    </script>
    <script>
    tinymce.init({
        selector: '#tt2'
    });
    </script>
    <script>
    tinymce.init({
        selector: '#tt3'
    });
    </script>

    <!-- summernote -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
     <!-- summernote -->




    <!-- inputfile -->
    <style>
    .hidden {
        display: none;
        visibility: hidden;
    }
    </style>
    <!-- inputfile -->



    <!-- SELECT2 -->
    <!-- <select name="position" id="" class="form-control select2-single" multiple="multiple"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" />

    <style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice span {
        color: #060606;
    }
    </style>
    <!-- SELECT2 -->

    <style>
    .navbar {
        background: linear-gradient(to right, #000, #0fb3c2);

    }
    </style>


    @yield('head')


    <style>
    .pcoded .pcoded-header[header-theme="theme5"] {
        background: linear-gradient(to right, #FEE702, #000000);
    }

    .pcoded .pcoded-navbar[active-item-theme="theme10"] .pcoded-item>li.active>a:before {
        border-left-color: #FEE702;
    }

    .pcoded .pcoded-navbar[active-item-theme="theme10"] .pcoded-item li .pcoded-submenu li.active>a,
    .pcoded .pcoded-navbar[active-item-theme="theme4"] .pcoded-item li .pcoded-submenu li:hover>a {
        color: #FEE702 !important;
    }

    .pcoded .pcoded-navbar[active-item-theme="theme10"] .pcoded-item .pcoded-hasmenu[subitem-icon="style7"] .pcoded-submenu>li.active>a>.pcoded-mtext:after,
    .pcoded .pcoded-navbar[active-item-theme="theme10"] .pcoded-item .pcoded-hasmenu[subitem-icon="style7"] .pcoded-submenu>li:hover>a>.pcoded-mtext:after {
        background-color: #ffffff;
    }

    .pcoded .pcoded-navbar[navbar-theme="theme1"] .pcoded-item>li.active>a {
        color: #FEE702;
        border-bottom-color: #FEE702;
    }

    .pcoded .pcoded-navbar[active-item-theme="theme10"] .pcoded-item li .pcoded-submenu li.active>a,
    .pcoded .pcoded-navbar[active-item-theme="theme10"] .pcoded-item li .pcoded-submenu li:hover>a {
        color: #FEE702 !important;
    }

    .pcoded .pcoded-navbar[active-item-theme="theme10"] .pcoded-item li:hover>a {
        color: #FEE702 !important;
    }

    .pcoded .pcoded-navbar[active-item-theme="theme10"] .pcoded-item li:hover>a .pcoded-micon {
        color: #FEE702 !important;
    }

    .label-danger {
        background: linear-gradient(45deg, #000000, #FEE702);
    }
    </style>
</head>

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="loader-bar"></div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <nav class="navbar header-navbar pcoded-header" header-theme="themelight2">

                <div class="navbar-wrapper">

                    <div class="navbar-logo" logo-theme="theme6">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <div class="mobile-search">
                            <div class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-addon search-close"><i class="ti-close"></i></span>
                                        <input type="text" class="form-control" placeholder="Enter Keyword">
                                        {{-- <span class="input-group-addon search-btn"><i class="ti-search"></i></span> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{url('/backend')}}">
                            <img class="img-fluid" src="{{asset('img/back.jpg')}}" alt="Theme-Logo" width="100px" />
                            <!-- <h7>MITSU Backend</h7> -->
                        </a>
                        <a class="mobile-options">
                            <i class="ti-more"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a>
                                </div>
                            </li>
                            <!-- <li class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-addon search-close"><i class="ti-close"></i></span>
                                        <input type="text" class="form-control">
                                        <span class="input-group-addon search-btn"><i class="ti-search"></i></span>
                                    </div>
                                </div>
                            </li> -->
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">

                            <li class="user-profile header-notification">
                                <a href="#!">
                                    <img src="{{asset('img/admin.jpg')}}" class="img-radius" alt="User-Profile-Image">
                                    <span>{{ Auth::user()->name }}</span>
                                    <i class="ti-angle-down"></i>
                                </a>
                                <ul class="show-notification profile-notification">

                                    <li>
                                        <a href="{{ url('/logout') }}">
                                            <i class="ti-layout-sidebar-left"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Sidebar chat start -->

            <!-- Sidebar inner chat end-->

            <div class="pcoded-main-container" style="background-color:white;">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">


                            <!-- MENU -->
                            <div class="pcoded-navigation-label">เมนูทั่วไป <i class="ti-github"></i></div>
                            <!-- MENU -->


                            @if(Auth::user()->type == 0)
                            <!-- admin Page-->
                            <ul class="pcoded-item pcoded-left-item">
                                <!-- Start-->
                                @if(isset($page)) @if($page=="admin_user") <li
                                    class="pcoded-hasmenu active pcoded-trigger">
                                    @else
                                <li class="pcoded-hasmenu"> @endif
                                    @else
                                <li class="pcoded-hasmenu"> @endif
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon" style="color: gold;"><i
                                                class="ti-eye"></i><b>D</b></span>
                                        <span class="pcoded-mtext" style="color: gold;">ADMIN</span>
                                        <span class="pcoded-mcaret"></span>
                                        <!-- <span class="pcoded-badge label label-danger">1</span> -->
                                    </a>

                                    <!-- admin -->
                                    <ul class="pcoded-submenu">
                                        @if(isset($list)) @if($list=="admin_user") <li class="active"> @else
                                        <li class=""> @endif
                                            @else
                                        <li class=""> @endif
                                            <a href="{{url('backend/admin_user')}}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext" style="color: gold;">Manage Admin</span>
                                                <span class="pcoded-mcaret"></span>
                                                <!-- <span class="pcoded-badge label label-danger">1</span> -->
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- admin -->

                                    <!-- End-->
                                </li>
                            </ul>
                            <!-- admin Page-->
                            @endif




                               <!-- USER Page-->
                               <ul class="pcoded-item pcoded-left-item">
                                <!-- Start-->
                                @if(isset($page)) @if($page=="user") <li class="pcoded-hasmenu active pcoded-trigger">
                                    @else
                                <li class="pcoded-hasmenu"> @endif
                                    @else
                                <li class="pcoded-hasmenu"> @endif
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-user"></i><b> </b></span>
                                        <span class="pcoded-mtext">USER</span>
                                        <span class="pcoded-mcaret"></span>
                                        <!-- <span class="pcoded-badge label label-danger">1</span> -->
                                        <?php $num=DB::table('users')->where('type','>',2)->where('status',0)->get(); $nums=count($num); ?>
                                        @if($nums!=0)<span class="pcoded-badge label label-danger">{{$nums}}</span>@endif
                                    </a>

                                       <!-- USER -->
                                       <ul class="pcoded-submenu">
                                        @if(isset($list)) @if($list=="wait_user") <li class="active"> @else
                                        <li class=""> @endif
                                            @else
                                        <li class=""> @endif
                                            <a href="{{url('backend/wait_user')}}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">USER รอการยืนยัน</span>
                                                <span class="pcoded-mcaret"></span>
                                                <?php $num=DB::table('users')->where('type','>',2)->where('status',0)->get(); $nums=count($num); ?>
                                                @if($nums!=0)<span class="pcoded-badge label label-danger">{{$nums}}</span>@endif
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- USER -->


                                    <!-- USER -->
                                    <ul class="pcoded-submenu">
                                        @if(isset($list)) @if($list=="user") <li class="active"> @else
                                        <li class=""> @endif
                                            @else
                                        <li class=""> @endif
                                            <a href="{{url('backend/user')}}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">USER</span>
                                                <span class="pcoded-mcaret"></span>
                                                <!-- <span class="pcoded-badge label label-danger">1</span>  -->
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- USER -->

                                </li>
                            </ul>
                            <!-- USER Page-->




                            <!-- Home Page-->
                            <!-- <ul class="pcoded-item pcoded-left-item"> -->
                                <!-- Start-->
                                <!-- @if(isset($page)) @if($page=="home") <li class="pcoded-hasmenu active pcoded-trigger">
                                    @else
                                <li class="pcoded-hasmenu"> @endif
                                    @else
                                <li class="pcoded-hasmenu"> @endif
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-home"></i><b> </b></span>
                                        <span class="pcoded-mtext">หน้าหลัก</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a> -->


                                    <!-- BANNER -->
                                    <!-- <ul class="pcoded-submenu">
                                        @if(isset($list)) @if($list=="banner") <li class="active"> @else
                                        <li class=""> @endif
                                            @else
                                        <li class=""> @endif
                                            <a href="{{url('backend/banner')}}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">BANNER</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul> -->
                                    <!-- BANNER -->

                                <!-- </li>
                            </ul> -->
                            <!-- Home Page-->


                             <!-- NEWS-->
                             <ul class="pcoded-item pcoded-left-item">
                                <!-- Start-->
                                @if(isset($page)) @if($page=="news") <li class="pcoded-hasmenu active pcoded-trigger">
                                    @else
                                <li class="pcoded-hasmenu"> @endif
                                    @else
                                <li class="pcoded-hasmenu"> @endif
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-book"></i><b>D</b></span>
                                        <span class="pcoded-mtext">ข่าวสารและกิจกรรม</span>
                                        <span class="pcoded-mcaret"></span>
                                        <!-- <span class="pcoded-badge label label-danger">1</span> -->
                                    </a>

                                    <!-- news -->
                                    <ul class="pcoded-submenu">
                                        @if(isset($list)) @if($list=="news") <li class="active"> @else
                                        <li class=""> @endif
                                            @else
                                        <li class=""> @endif
                                            <a href="{{url('backend/news')}}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">ข้อมูล</span>
                                                <span class="pcoded-mcaret"></span>
                                                <!-- <span class="pcoded-badge label label-danger">1</span> -->
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- news -->

                                    <!-- End-->
                                </li>
                            </ul>
                            <!-- NEWS-->


                              <!-- MARKET-->
                              <ul class="pcoded-item pcoded-left-item">
                                <!-- Start-->
                                @if(isset($page)) @if($page=="market") <li class="pcoded-hasmenu active pcoded-trigger">
                                    @else
                                <li class="pcoded-hasmenu"> @endif
                                    @else
                                <li class="pcoded-hasmenu"> @endif
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                        <span class="pcoded-mtext">MARKET</span>
                                        <span class="pcoded-mcaret"></span>
                                        <!-- <span class="pcoded-badge label label-danger">1</span> -->
                                    </a>

                                    <!-- market -->
                                    <ul class="pcoded-submenu">
                                        @if(isset($list)) @if($list=="market") <li class="active"> @else
                                        <li class=""> @endif
                                            @else
                                        <li class=""> @endif
                                            <a href="{{url('backend/market')}}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">MARKET</span>
                                                <span class="pcoded-mcaret"></span>
                                                <!-- <span class="pcoded-badge label label-danger">1</span> -->
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- market -->

                                    <!-- End-->
                                </li>
                            </ul>
                            <!-- MARKET-->

                            <!-- Air Conditioner-->
                            <ul class="pcoded-item pcoded-left-item">
                                <!-- Start-->
                                @if(isset($page)) @if($page=="air_conditioner") <li class="pcoded-hasmenu active pcoded-trigger">
                                    @else
                                <li class="pcoded-hasmenu"> @endif
                                    @else
                                <li class="pcoded-hasmenu"> @endif
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-settings"></i><b>D</b></span>
                                        <span class="pcoded-mtext">รายการเครื่องปรับอากาศ</span>
                                        <span class="pcoded-mcaret"></span>
                                        <!-- <span class="pcoded-badge label label-danger">1</span> -->
                                    </a>

                                    <!-- Air Conditioner -->
                                    <ul class="pcoded-submenu">
                                        @if(isset($list)) @if($list=="air_conditioner") <li class="active"> @else
                                        <li class=""> @endif
                                            @else
                                        <li class=""> @endif
                                            <a href="{{url('backend/air_conditioner')}}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">ข้อมูล</span>
                                                <span class="pcoded-mcaret"></span>
                                                <!-- <span class="pcoded-badge label label-danger">1</span> -->
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- Air Conditioner -->

                                    <!-- End-->
                                </li>
                            </ul>
                            <!-- Air Conditioner-->

                            <!-- Training-->
                            <ul class="pcoded-item pcoded-left-item">
                                <!-- Start-->
                                @if(isset($page)) @if($page=="training") <li class="pcoded-hasmenu active pcoded-trigger">
                                    @else
                                <li class="pcoded-hasmenu"> @endif
                                    @else
                                <li class="pcoded-hasmenu"> @endif
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-bag"></i><b>D</b></span>
                                        <span class="pcoded-mtext">รายการฝึกอบรม</span>
                                        <span class="pcoded-mcaret"></span>
                                        <!-- <span class="pcoded-badge label label-danger">1</span> -->
                                    </a>

                                    <!-- Training -->
                                    <ul class="pcoded-submenu">
                                        @if(isset($list)) @if($list=="training") <li class="active"> @else
                                        <li class=""> @endif
                                            @else
                                        <li class=""> @endif
                                            <a href="{{url('backend/training')}}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">ข้อมูล</span>
                                                <span class="pcoded-mcaret"></span>
                                                <!-- <span class="pcoded-badge label label-danger">1</span> -->
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- Training-->

                                    <!-- End-->
                                </li>
                            </ul>
                            <!--Training-->



                               <!-- item_point-->
                               <ul class="pcoded-item pcoded-left-item">
                                <!-- Start-->
                                @if(isset($page)) @if($page=="item_point") <li class="pcoded-hasmenu active pcoded-trigger">
                                    @else
                                <li class="pcoded-hasmenu"> @endif
                                    @else
                                <li class="pcoded-hasmenu"> @endif
                                    <a href="javascript:void(0)">
                                        <span class="pcoded-micon"><i class="ti-book"></i><b>D</b></span>
                                        <span class="pcoded-mtext">จัดการ Item Point</span>
                                        <span class="pcoded-mcaret"></span>
                                        <?php $dd=DB::table('buy_point')->where('status',0)->get(); $ddr=count($dd); ?>
                                                @if($ddr!=0)<span
                                                    class="pcoded-badge label label-danger">{{$ddr}}</span>@endif
                                        <!-- <span class="pcoded-badge label label-danger">1</span> -->
                                    </a>

                                    <!-- item_point -->
                                    <ul class="pcoded-submenu">
                                        @if(isset($list)) @if($list=="item_point") <li class="active"> @else
                                        <li class=""> @endif
                                            @else
                                        <li class=""> @endif
                                            <a href="{{url('backend/item_point')}}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Item</span>
                                                <span class="pcoded-mcaret"></span>
                                                <!-- <span class="pcoded-badge label label-danger">1</span> -->
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- item_point -->

                                    <!-- item_point -->
                                    <ul class="pcoded-submenu">
                                        @if(isset($list)) @if($list=="wait_point") <li class="active"> @else
                                        <li class=""> @endif
                                            @else
                                        <li class=""> @endif
                                            <a href="{{url('backend/wait_point')}}">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">แลกเปลี่ยนรอยืนยัน</span>
                                                <span class="pcoded-mcaret"></span>
                                                <?php $dd=DB::table('buy_point')->where('status',0)->get(); $ddr=count($dd); ?>
                                                @if($ddr!=0)<span
                                                    class="pcoded-badge label label-danger">{{$ddr}}</span>@endif
                                                <!-- <span class="pcoded-badge label label-danger">1</span> -->
                                            </a>
                                        </li>
                                    </ul>
                                    <!-- item_point -->

                                    <!-- End-->
                                </li>
                            </ul>
                            <!-- item_point-->










                            <br> <br> <br> <br>
                        </div>
                    </nav>

                    @yield('content')
                </div>
            </div>
        </div>



<!-- แสดงภาพตอนเลือกไฟล -->
        <script>
        function readURL(input, target) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(target).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
        </script>
      <!-- แสดงภาพตอนเลือกไฟล -->



<!-- จัดการ DATATABLE -->
<script type="text/javascript">
        $(document).ready(function() {
            $('#simpletable').dataTable({
                order:[],
                stateSave: true,
                stateSaveCallback: function(settings,data) {
                localStorage.setItem( 'DataTables_' + settings.sInstance, JSON.stringify(data) )
                },
                stateLoadCallback: function(settings) {
                return JSON.parse( localStorage.getItem( 'DataTables_' + settings.sInstance ) )
                }
            });
        } );
    </script>

      <!-- <script>
        $(document).ready(function () {
    $('#simpletable').DataTable({
        paging: false,
        ordering: false,
        info: false,
    });
});
    </script> -->

    <!-- จัดการ DATATABLE -->

        <!-- เสริม -->
        <script src="{{asset('files/bower_components/sweetalert/js/sweetalert.min.js')}}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{asset('files/assets/js/modal.js')}}"></script>
        <!-- sweet alert modal.js intialize js -->
        <!-- modalEffects js nifty modal window effects -->
        <script src="{{asset('files/assets/js/classie.js')}}"></script>
        <script src="{{asset('files/assets/js/modalEffects.js')}}"></script>
         <!-- Validation js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script  src="{{asset('files/assets/pages/form-validation/validate.js')}}"></script>
    <!-- Custom js -->
    <script  src="{{asset('files/assets/pages/form-validation/form-validation.js')}}"></script>
        <!-- เสริม -->

    <!-- Switch component js -->
    <script  src="{{asset('files/bower_components/switchery/js/switchery.min.js')}}"></script>


         <!-- Required Jquery -->
         <!-- ตัวสำคัญแต่ชน summernote -->
        <!-- <script  src="{{asset('files/bower_components/jquery/js/jquery.min.js')}}"></script> -->
        <script src="{{asset('files/bower_components/jquery-ui/js/jquery-ui.min.js')}}"></script>
        <script src="{{asset('files/bower_components/popper.js/js/popper.min.js')}}"></script>
        <script src="{{asset('files/bower_components/bootstrap/js/bootstrap.min.js')}}"></script>
        <!-- Required Jquery -->


        <!-- jquery slimscroll js -->
        <script src="{{asset('files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}}"></script>
        <!-- modernizr js -->
        <script src="{{asset('files/bower_components/modernizr/js/modernizr.js')}}"></script>
        <script src="{{asset('files/bower_components/modernizr/js/css-scrollbars.js')}}"></script>
        <!-- data-table js -->
        <script src="{{asset('files/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('files/assets/pages/data-table/js/jszip.min.js')}}"></script>
        <script src="{{asset('files/assets/pages/data-table/js/pdfmake.min.js')}}"></script>
        <script src="{{asset('files/assets/pages/data-table/js/vfs_fonts.js')}}"></script>
        <script src="{{asset('files/bower_components/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{asset('files/bower_components/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{asset('files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js')}}">
        </script>
        <script src="{{asset('files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}">
        </script>
        <!-- Custom js -->
        <script src="{{asset('files/assets/pages/data-table/js/data-table-custom.js')}}"></script>
        <script src="{{asset('files/assets/js/pcoded.min.js')}}"></script>
        <script src="{{asset('files/assets/js/dark-light/vertical-layout.min.js')}}"></script>
        <script src="{{asset('files/assets/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
        <script src="{{asset('files/assets/js/script.js')}}"></script>

          <!-- j-pro js -->
    <script  src="{{asset('files/assets/pages/j-pro/js/jquery.ui.min.js')}}"></script>
    <script  src="{{asset('files/assets/pages/j-pro/js/jquery.maskedinput.min.js')}}"></script>
    <script  src="{{asset('files/assets/pages/j-pro/js/jquery.j-pro.js')}}"></script>
    <!-- Switch component js -->
    <script  src="{{asset('files/bower_components/switchery/js/switchery.min.js')}}"></script>


        <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>

        <script>
        CKEDITOR.replace('editor1');
        </script>
        <script>
        CKEDITOR.replace('editor2');
        </script>



        <!-- <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
        </script>
        <script>
        $(document).ready(function() {
            $('#summernote2').summernote();
        });
        </script>
        <script>
        $(document).ready(function() {
            $('#summernote3').summernote();
        });
        </script> -->







        <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],

            });
        });
        </script>


        <script>
        $(document).ready(function() {
            $('#summernote1').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],

            });
        });
        </script>

        <script>
        $(document).ready(function() {
            $('#summernote2').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],

            });
        });
        </script>

        <script>
        $(document).ready(function() {
            $('#summernote3').summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                ],

            });
        });
        </script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>


        <!-- เปลี่ยนลักษณะปุ่ม -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- เปลี่ยนลักษณะปุ่ม -->


        <script>
        //เรียกใช้งาน Select2
        $(".select2-single").select2();
        </script>


        @if(session('success'))
        <script>
        alert('{{session("success")}}');
        </script>
        @endif

        @if(session('error'))
        <script>
        alert('{{session("error")}}');
        </script>
        @endif

        @if(session('message'))
        <script>
        alert('{{session("message")}}');
        </script>
        @endif

        <!-- เรียงลำดับ news-->
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
        <script>
        $(function() {
            $(".sortable").sortable({
                update: function(event, ui) {
                    updateOrder();
                }
            });
            $(".sortable").disableSelection();
        });

        function updateOrder() {
            var item_order = new Array();
            $('.num').each(function() {
                item_order.push($(this).attr("id"));
            });
            var num = item_order;
            console.log(num);
            $.ajax({

                type: "POST",
                url: "{{url('/numupdate')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    num: num
                },
                cache: false,
                success: function(data) {
                    $("#test").html(data);
                }
            });
        }
        </script>
        <!-- เรียงลำดับ news-->





        @yield('script')
</body>


</html>
