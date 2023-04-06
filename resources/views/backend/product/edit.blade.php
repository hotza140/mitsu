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
                    <strong><h5 class="m-b-10">PRODUCT/EDIT</h5></strong>

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

                                    <form method="post" id=""
                                        action="{{ url('/backend/product_update/'.$item->id) }}"
                                        enctype="multipart/form-data" >
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
                                        <br><div><a href="{{$items->picture)}}" target="_blank">
                                        <img src="{{$items->picture)}}" width="400px" id="imgA"></a></div>
                                        @else
                                        <br><div><img src="#" width="400px" id="imgA"></div>
                                        @endif 
                                        @else
                                        <br><div><img src="#" width="400px" id="imgA"></div>
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
                                            <div class="col-sm-12">
                                                <label class="col-form-label">Price</label>
                                                <input type="text" name="price" class="form-control" id="numeric" required
                                                    value="<?php if(isset($item)){echo $item->price;} ?>" placeholder="กรอกตัวเลขและทศนิยมเท่านั้น" >
                                                    <span class="messages"></span>
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
                                                <label class="col-form-label">Description TH</label>
                                                <input type="text" name="desth" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->desth;} ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">Detail TH</label>
                                                <textarea class="form-control" name="detailth" id="summernote"
                                                    style="height:300px"><?php if(isset($item)){echo $item->detailth;} ?></textarea>
                                            </div>
                                        </div>

                                        <p class="text-right">
                                            <a href="{{ url('/backend/user_edit/'.$item->id_user) }}"
                                                style="color:white;" class="btn btn-success"> <i
                                                    class="fa fa-share-square-o"></i> Back </a>
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