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


                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Air Models</label>
                                                <input type="text" name="model_name" class="form-control" id="pic"
                                                    value="">
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
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Customer First Name</label>
                                                <input type="text" name="first_name" class="form-control" id="pic"
                                                    value="">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Customer Last Name</label>
                                                <input type="text" name="last_name" class="form-control" id="pic"
                                                    value="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Customer Phone</label>
                                                <input type="text" name="phone" class="form-control" id="pic"
                                                    value="">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Customer Address</label>
                                                <input type="text" name="address" class="form-control" id="pic"
                                                    value="">
                                            </div>
                                        </div>
                                        

                                        <br>
                                        <div class="form-group row">
                                         <label>Picture Before</label>
                                                    <div class="file-upload col-sm-6">
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

                                         <label>Picture After</label>
                                                    <div class="file-upload col-sm-6">
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
                                                    </div>
                                                    <br>



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


    @endsection