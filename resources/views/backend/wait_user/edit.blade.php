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
                    <strong><h5 class="m-b-10">USERS รอการยืนยัน/EDIT</h5></strong>

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
                                        action="{{ url('/backend/wait_user_update/'.$item->id) }}"
                                        enctype="multipart/form-data" >
                                        @csrf


                                        <!-- -------EDIT---------- -->
                                        @if(isset($item))
                                        <input type="hidden" name="edit" value="{{$item->id}}">
                                        @else
                                        <input type="hidden" name="edit" value="">
                                        @endif
                                        <!-- -------EDIT---------- -->


                                        @if($item->picture!=null)
                                        <br>
                                        <center><img src="{{$item->picture)}}" width="200px"></center>
                                        <br>
                                        @endif

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">Name</label>
                                                <input disabled type="text" name="name" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->name;} ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">Lastname</label>
                                                <input disabled type="text" name="lastname" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->lastname;} ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">Phone</label>
                                                <input disabled type="text" name="phone" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->phone;} ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">Email</label>
                                                <input disabled type="email" name="email" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->email;} ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">Marget</label>
                                                <input disabled type="text" name="marget" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->marget;} ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">Province</label>
                                                <input disabled type="text" name="province" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->province;} ?>">
                                            </div>
                                        </div>


                                       


                                        <p class="text-right">
                                            <a href="{{ url('/backend/wait_user') }}"
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