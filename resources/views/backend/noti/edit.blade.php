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
                        <h5 class="m-b-10">NOTIFICATION/EDIT</h5>

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

                                    <form method="post" id="" action="{{ url('/backend/noti_update/'.$item->id) }}"
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
                                                <label class="col-form-label">Ttile TH</label>
                                                <input type="text" name="titleth" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->titleth;} ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">Detail TH</label>
                                                <textarea class="form-control" name="detailth" id=""
                                                    style="height:300px"><?php if(isset($item)){echo $item->detailth;} ?></textarea>
                                            </div>
                                        </div>



                                        <p class="text-right">
                                            <a href="{{ url('/backend/noti') }}" style="color:white;"
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