<!DOCTYPE html>
<html lang="en">

<head>
    <title>Mitsu CHANGEPASS</title>
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
    <meta name="description" content="Gradient Able Bootstrap admin template made using Bootstrap 4 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="codedthemes" />
    <!-- Favicon icon -->

    <!-- <link rel="icon" href="{{asset('files/assets/images/favicon.ico')}}" type="image/x-icon"> -->

    
    <!-- Google font--><link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="{{asset('files/bower_components/bootstrap/css/bootstrap.min.css')}}">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="{{asset('files/assets/icon/themify-icons/themify-icons.css')}}">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="{{asset('files/assets/icon/icofont/css/icofont.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{asset('files/assets/icon/font-awesome/css/font-awesome.min.css')}}">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="{{asset('files/assets/css/style.css')}}">

    <link rel="icon" href="{{asset('img/pic_ad.png')}}">

    <style>
        .common-img-bg {
    background-size: cover;
    background: linear-gradient(45deg, #FEE702, #000000);
    height: 100%;
    }

    .btn, .sweet-alert button.confirm, .wizard>.actions a {
    background-color: #FEE702;
    border-color: #000000;
    color: #fff;
    cursor: pointer;
    transition: all ease-in 0.3s;
    }

    </style>



</head>



<body class="fix-menu">


@if($user!=null)
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="loader-bar"></div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <section class="login p-fixed d-flex text-center bg-primary common-img-bg">
        <!-- Container-fluid starts -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- Authentication card start -->
                    <div class="login-card card-block auth-body mr-auto ml-auto">
                        <form class="md-float-material" method="POST" action="{{ url('/change_pass') }}">
                        @csrf
                            <div class="text-center">
                                <!-- <img src="{{asset('img/pic.jpg')}}" style="width:300px" alt="logo.png"> -->
                            </div>
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-left txt-primary">Change Password</h3>
                                    </div>
                                </div>
                                <hr/>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="New Password" name="pass" required value="<?php echo session('pass'); ?>">
                                    <input type="hidden" name="id" value="{{$user->id}}">
                                    <span class="md-line"></span>
                                </div>

                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter password again " name="pass_check" required value="<?php echo session('pass_check'); ?>">
                                    <span class="md-line"></span>
                                </div>

                                <div class="row m-t-25 text-left">
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" onclick="return confirm('Confirm?');" class="btn  btn-md btn-block waves-effect text-center m-b-20">Submit</button>
                                    </div>
                                </div>
                                <hr/>
                                <img src="{{asset('img/back.jpg')}}" style="width:300px" alt="small-logo.png">

                            </div>
                        </form>
                        <!-- end of form -->
                    </div>
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script  src="{{asset('files/bower_components/jquery/js/jquery.min.js')}}"></script>
    <script  src="{{asset('files/bower_components/jquery-ui/js/jquery-ui.min.js')}}"></script>
    <script  src="{{asset('files/bower_components/popper.js/js/popper.min.js')}}"></script>
    <script  src="{{asset('files/bower_components/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- jquery slimscroll js -->
    <script  src="{{asset('files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js')}}"></script>
    <!-- modernizr js -->
    <script  src="{{asset('files/bower_components/modernizr/js/modernizr.js')}}"></script>
    <script  src="{{asset('files/bower_components/modernizr/js/css-scrollbars.js')}}"></script>
    <!-- i18next.min.js -->
    <script  src="{{asset('files/bower_components/i18next/js/i18next.min.js')}}"></script>
    <script  src="{{asset('files/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js')}}"></script>
    <script  src="{{asset('files/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js')}}"></script>
    <script  src="{{asset('files/bower_components/jquery-i18next/js/jquery-i18next.min.js')}}"></script>
    <script  src="{{asset('files/assets/js/common-pages.js')}}"></script>

    @else

    @endif



    @if(session('success'))
        <script>
        alert('{{session("success")}}');
        </script>
        @endif


        
</body>


</html>