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
                        <h5 class="m-b-10">WORK ITEM/ADD</h5>

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

                                    <form method="post" id="" action="{{ url('/backend/wo_item_store') }}"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <!-- -------EDIT---------- -->
                                        @if(isset($item))
                                        <input type="hidden" name="edit" value="{{$item->id}}">
                                        @else
                                        <input type="hidden" name="edit" value="">
                                        @endif
                                        <!-- -------EDIT---------- -->


                                        <input type="hidden" name="id" value="{{$id}}">

                                        <div class="form-group row">

                                            <div class="col-sm-3">
                                                <label class="col-form-label">Title</label>
                                                <input type="text" name="title" class="form-control" id="pic" required
                                                    value="<?php if(isset($item)){echo $item->title;} ?>">
                                            </div>

                                            <div class="col-sm-3">
                                                <label class="col-form-label">จำนวน</label>
                                                <input type="number" name="number" class="form-control" id="pic" required
                                                    value="<?php if(isset($item)){echo $item->number;} ?>">
                                            </div>


                                            <div class="col-sm-3">
                                                <label class="col-form-label">ราคาต่อหน่วย</label>
                                                <input type="number" name="value" class="form-control" id="pic" required
                                                    value="<?php if(isset($item)){echo $item->value;} ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Status</label>
                                            <select id="" class="col-form-label" name="status">
                                            <option value="0" @if(isset($item))
                                                @if($item->status==0) selected @endif @endif >ใช้งาน
                                            </option>
                                            <option value="1" @if(isset($item))
                                                @if($item->status==1) selected @endif @endif >ไม่ใช้งาน
                                            </option>
                                        </select>
                                            </div>
                                        </div>


                                        <p class="text-right">
                                            <a href="{{ url('/backend/wo_item/'.$id) }}" style="color:white;"
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