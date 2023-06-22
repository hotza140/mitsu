!DOCTYPE html>
<html lang="TH">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>PDF WORK</title>


    <!-- Styles -->

    <style>
        @page {
            size: 58mm;
            margin: 0;
        }

        /* @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ asset('fonts/THSarabunNew.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ asset('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ asset('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ asset('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }
        html, body {
            font-family: "THSarabunNew";
        } */

        html,
        body {
            font-family: "Garuda";
        }
    </style>

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
                                <label class="col-form-label">ชื่อ :
                                    <?php if(isset($cus)){echo $cus->first_name.' '.$cus->last_name;} ?>
                                </label>

                            </div>
                            <div class="col-sm-12">
                                <label class="col-form-label">เบอร์ติดต่อ :
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



                        <div align="center">
                            <p>รายการค่าแรงและค่าอะไหล่</p>
                        </div>
                        <?php $pro=App\WO_item::where('id_wo',$data->id)->get(); ?>
                        <div class="form-group row">
                            <table>
                                <tr>
                                    <td><b>
                                            <center>รายการที่</center>
                                        </b></td>
                                    <td><b>
                                            <center>รายละเอียด</center>
                                        </b></td>
                                    <td><b>
                                            <center>จำนวน</center>
                                        </b></td>
                                    <td><b>
                                            <center>บาท</center>
                                        </b></td>
                                </tr>

                                @foreach($pro as $key=> $pros)
                                <tr>
                                    <td>{{$key+1}}</td>
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
                                        <center>รวมทั้งหมด</center>
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
                                <label class="col-form-label">สถานะงาน :
                                    <?php if(isset($data)){ if($data->wo_status==0){echo 'งานยังไม่เสร็จ';}else{ echo 'งานสำเร็จ'; } } ?>
                                </label>

                            </div>
                            <div class="col-sm-12">
                                <label class="col-form-label">เวลาส่งมอบ :
                                    <?php if(isset($data)){echo $data->wo_date.' เวลา '.$data->wo_time;} ?>
                                </label>

                            </div>
                            <div class="col-sm-12">
                                <label class="col-form-label">หมายเหตุ :
                                    <?php if(isset($data)){if($data->remark){ echo $data->remark; }else{ echo '-'; } } ?>
                                </label>

                            </div>
                        </div>
                        <br>

                        <div class="dt-responsive table-responsive text-center">
                            <?php    $filePath = 'file/upload/' . $data->wo_picture;   $wo_picture= Storage::disk('s3')->url($filePath); ?>
                            <center><img src="{{$wo_picture}}" width="200px"></center>
                        </div>





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

</html>