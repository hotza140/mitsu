!DOCTYPE html>
<html lang="TH">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>PDF WORK</title>


    <!-- Styles -->

    <style>

        html,
        body {
            font-family: "Garuda";
        }
    </style>


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

</head>

<body>

    <?php  $data=App\WO::where('id',$id)->first();  ?>

    @if($data)
    <div class="page-body">
        <div class="row">

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-block">


                        <div class="dt-responsive table-responsive text-center">
                            <center><img src="{{asset('img/back.jpg')}}" width="200px"></center>
                            <br><br>
                        </div>

                        <div align="right">
                            <p>เลขที่ใบงาน : {{$data->wo_number}}</p>
                        </div>

                        <?php $cus=App\Models\Customer::where('id',$data->customer_id)->first(); ?>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="col-form-label">ลูกค้า :
                                    <?php if(isset($cus)){echo $cus->first_name.' '.$cus->last_name;} ?>
                                </label>

                            </div>
                            <div class="col-sm-12">
                                <label class="col-form-label">โทร :
                                    <?php if(isset($cus)){echo $cus->phone;} ?>
                                </label>

                            </div>
                            <div class="col-sm-12">
                                <label class="col-form-label">ที่อยู่ :
                                    <?php if(isset($cus)){echo $cus->address.' '.$cus->more_address;} ?>
                                </label>

                            </div>
                        </div>
                        <br>



                        <!-- <div align="center">
                            <p>รายการค่าแรงและค่าอะไหล่</p>
                        </div> -->
                        <?php $pro=App\WO_item::where('id_wo',$data->id)->where('status',0)->get(); ?>
                        <div class="form-group row">
                            <table class="table table-striped table-bordered nowrap">
                                <tr>
                                    <!-- <td><b>
                                            <center>รายการที่</center>
                                        </b></td> -->
                                    <td><b>
                                            <center>รายละเอียด</center>
                                        </b></td>
                                    <td><b>
                                            <center>Q</center>
                                        </b></td>
                                    <td><b>
                                            <center>Baht</center>
                                        </b></td>
                                </tr>

                                @foreach($pro as $key=> $pros)
                                <tr>
                                    <!-- <td>{{$key+1}}</td> -->
                                    <td>
                                        <center>{{$pros->title}}</center>
                                    </td>
                                    <td>
                                        <center>{{$pros->number}}</center>
                                    </td>

                                    <?php $pp1=$pros->value;  $p1=number_format($pp1,2);   ?>
                                    <td>
                                        <center>{{$p1}}</center>
                                    </td>
                                </tr>
                                @endforeach

                                <tr>
                                    <td></td>
                                    <td>
                                        <center>รวม</center>
                                    </td>
                                    <td></td>

                                    <?php $dd1=$data->service_item_price;  $d1=number_format($dd1,2);   ?>
                                    <td>
                                        <center>{{$d1}}</center>
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>
                                        <center>ส่วนลดเคลม</center>
                                    </td>
                                    <td></td>
                                    <td>
                                        <center>0</center>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <center>ส่วนลดการค้า</center>
                                    </td>
                                    <td></td>
                                    <td>
                                        <center>0</center>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <center>รวม</center>
                                    </td>
                                    <td></td>
                                    <td>
                                        <center>{{$d1}}</center>
                                    </td>
                                </tr>

                            </table>
                        </div>
                        <br>


                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="col-form-label">Status :
                                    <?php if(isset($data)){ if($data->wo_status==0){echo 'งานยังไม่เสร็จ';}else{ echo 'งานสำเร็จ'; } } ?>
                                </label>

                            </div>
                            <div class="col-sm-12">
                                <label class="col-form-label">Time :
                                    <?php if(isset($data)){echo $data->wo_date.' เวลา '.$data->wo_time;} ?>
                                </label>

                            </div>
                            <div class="col-sm-12">
                                <label class="col-form-label">Note :
                                    <?php if(isset($data)){if($data->remark){ echo $data->remark; }else{ echo '-'; } } ?>
                                </label>

                            </div>
                        </div>
                        <!-- <br>

                        <div class="dt-responsive table-responsive text-center">
                            <?php    $filePath = 'file/upload/' . $data->wo_picture;   $wo_picture= Storage::disk('s3')->url($filePath); ?>
                            <center><img src="{{$wo_picture}}" width="200px"></center>
                        </div> -->





                    </div>
                </div>
            </div>
        </div>
    </div>
    @else

    <center>
        <h2>ไม่พบข้อมูลงาน?!</h2>
    </center>
    @endif


</body>


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

</html>