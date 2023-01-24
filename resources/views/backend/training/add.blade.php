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
                        <h5 class="m-b-10">NEWS/ADD</h5>

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

                                    <form method="post" id="" action="{{ url('/backend/training/create') }}"
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
                                            <div class="col-sm-12">
                                                <label class="col-form-label">name</label>
                                                <input type="text" name="name" class="form-control" id="name" value="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">Address</label>
                                                <textarea class="form-control" name="desth" id="" style="height:150px"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6 col-sm-12">
                                                <label class="col-form-label">จังหวัด</label>
                                                <select class="form-control" name="province" id="province">
                                                    <option value="">ระบุจังหวัด</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <label class="col-form-label">อำเภอ</label>
                                                <select class="form-control" name="amphur" id="amphur">
                                                    <option value="">ระบุอำเภอ</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6 col-sm-12">
                                                <label class="col-form-label">ตำบล</label>
                                                <select class="form-control" name="district" id="district">
                                                    <option value="">ระบุตำบล</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <label class="col-form-label">เลขไปรษณีย์</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>


                                        <p class="text-right">
                                            <a href="{{ url('/backend/training') }}" style="color:white;"
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
