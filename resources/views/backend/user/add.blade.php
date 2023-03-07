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
                    <strong><h5 class="m-b-10">USERS/ADD</h5></strong>

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

                                    <form method="post" id="" action="{{ url('/backend/user_store') }}"
                                        enctype="multipart/form-data" >
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
                                                <label class="col-form-label">Nickname</label>
                                                <input  type="text" name="nickname" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->nickname;} ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Name</label>
                                                <input  type="text" name="name" class="form-control" id="" required
                                                    value="<?php if(isset($item)){echo $item->name;} ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Lastname</label>
                                                <input  type="text" name="lastname" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->lastname;} ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Phone</label>
                                                <input  type="text" name="phone" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->phone;} ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Email</label>
                                                <input  type="email" name="email" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->email;} ?>" required>
                                            </div>

                                            <div class="col-sm-3">
                                                <label class="col-form-label">Password</label>
                                                <input  type="text" name="password" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->email;} ?>" required>
                                            </div>


                                            <div class="col-sm-3">
                                                <label class="col-form-label">LINE</label>
                                                <input  type="text" name="line" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->line;} ?>" >
                                            </div>

                                            <div class="col-sm-3">
                                                <label class="col-form-label">Marget</label>
                                                <input  type="text" name="marget" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->marget;} ?>">
                                            </div>
                                        </div>

                                        <!-- <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">New
                                                    Password(หากไม่ต้องการเปลี่ยนให้เว้นว่างเอาไว้)</label>
                                                <input  type="text" name="password" class="form-control" id="" value="">
                                            </div>
                                        </div> -->

                                        <br><br>

                                        
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Province</label>
                                                <input  type="text" name="province" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->province;} ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">District</label>
                                                <input  type="text" name="district" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->district;} ?>">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Amphur</label>
                                                <input  type="text" name="amphur" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->amphur;} ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Zipcode</label>
                                                <input  type="text" name="zipcode" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->zipcode;} ?>">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">บ้านเลขที่</label>
                                                <input  type="text" name="house" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->house;} ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">หมู่ที่</label>
                                                <input  type="text" name="moo" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->moo;} ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">หมู่บ้าน/คอนโด</label>
                                                <input  type="text" name="condo" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->condo;} ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">ถนน</label>
                                                <input  type="text" name="road" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->road;} ?>">
                                            </div>
                                        </div>




                                        <p class="text-right">
                                            <a href="{{ url('/backend/user') }}"
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