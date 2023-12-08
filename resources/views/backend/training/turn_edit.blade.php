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

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
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

    .btn-turn {
        margin: o 5px 0 5px;
    }
</style>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
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
                        <h5 class="m-b-10">TrainingTurn View/EDIT</h5>

                    </div>
                </div>
                <!-- Page-header end -->

                <!-- Page body start -->
                <div id="faq" role="tablist" aria-multiselectable="true">

                    <div id="ddr"></div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="detail-training" style="height: 56px;">
                            <h1 class="panel-title">
                                <a data-toggle="collapse" data-parent="#faq" href="#detailtraining"
                                    aria-expanded="false" aria-controls="detailtraining">
                                    การเปิดฝึกอบรม
                                </a>
                            </h1>
                        </div>
                        <!-- <div class="page-body panel-collapse collapse" id="detailtraining" role="tabpanel"
                            aria-labelledby="detail-training"> -->
                            <div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">

                                        </div>

                                        <div class="card-block">

                                            <form method="post" id=""
                                                action="{{ url('backend/training/create-turn#ddr') }}"
                                                enctype="multipart/form-data">
                                                @csrf

                                                <input type="hidden" name="id" id="id"
                                                    value="{{$item->training_id}}">

                                                    <input type="hidden" name="edit" 
                                                    value="{{$item->id}}">

                                                <div class="form-group row">
                                                    <div class="col-sm-2">
                                                        <label class="col-form-label">รอบที่ {{$item->turn}}</label>
                                                        <input type="number" name="turn" class="form-control" id="turn"
                                                        value="{{$item->turn}}"
                                                             required="">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label">Google Map Link</label>
                                                        <input type="number" name="google_link" class="form-control" id="turn"
                                                        value="{{$item->google_link}}"
                                                             >
                                                    </div>
                                                </div>

                                                <!-- <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        <label class="col-form-label">สถานะเปิดอบรม</label><br>
                                                        <label class="switch">
                                                            <input type="checkbox" name="status" id="status"
                                                                @if(@$item->status == 'on') checked @endif>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </div>
                                                </div> -->

                                                <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label class="col-form-label">วันที่/เวลาเริ่มต้น</label>
                                                        <input type="datetime-local" name="date_start"
                                                            class="form-control" id="date_start" required=""
                                                            value="{{$item->date_start}}"
                                                           >
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="col-form-label">วันที่/เวลาสิ้นสุด</label>
                                                        <input type="datetime-local" name="date_end"
                                                            class="form-control" id="date_end" required=""
                                                            value="{{$item->date_end}}"
                                                         >
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <label class="col-form-label">สถานที่ฝึกอบรม</label>
                                                        <textarea class="form-control" name="address" id=""
                                                            style="height:70px"
                                                            required="">{{$item->address}}</textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <label class="col-form-label">จังหวัด</label>
                                                        <select class="form-control" name="province" id="province"
                                                            required="">
                                                            <option value="">ระบุจังหวัด</option>
                                                            @foreach ($provinces as $province)
                                                            <option value="{{$province->id}}" @if($province->id ==
                                                                @$item->province_id) selected @endif
                                                                >{{$province->name_th}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label class="col-form-label">อำเภอ</label>
                                                        <select class="form-control" name="amphure" id="amphure"
                                                            required="">
                                                            <option value="">ระบุอำเภอ</option>
                                                            @foreach ($amphures as $amphure)
                                                            <option value="{{$amphure->id}}" @if($amphure->id ==
                                                                @$item->amphure_id) selected @endif>{{$amphure->name_th}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <label class="col-form-label">ตำบล</label>
                                                        <select class="form-control" name="district" id="district"
                                                            required="">
                                                            <option value="">ระบุตำบล</option>
                                                            @foreach ($districts as $district)
                                                            <option value="{{$district->id}}" @if($district->id ==
                                                                @$item->district_id) selected
                                                                @endif>{{$district->name_th}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        <label class="col-form-label">เลขไปรษณีย์</label>
                                                        <input type="text" id="postcode" name="postcode"
                                                            class="form-control" required=""
                                                            value="{{$item->postcode}}"
                                                            >
                                                    </div>
                                                </div>

                                                <p class="text-right">
                                                <a href="{{url('/backend/training/edit/'.$item->training_id)}}" style="color:white;"
                                                        class="btn btn-danger"> <i class="fa fa-share-square-o"></i>
                                                        Back </a>
                                                    <button type="submit" class="btn btn-success " style="color:white;"
                                                        onclick="return confirm('Confirm!');"> <i
                                                            class="fa fa-check-circle-o"></i> Save </button>
                                                </p>

                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div id="haft"></div>

                     <!-- --------------------- -->
                     <?php
                     $point = App\Models\TrainingList::where('turn_id', $item->id)->get();
                     ?>
                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Zero config.table start -->
                                <div class="card">
                                    <div class="card-header">
                                    <h5>รายชื่อผู้ฝึกอบรม</h5>
                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <table id="" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>

                                                        <th>#</th>
                                                       <th>ชื่อ - นามสกุล</th>
                                            <th>ชื่อเล่น</th>
                                            <th>เบอร์โทรศัพท์</th>
                                            <th>สังกัดร้าน</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($point as $key=>$items)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$items->full_name}}</td>
                                                        <td>{{$items->nickname}}</td>
                                                        <td>{{$items->phone}}</td>
                                                        <td>{{$items->agency}}</td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                </div>
                                <!-- Zero config.table end -->
                                <!-- Default ordering table start -->


                                <!-- Default ordering table end -->
                                <!-- Multi-column table start -->

                                <!-- Language - Comma Decimal Place table end -->
                            </div>
                        </div>
                    </div>
                    <!-- -------------------- -->




                 


                    
                </div>




                <div id="styleSelector">

                </div>
            </div>

            <!-- {{-- ======= modal ======= --}}
            <div class="modal" id="training-list" tabindex="-1" role="dialog" aria-labelledby="modalLabelLarge"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="modalLabelLarge">รายชื่อผู้เข้าร่วมอบรม</h4>
                        </div>

                        <div class="modal-body">
                            <div class="dt-responsive table-responsive">
                                <table class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>ชื่อ - นามสกุล</th>
                                            <th>ชื่อเล่น</th>
                                            <th>เบอร์โทรศัพท์</th>
                                            <th>สังกัดร้าน</th>
                                        </tr>
                                    </thead>
                                    <tbody id="sort-data">
                                        {{-- --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div> -->

            @endsection

            @section('script')

            <script>
                $('#add-traingturn').click(function(){
            id = $('#training-id').val();
            $.ajax({
                type: 'post',
                url: '{{url("backend/training/create-turn")}}',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'id' : id,
                },
                dataType: 'json',
                success:function(response){
                    Swal.fire({
                        title: "สำเร็จ",
                        text: "ระบบได้ทำการเพิ่มรอบอบรม",
                        icon: "success",
                        allowOutsideClick: false,
                    });
                    console.log(response);
                    $('#training-turn-num').empty();
                    $.each(response,function(indexArray,value){
                        $('#training-turn-num').append('<button type="button" class="btn btn-default btn-turn" rel="'+value.id+'">รอบที่ '+value.turn+'</button>');
                    });
                },
            });
        });

        $('.btn-turn').click(function(){
            turn_id = $(this).attr("rel");
            id = $('#training-id').val();
            console.log(id,turn_id)
            $.ajax({
                type: 'get',
                url: `{{url('backend/training/get_list/${id}/${turn_id}')}}`,
                cache: false,
                processdata: false,
                contenttype: false,
                success:function(response){
                    console.log(response);
                    $('#sort-data').empty();
                    if(response != null){
                        $.each(response,function(indexArray,data){
                            $('#sort-data').append(
                                '<tr>'+
                                    '<td>'+data.full_name+'</td>'+
                                    '<td>'+data.nickname+'</td>'+
                                    '<td>'+data.phone+'</td>'+
                                    '<td>'+data.agency+'</td>'+
                                '</tr>'
                            );
                        });
                    }else{
                        $('#sort-data').append('<tr><td>NuLL</td></tr>');
                    }
                    $('#training-list').css('display','block');
                },
            });
        });

        $('.close').click(function(){
            $('#training-list').hide();
        });

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