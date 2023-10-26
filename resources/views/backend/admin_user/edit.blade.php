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
                    <strong><h5 class="m-b-10">ADMIN/EDIT</h5></strong>

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
                                        action="{{ url('/backend/admin_user_update/'.$item->id) }}"
                                        enctype="multipart/form-data" >
                                        @csrf


                                        <!-- -------EDIT---------- -->
                                        @if(isset($item))
                                        <input type="hidden" name="edit" value="{{$item->id}}">
                                        @else
                                        <input type="hidden" name="edit" value="">
                                        @endif
                                        <!-- -------EDIT---------- -->

                                        <div class="form-group col-md-4">
                                            <label for="">Postion</label>
                                            <select name="type" id="" class="form-control"  >
                                                <option <?php if(isset($item)){ if($item->type == '0'){echo 'selected';} } ?>
                                                    value="0">Super( type 0 )</option>
                                                    <option <?php if(isset($item)){ if($item->type == '1'){echo 'selected';} } ?>
                                                    value="1">Admin( type 1 )</option>

                                            </select>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">name</label>
                                                <input type="text" name="name" class="form-control" id=""
                                                      value="<?php if(isset($item)){echo $item->name;} ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">Email</label>
                                                <input type="email" name="email" class="form-control" id="" required 
                                                      value="<?php if(isset($item)){echo $item->email;} ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">New Password</label>
                                                <input type="text" name="password" class="form-control" id=""  maxlength = "10"
                                                 placeholder="ถ้าไม่ต้องการเปลี่ยนรหัสให้ปล่อยช่องว่างเอาไว้"
                                                     >
                                            </div>
                                        </div>

                                        <p class="text-right">
                                            <a href="{{ url('/backend/admin_user') }}"
                                                style="color:white;" class="btn btn-success"> <i
                                                    class="fa fa-share-square-o"></i> Back </a>
                                            <button type="submit" class="btn btn-danger " style="color:white;"
                                                onclick="return confirm('Confirm!');"> <i
                                                    class="fa fa-check-circle-o"></i> ยืนยันการสมัครสมาชิก </button>
                                        </p>

                                    </form>
                                </div>
                            </div>
                            <!-- Input disabled Alignment card end -->
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