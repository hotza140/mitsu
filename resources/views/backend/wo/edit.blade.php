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

                                        <?php $aii=App\AirModel::orderby('id','desc')->get(); ?>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Air Models</label>
                                                <!-- <input type="text" name="air_model" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->air_model;} ?>"> -->

                                                <select id="" class="col-form-label" name="air_model">
                                            @foreach($aii as $aai)
                                            <option value="{{$aai->id}}" @if(isset($item))
                                                @if($item->air_model==$aai->id) selected @endif @endif >{{$aai->model_name}}
                                            </option>
                                            @endforeach
                                        </select>
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

                                        <!-- <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">id technician</label>
                                                <input type="text" name="technician_id" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->technician_id;} ?>">
                                            </div>

                                            <div class="col-sm-3">
                                                <label class="col-form-label">customer_id</label>
                                                <input type="text" name="customer_id" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->customer_id;} ?>">
                                            </div>
                                        </div> -->


                                        <?php $cus=App\Models\Customer::orderby('first_name','asc')->get(); ?>
                                        <div class="form-group row">
                                            <div class="col-sm-8">
                                                <label class="col-form-label">เลือก Customer</label>
                                                <select id="" class="col-form-label" name="customer_id">
                                            @foreach($cus as $cuss)
                                            <option value="{{$cuss->id}}" @if(isset($item))
                                                @if($item->customer_id==$cuss->id) selected @endif @endif >{{$cuss->first_name}} {{$cuss->last_name}}
                                            </option>
                                            @endforeach
                                        </select>
                                            </div>
                                        </div>


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
                                            <div class="col-sm-6">
                                                <label class="col-form-label">หมายเหตุ</label>
                                                <input type="text" name="wo_remark" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->wo_remark;} ?>">
                                            </div>
                                        </div>



                                        @if(isset($item))
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