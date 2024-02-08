@extends('layouts.menubar')
<!-- <style>
    .atm {
    background-image: linear-gradient(to right, #4cff40 10%, #008697 51%, #08e3ff 100%);
}
</style> -->
@section('content')
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header card">
                    <div class="card-block atm">
                        <h5 class="m-b-10">WORK/EDIT</h5>

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

                                    <form method="post" id="" action="{{ url('/backend/wo_update/'.$item->id) }}"
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





                                        <br>
                                        <?php  
                                          $provinces = App\Models\province::orderby('id', 'asc')->get();
                                          $amphures = App\Models\amphur::orderby('id', 'asc')->get();
                                          $districts = App\Models\district::orderby('id', 'asc')->get();
                                        ?>


                                        <div class="form-group row">
                                            <div class="col-md-6 col-sm-12">
                                                        <label class="col-form-label">จังหวัด</label>
                                                        <select class="form-control" name="work_province" id="province"
                                                            >
                                                            <option value="">ระบุจังหวัด</option>
                                                            @foreach ($provinces as $province)
                                                            <option value="{{$province->id}}" @if($province->id ==
                                                                @$item->work_province) selected @endif
                                                                >{{$province->name_th}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                        </div>


                                        <!-- <div class="form-group row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <label class="col-form-label">อำเภอ</label>
                                                        <select class="form-control" name="work_amupur" id="amphure"
                                                            >
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
                                                            >
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

                                     


                                        @if(isset($item))
                                        @if($item->wo_picture!=null)
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
                                       <br><br>




                                        <p class="text-right">
                                            <a href="{{ url('/backend/wo') }}" style="color:white;"
                                                class="btn btn-success"> <i class="fa fa-share-square-o"></i> Back </a>
                                            <button type="submit" class="btn btn-danger " style="color:white;"
                                                onclick="return confirm('Confirm!');"> <i
                                                    class="fa fa-check-circle-o"></i> Save </button>
                                        </p>

                                    </form>
                                </div>

                                <!-- Input Alignment card end -->



                                <?php  $check = App\Wo_air_checkModel::where('id_wo', $item->id)->first(); ?>
                                 <div class="card-block">
                                    <h3>สรุปผลเช็ค Air</h3>

                                    <div class="form-group row">
                                            <h4>1. อุณหภูมิลมกลับ °C</h4>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">ครั้งที่ 1</label>
                                                <input disabled type="text" name="min1" class="form-control" id="pic"
                                                    value="<?php if(isset($check)){echo $check->min1;} ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">ครั้งที่ 2</label>
                                                <input disabled type="text" name="stan1" class="form-control" id="pic"
                                                    value="<?php if(isset($check)){echo $check->stan1;} ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">ครั้งที่ 3</label>
                                                <input disabled type="text" name="max1" class="form-control" id="pic"
                                                    value="<?php if(isset($check)){echo $check->max1;} ?>">
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <h4>2. อุณหภูมิลมจ่าย °C</h4>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">ครั้งที่ 1</label>
                                                <input disabled type="text" name="min2" class="form-control" id="pic"
                                                    value="<?php if(isset($check)){echo $check->min2;} ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">ครั้งที่ 2</label>
                                                <input disabled type="text" name="stan2" class="form-control" id="pic"
                                                    value="<?php if(isset($check)){echo $check->stan2;} ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">ครั้งที่ 3</label>
                                                <input disabled type="text" name="max2" class="form-control" id="pic"
                                                    value="<?php if(isset($check)){echo $check->max2;} ?>">
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <h4>3. อุณหภูมิภายนอก °C</h4>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">ครั้งที่ 1</label>
                                                <input disabled type="text" name="min3" class="form-control" id="pic"
                                                    value="<?php if(isset($check)){echo $check->min3;} ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">ครั้งที่ 2</label>
                                                <input disabled type="text" name="stan3" class="form-control" id="pic"
                                                    value="<?php if(isset($check)){echo $check->stan3;} ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">ครั้งที่ 3</label>
                                                <input disabled type="text" name="max3" class="form-control" id="pic"
                                                    value="<?php if(isset($check)){echo $check->max3;} ?>">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <h4>4. ความดันน้ำยา °PSI</h4>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">ครั้งที่ 1</label>
                                                <input disabled type="text" name="min4" class="form-control" id="pic"
                                                    value="<?php if(isset($check)){echo $check->min4;} ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">ครั้งที่ 2</label>
                                                <input disabled type="text" name="stan4" class="form-control" id="pic"
                                                    value="<?php if(isset($check)){echo $check->stan4;} ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">ครั้งที่ 3</label>
                                                <input disabled type="text" name="max4" class="form-control" id="pic"
                                                    value="<?php if(isset($check)){echo $check->max4;} ?>">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <h4>5. กระแสคอมเพรสเซอร์ °A</h4>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">ครั้งที่ 1</label>
                                                <input disabled type="text" name="min5" class="form-control" id="pic"
                                                    value="<?php if(isset($check)){echo $check->min5;} ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">ครั้งที่ 2</label>
                                                <input disabled type="text" name="stan5" class="form-control" id="pic"
                                                    value="<?php if(isset($check)){echo $check->stan5;} ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">ครั้งที่ 3</label>
                                                <input disabled type="text" name="max5" class="form-control" id="pic"
                                                    value="<?php if(isset($check)){echo $check->max5;} ?>">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <h4>6. แรงดันไฟฟ้า °ACV</h4>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">ครั้งที่ 1</label>
                                                <input disabled type="text" name="min6" class="form-control" id="pic"
                                                    value="<?php if(isset($check)){echo $check->min6;} ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">ครั้งที่ 2</label>
                                                <input disabled type="text" name="stan6" class="form-control" id="pic"
                                                    value="<?php if(isset($check)){echo $check->stan6;} ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">ครั้งที่ 3</label>
                                                <input disabled type="text" name="max6" class="form-control" id="pic"
                                                    value="<?php if(isset($check)){echo $check->max6;} ?>">
                                            </div>
                                        </div>


                                      
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Page body end -->
                </div>
            </div>
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