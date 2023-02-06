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
                        <h5 class="m-b-10">Training/EDIT</h5>

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

                                    <form method="post" id="" action="{{ url('/backend/training/update/'.$detail->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf



                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">หัวข้อฝึกอบรม</label>
                                                <input type="text" name="name" class="form-control" id="name" value="{{$detail->name}}" required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">สถานะเปิดอบรม</label><br>
                                                <label class="switch">
                                                    <input type="checkbox" name="status" id="status" @if($detail->status == 'on') checked @endif>
                                                     <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <label class="col-form-label">วันที่และเวลา</label>
                                                <input type="datetime-local" name="datetime" class="form-control" id="datetime" required="" value="{{$detail->date_time}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">รายละเอียดการฝึกอบรม</label>
                                                <textarea class="form-control" name="detail" id="" style="height:150px" required="">{{$detail->detail}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">ที่อยู่</label>
                                                <textarea class="form-control" name="desth" id="" style="height:70px" required="">{{$detail->address}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6 col-sm-12">
                                                <label class="col-form-label">จังหวัด</label>
                                                <select class="form-control" name="province" id="province" required="">
                                                    <option value="">ระบุจังหวัด</option>
                                                    @foreach ($provinces as $province)
                                                    <option value="{{$province->id}}" @if($province->id == $detail->province) selected @endif >{{$province->name_th}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <label class="col-form-label">อำเภอ</label>
                                                <select class="form-control" name="amphure" id="amphure" required="">
                                                    <option value="">ระบุอำเภอ</option>
                                                    @foreach ($amphures as $amphure)
                                                    <option value="{{$amphure->id}}" @if($amphure->id == $detail->amphure) selected @endif>{{$amphure->name_th}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-6 col-sm-12">
                                                <label class="col-form-label">ตำบล</label>
                                                <select class="form-control" name="district" id="district" required="">
                                                    <option value="">ระบุตำบล</option>
                                                    @foreach ($districts as $district)
                                                    <option value="{{$district->id}}" @if($district->id == $detail->district) selected @endif>{{$district->name_th}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <label class="col-form-label">เลขไปรษณีย์</label>
                                                <input type="text" id="postcode" name="postcode" class="form-control" required="" value="{{$zipcode->zip_code}}">
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
