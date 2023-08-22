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
                                                <label class="col-form-label">Date</label>
                                                <input type="date" name="wo_date" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->wo_date;} ?>">
                                            </div>

                                            <div class="col-sm-3">
                                                <label class="col-form-label">Time</label>
                                                <input type="time" name="wo_time" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->wo_time;} ?>">
                                            </div>
                                        </div>





                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Work Number</label>
                                                <input type="text" name="wo_number" class="form-control" id="pic" required
                                                    value="<?php if(isset($item)){echo $item->wo_number;} ?>">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Type</label>
                                                <input type="text" name="wo_type" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->wo_type;} ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">อาการเสีย</label>
                                                <input type="text" name="wo_breakdown" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->wo_breakdown;} ?>">
                                            </div>
                                        </div>

                                        <?php  
                                          $air_models = DB::table('air_models')->where('id',$item->air_model)->first();
                                         ?>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Air Models</label>
                                                <input type="text" name="model_name" class="form-control" id="pic"
                                                    value="<?php if($air_models!=null){echo $air_models->des;} ?>">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">รหัสข้อผิดพลาด</label>
                                                <input type="text" name="error_code" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->error_code;} ?>">
                                            </div>
                                        </div>





                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">ราคาค่าบริการ</label>
                                                <input type="number" name="wo_price" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->wo_price;} ?>">
                                            </div>
                                        </div>


                                        <br>
                                        <?php  
                                          $customer = DB::table('customers')->where('id',$item->customer_id)->first();
                                         ?>
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Customer First Name</label>
                                                <input type="text" name="first_name" class="form-control" id="pic"
                                                    value="<?php if($customer!=null){echo $customer->first_name;} ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Customer Last Name</label>
                                                <input type="text" name="last_name" class="form-control" id="pic"
                                                    value="<?php if($customer!=null){echo $customer->last_name;} ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Customer Phone</label>
                                                <input type="text" name="phone" class="form-control" id="pic"
                                                    value="<?php if($customer!=null){echo $customer->phone;} ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Customer Address</label>
                                                <input type="text" name="address" class="form-control" id="pic"
                                                    value="<?php if($customer!=null){echo $customer->address;} ?>">
                                            </div>
                                        </div>

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


                                        <br>
                                         <label>Picture Before</label>
                                                    <div class="file-upload">
                                                                <input type="file" name="pic_before" class="form-control" id="pic">
                                                                @if(isset($item))
                                                                @if($item->pic_before!='')
                                                                    <div><img src="{{asset('img/upload/'.$item->pic_before)}}" width="150px"></div>
                                                                @endif
                                                                @endif
                                                    </div>
                                                    <br>

                                                    <br>
                                         <label>Picture After</label>
                                                    <div class="file-upload">
                                                                <input type="file" name="pic_after" class="form-control" id="pic">
                                                                @if(isset($item))
                                                                @if($item->pic_after!='')
                                                                    <div><img src="{{asset('img/upload/'.$item->pic_after)}}" width="150px"></div>
                                                                @endif
                                                                @endif
                                                    </div>
                                                    <br>



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
                                            <h4>1. อุณหภูมิลมกลับ</h4>
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
                                            <h4>2. อุณหภูมิลมจ่าย</h4>
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
                                            <h4>3. อุณหภูมิภายนอก</h4>
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
                                            <h4>4. ความดันน้ำยา</h4>
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
                                            <h4>5. กระแสคอมเพรสเซอร์</h4>
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
                                            <h4>6. แรงดันไฟฟ้า</h4>
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

        @endsection