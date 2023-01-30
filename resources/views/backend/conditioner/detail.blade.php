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
                    <strong><h5 class="m-b-10">Customer/View</h5></strong>

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
                                        action=""
                                        enctype="multipart/form-data" >
                                        @csrf

                                        <div class="form-group row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="col-md-6 col-sm-12">
                                                    <label class="col-form-label">ชื่อลูกค้า</label>
                                                    <input type="text" class="form-control" value="{{$detail->customer->full_name}}" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="col-md-6 col-sm-12">
                                                    <label class="col-form-label">line</label>
                                                    <input type="text" class="form-control" value="{{$detail->customer->line}}" readonly>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label class="col-form-label">เบอร์โทร</label>
                                                    <input type="text" class="form-control" value="{{$detail->customer->phone}}" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="col-md-6 col-sm-12">
                                                    <label class="col-form-label">ที่อยู่</label>
                                                    <textarea class="form-control" readonly>{!! $detail->customer->address !!}</textarea>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label class="col-form-label">รายละเอียดที่อยู่(เพิ่มเติม)</label>
                                                    <textarea class="form-control" readonly>{!! $detail->customer->more_address !!}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-12 col-sm-12">
                                                <div class="col-md-6 col-sm-12">
                                                    <label class="col-form-label">หมายเลขเครื่องปรับอากาศ(indoor)</label>
                                                    <input type="text" class="form-control" value="{{$detail->indoor}}" readonly>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label class="col-form-label">หมายเลขเครื่องปรับอากาศ(outdoor)</label>
                                                    <input type="text" class="form-control" value="{{$detail->outdoor}}" readonly>
                                                </div>
                                            </div>
                                        </div>

                                        <p class="text-right">

                                        @if(isset($item))
                                            <a href="{{ url('/backend/user_edit/'.$item) }}"
                                                style="color:white;" class="btn btn-success"> <i
                                                    class="fa fa-share-square-o"></i> Back </a>
                                                    @else
                                                    <a href="{{ url('/backend/air_conditioner') }}"
                                                style="color:white;" class="btn btn-success"> <i
                                                    class="fa fa-share-square-o"></i> Back </a>
                                                    @endif
                                            {{-- <button type="submit" class="btn btn-danger " style="color:white;"
                                                onclick="return confirm('Confirm!');"> <i
                                                    class="fa fa-check-circle-o"></i> Save </button> --}}
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
