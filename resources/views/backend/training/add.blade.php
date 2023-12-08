<style>
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked + .slider {
      background-color: #2196F3;
    }

    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
</style>
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
                        <h5 class="m-b-10">Training/ADD</h5>

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

                                        <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">ชื่อหลักสูตร</label>
                                                        <input type="text" name="name" class="form-control" id="name"
                                                             required="">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label class="col-form-label">เนื้อหาหลักสูตร</label>
                                                        <textarea class="form-control" name="detail" id=""
                                                            style="height:150px"
                                                            required=""></textarea>
                                                    </div>
                                                </div>

                                                <?php $ddd=date('Y-m-d H:i:s'); ?>
                                                <input type="hidden" name="status" id="status" value="on" >
                                                <input type="hidden" name="datetime" id="datetime" value="{{$ddd}}" >
                                                <input type="hidden" name="address" id="address" value="0" >
                                                <input type="hidden" name="district" id="district" value="0" >
                                                <input type="hidden" name="amphure" id="amphure" value="0" >
                                                <input type="hidden" name="province" id="province" value="0" >

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
    <script>
        $('#province').change(function(){
            id = $('#province').val();
            $.get('{{url("fetch_amphure")}}/'+id,function(result){
                $('#amphure').empty().append('<option value="">ระบุอำเภอ</option>');
                $('#district').empty().append('<option value="">ระบุตำบล</option>');
                $('#postcode').val('');
                $.each(result,function(indexInArray,value){
                    $('#amphure').append('<option value="'+value.id+'">'+value.name_th+'</option>');
                });
            });
        });

        $('#amphure').change(function(){
            id = $('#amphure').val();
            $.get('{{url("fetch_district")}}/'+id,function(result){
                $('#district').empty().append('<option value="">ระบุตำบล</option>');
                $('#postcode').val('');
                $.each(result,function(indexInArray,value){
                    $('#district').append('<option value="'+value.id+'">'+value.name_th+'</option>');
                });
            });
        });

        $('#district').change(function(){
            id = $('#district').val();
            $.get('{{url("fetch_postcode")}}/'+id, function(result){
                $('#postcode').val(result);
            });
        });
    </script>

    @endsection
