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
                        <h5 class="m-b-10">Item Point/ADD</h5>

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

                                    <form method="post" id="" action="{{ url('/backend/item_point_store') }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <!-- -------EDIT---------- -->
                                        @if(isset($item))
                                        <input type="hidden" name="edit" value="{{$item->id}}">
                                        @else
                                        <input type="hidden" name="edit" value="">
                                        @endif
                                        <!-- -------EDIT---------- -->

                                        @if(isset($item))
                                        @if($item->picture!=null)
                                        <br>
                                        <div><a <?php    $filePath = 'file/upload/' . $item->picture;  
$picture= Storage::disk('s3')->url($filePath);
?>

href="{{$picture}}" target="_blank">
                                                <img src="{{$picture}}" width="400px"
                                                    id="imgA"></a></div>
                                        @else
                                        <br>
                                        <div><img src="#" width="400px" id="imgA"></div>
                                        @endif
                                        @else
                                        <br>
                                        <div><img src="#" width="400px" id="imgA"></div>
                                        @endif
                                        <div>
                                            <input type="file" name="picture" id="picture1" class="hidden"
                                                onchange="readURL(this, '#imgA');">
                                            <div class="sm:grid grid-cols-3 gap-2">
                                                <div class="input-group mt-2 sm:mt-0">
                                                </div>
                                            </div>
                                        </div>
                                        <h6 style="color: red;" >(รายละเอียดรูปภาพที่ควรลง ขนาด Width 1052px Height 560px นามสกุลไฟล์ png,jpg,jpeg)</h6>
                                        <label for="picture1" class="btn btn-warning " style="color:white;">
                                            <i class="fa fa-picture-o"></i>Upload Picture</label><br><br>



                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label class="col-form-label">Point</label>
                                                <input type="number" name="point" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->point;} ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label class="col-form-label">วันที่เริ่มต้น</label>
                                                <input type="datetime-local" name="date_start" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->date_start;} ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label class="col-form-label">วันที่สิ้นสุด</label>
                                                <input type="datetime-local" name="date_end" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->date_end;} ?>">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">Location TH</label>
                                                <input type="text" name="locationth" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->locationth;} ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">Location En</label>
                                                <input type="text" name="locationen" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->locationen;} ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">Ttile TH</label>
                                                <input type="text" name="titleth" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->titleth;} ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">Ttile EN</label>
                                                <input type="text" name="titleen" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->titleen;} ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">Description TH</label>
                                                <textarea class="form-control" name="desth" id=""
                                                    style="height:300px"><?php if(isset($item)){echo $item->desth;} ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">Description EN</label>
                                                <textarea class="form-control" name="desen" id=""
                                                    style="height:300px"><?php if(isset($item)){echo $item->desen;} ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">Detail TH</label>
                                                <textarea class="form-control" name="detailth" id="summernote"
                                                    style="height:300px"><?php if(isset($item)){echo $item->detailth;} ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">Detail EN</label>
                                                <textarea class="form-control" name="detailen" id="summernote2"
                                                    style="height:300px"><?php if(isset($item)){echo $item->detailen;} ?></textarea>
                                            </div>
                                        </div>


                                        <p class="text-right">
                                            <a href="{{ url('/backend/item_point') }}" style="color:white;"
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