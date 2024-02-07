@extends('layouts.menubar')
@section('content')
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header card">
                    <div class="card-block">
                        <h5 class="m-b-10">WORK/ADD</h5>

                    </div>
                </div>
                <!-- Page-header end -->

                <!-- Page body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Basic Form Inputs card start -->
                            <div class="card">
                                <div class="card-header">

                                </div>
                                <div class="card-block">

                                    <form method="post" id="" action="{{ url('/backend/wo_store') }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <!-- -------EDIT---------- -->
                                        @if(isset($item))
                                        <input type="hidden" name="edit" value="{{$item->id}}">
                                        @else
                                        <input type="hidden" name="edit" value="">
                                        @endif
                                        <!-- -------EDIT---------- -->





                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">วันที่เปิดใบงานระบุจากระบบ</label>
                                                <input type="date" name="wo_date" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->wo_date;} ?>">
                                            </div>

                                            <div class="col-sm-3">
                                                <label class="col-form-label">เวลาเปิดใบงานระบุจากระบบ</label>
                                                <input type="time" name="wo_time" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->wo_time;} ?>">
                                            </div>
                                        </div>





                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">หมายเลขใบสั่ง</label>
                                                <input type="text" name="wo_number" class="form-control" id="pic" required
                                                    value="<?php if(isset($item)){echo $item->wo_number;} ?>">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">ประเภท</label>

                                                    <select id="" class="col-form-label" name="wo_type">
                                            <option value="ติดตั่ง" @if(isset($item))
                                                @if($item->wo_type=='ติดตั่ง') selected @endif @endif >ติดตั่ง
                                            </option>
                                            <option value="ล้าง" @if(isset($item))
                                                @if($item->wo_type=='ล้าง') selected @endif @endif >ล้าง
                                            </option>
                                            <option value="ซ่อม" @if(isset($item))
                                                @if($item->wo_type=='ซ่อม') selected @endif @endif >ซ่อม
                                            </option>
                                        </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">ลักษณะผิดปกติ</label>
                                                <input type="text" name="wo_breakdown" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->wo_breakdown;} ?>">
                                            </div>
                                        </div>

                                        <?php  
                                          $air_models = DB::table('air_models')->where('id',@$item->air_model)->first();
                                         ?>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">ชื่อรุ่น ใน/นอก</label>
                                                <input type="text" name="model_name" class="form-control" id="pic"
                                                    value="<?php if($air_models!=null){echo $air_models->des;} ?>">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">รหัสไฟกระพริบ</label>
                                                <input type="text" name="error_code" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->error_code;} ?>">
                                            </div>
                                        </div>





                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">ค่าบริการ</label>
                                                <input type="number" name="wo_price" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->wo_price;} ?>">
                                            </div>
                                        </div>


                                        <br>
                                        <?php  
                                          $customer = DB::table('customers')->where('id',@$item->customer_id)->first();
                                         ?>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">ชื่อ</label>
                                                <input type="text" name="first_name" class="form-control" id="pic"
                                                    value="<?php if($customer!=null){echo $customer->first_name;} ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">นามสกุล</label>
                                                <input type="text" name="last_name" class="form-control" id="pic"
                                                    value="<?php if($customer!=null){echo $customer->last_name;} ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">เบอร์</label>
                                                <input type="text" name="phone" class="form-control" id="pic"
                                                    value="<?php if($customer!=null){echo $customer->phone;} ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">ที่อยู่</label>
                                                <input type="text" name="address" class="form-control" id="pic"
                                                    value="<?php if($customer!=null){echo $customer->address;} ?>">
                                            </div>
                                        </div>

                                        <?php    $tech = App\User::where('type', 5)->orderby('name', 'asc')->get();   ?>
                                        <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="">มอบหมายงานให้ช่างบริการ</label>
                                            <select name="technician_id" id="id_type" class="form-control select2-single">
                                            <option value="">เลือก</option>
                                                @foreach($tech as $key=>$techs)
                                                <?php    $province = DB::table('tb_province')->where('name_th', $techs->province)->first();   ?>
                                                <option
                                                    <?php if(isset($item->technician_id)){ if($item->technician_id == $techs->id){echo 'selected';} } ?>
                                                    value="{{$techs->id}}">{{$techs->name}} {{$techs->lastname}} ({{$techs->province}})({{@$province->zone}})</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        </div>





                                        <?php  
                                          $provinces = App\Models\province::orderby('id', 'asc')->get();
                                          $amphures = App\Models\amphur::orderby('id', 'asc')->get();
                                          $districts = App\Models\district::orderby('id', 'asc')->get();
                                        ?>

                                        <div class="form-group row">
                                            <div class="col-md-6 col-sm-12">
                                                        <label class="col-form-label">จังหวัด</label>
                                                        <select class="form-control" name="province" id="province"
                                                            required="">
                                                            <option value="">ระบุจังหวัด</option>
                                                            @foreach ($provinces as $province)
                                                            <option value="{{$province->id}}" @if($province->id ==
                                                                @$item->province) selected @endif
                                                                >{{$province->name_th}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                        </div>

                                        <!-- <div class="form-group row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <label class="col-form-label">อำเภอ</label>
                                                        <select class="form-control" name="work_amupur" id="amphure"
                                                            required="">
                                                            <option value="">ระบุอำเภอ</option>
                                                            @foreach ($amphures as $amphure)
                                                            <option value="{{$amphure->id}}" @if($amphure->id ==
                                                                @$item->work_amupur) selected @endif>{{$amphure->name_th}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <label class="col-form-label">ตำบล</label>
                                                        <select class="form-control" name="work_district" id="district"
                                                            required="">
                                                            <option value="">ระบุตำบล</option>
                                                            @foreach ($districts as $district)
                                                            <option value="{{$district->id}}" @if($district->id ==
                                                                @$item->work_district) selected
                                                                @endif>{{$district->name_th}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div> -->

                                        <br>

                                      


                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">สถานะงาน</label>
                                            <select id="" class="col-form-label" name="wo_status">
                                            <option value="0" @if(isset($item))
                                                @if($item->wo_status==0) selected @endif @endif >งานยังไม่เสร็จ
                                            </option>
                                            <option value="1" @if(isset($item))
                                                @if($item->wo_status==1) selected @endif @endif >งานสำเร็จ
                                            </option>
                                        </select>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                        <br>
                                         <label>ภาพประกอบใบสั่งงานก่อน 1</label>
                                                    <div class="file-upload">
                                                                <input type="file" name="pic_before" class="form-control" id="pic">
                                                                @if(isset($item))
                                                                @if($item->pic_before!='')
                                                                <?php    $filePath = 'file/upload/' . $item->pic_before;  
                                            $pic_before= Storage::disk('s3')->url($filePath);
                                            ?>
                                                                    <div><img src="{{$pic_before}}" width="150px"></div>
                                                                @endif
                                                                @endif
                                                    </div>
                                                    <br>

                                                    <br>
                                         <label>ภาพประกอบใบสั่งงานหลัง 1</label>
                                                    <div class="file-upload">
                                                                <input type="file" name="pic_after" class="form-control" id="pic">
                                                                @if(isset($item))
                                                                @if($item->pic_after!='')
                                                                <?php    $filePath = 'file/upload/' . $item->pic_after;  
                                            $pic_after= Storage::disk('s3')->url($filePath);
                                            ?>
                                                                    <div><img src="{{$pic_after}}" width="150px"></div>
                                                                @endif
                                                                @endif
                                                    </div>
                                                    <br>
                                                    </div>
                                                    </div>



                                                    <div class="form-group row">
                                            <div class="col-sm-3">
                                        <br>
                                         <label>ภาพประกอบใบสั่งงานก่อน 2</label>
                                                    <div class="file-upload">
                                                                <input type="file" name="pic_before2" class="form-control" id="pic">
                                                                @if(isset($item))
                                                                @if($item->pic_before2!='')
                                                                <?php    $filePath = 'file/upload/' . $item->pic_before2;  
                                            $pic_before2= Storage::disk('s3')->url($filePath);
                                            ?>
                                                                    <div><img src="{{$pic_before2}}" width="150px"></div>
                                                                @endif
                                                                @endif
                                                    </div>
                                                    <br>

                                                    <br>
                                         <label>ภาพประกอบใบสั่งงานหลัง 2</label>
                                                    <div class="file-upload">
                                                                <input type="file" name="pic_after2" class="form-control" id="pic">
                                                                @if(isset($item))
                                                                @if($item->pic_after2!='')
                                                                <?php    $filePath = 'file/upload/' . $item->pic_after2;  
                                            $pic_after2= Storage::disk('s3')->url($filePath);
                                            ?>
                                                                    <div><img src="{{$pic_after2}}" width="150px"></div>
                                                                @endif
                                                                @endif
                                                    </div>
                                                    <br>
                                                    </div>
                                                    </div>



                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">หมายเหตุ</label>
                                                <input type="text" name="wo_remark" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->wo_remark;} ?>">
                                            </div>
                                        </div>

                                     



                                        <!-- @if(isset($item))
                                        @if($item->picture!=null)
                                        <br>
                                        <div><a <?php    $filePath = 'file/upload/' . $item->wo_picture;  
                                            $wo_picture= Storage::disk('s3')->url($filePath);
                                            ?> href="{{$wo_picture}}" target="_blank">
                                                <img src="{{$wo_picture}}" width="400px" id="imgA"></a></div>
                                        @else
                                        <br>
                                        <div><img src="#" width="400px" id="imgA"></div>
                                        @endif
                                        @else
                                        <br>
                                        <div><img src="#" width="400px" id="imgA"></div>
                                        @endif
                                        <div>
                                            <input type="file" name="wo_picture" id="picture1" class="hidden"
                                                onchange="readURL(this, '#imgA');">
                                            <div class="sm:grid grid-cols-3 gap-2">
                                                <div class="input-group mt-2 sm:mt-0">
                                                </div>
                                            </div>
                                        </div>
                                       <br><br> -->


                                        <p class="text-right">
                                            <a href="{{ url('/backend/wo') }}" style="color:white;"
                                                class="btn btn-success"> <i class="fa fa-share-square-o"></i> Back </a>
                                            <button type="submit" class="btn btn-danger " style="color:white;"
                                                onclick="return confirm('Confirm!');"> <i
                                                    class="fa fa-check-circle-o"></i> Save </button>
                                        </p>

                                    </form>
                                </div>
                            </div>
                            <!-- Input Alignment card end -->
                        </div>
                    </div>
                </div>
                <!-- Page body end -->
            </div>
        </div>
        <!-- Main-body end -->
        <div id="styleSelector">

        </div>
    </div>


    @endsection

    @section('script')


    <script>
    $('#province').change(function(){
            id = $('#province').val();
            $.get('{{url("fetch_amphure")}}/'+id,function(result){
                $('#amphure').empty().append('<option value="">ระบุอำเภอ</option>');
                $('#district').empty().append('<option value="">ระบุตำบล</option>');
                $('#postcode').val('');
                $.each(result,function(indexInArray,value){
                    $('#amphure').append('<option value="'+value.id+'">'+value.name_th+'</option>');
                });
            });
        });

        $('#amphure').change(function(){
            id = $('#amphure').val();
            $.get('{{url("fetch_district")}}/'+id,function(result){
                $('#district').empty().append('<option value="">ระบุตำบล</option>');
                $('#postcode').val('');
                $.each(result,function(indexInArray,value){
                    $('#district').append('<option value="'+value.id+'">'+value.name_th+'</option>');
                });
            });
        });

        $('#district').change(function(){
            id = $('#district').val();
            $.get('{{url("fetch_postcode")}}/'+id, function(result){
                $('#postcode').val(result);
            });
        });
            </script>

    @endsection