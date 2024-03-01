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
                        <strong>
                            <h5 class="m-b-10">USERS/EDIT</h5>
                        </strong>

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

                                    <a href="{{ url('/backend/user') }}" style="color:white;" class="btn btn-warning">
                                        <i class="fa fa-share-square-o"></i> Back </a>


                                </div>
                                <div class="card-block">

                                    <form method="post" id="" action="{{ url('/backend/user_update/'.$item->id) }}"
                                        enctype="multipart/form-data">
                                    <!-- <form> -->
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
                                        <?php    $filePath = 'file/upload/' . $item->picture;  
$picture= Storage::disk('s3')->url($filePath);
?>

<center><img src="{{$picture}}" width="200px">
                                        </center>
                                        <br>
                                        @else
                                        <br>
                                        <center><img src="{{asset('img/no_img.png')}}" width="200px">
                                        </center>
                                        <br>
                                        @endif

                                        <div class="form-group row">
                                        <div class="col-sm-3">
                                                <label class="col-form-label">CODE</label>
                                                <input  type="text" name="code" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->code;} ?>">
                                            </div>
                                            
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Nickname</label>
                                                <input  type="text" name="nickname" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->nickname;} ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Name</label>
                                                <input  type="text" name="name" class="form-control" id=""
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
                                                <label class="col-form-label">LINE</label>
                                                <input  type="text" name="line" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->line;} ?>" >
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">New
                                                    Password(หากไม่ต้องการเปลี่ยนให้เว้นว่างเอาไว้)</label>
                                                <input  type="text" name="password" class="form-control" id="" value="">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                        <div class="col-md-4">
                                            <label for="">Marget</label>
                                            <?php $mm=DB::table('market')->orderby('id','desc')->get(); ?>
                                            <select name="market" id="" class="form-control"   >
                                                @foreach($mm as $mms)
                                                <option <?php if(isset($item)){ if($item->id_market == $mms->id){echo 'selected';} } ?>
                                                    value="{{$mms->id}}">{{$mms->titleen}}</option>
                                                    @endforeach

                                            </select>
                                        </div>
                                        </div>

                                        <?php  
                                          $provinces = App\Models\province::orderby('id', 'asc')->get();
                                          $amphures = App\Models\amphur::orderby('id', 'asc')->get();
                                          $districts = App\Models\district::orderby('id', 'asc')->get();
                                        ?>



                                        <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label class="col-form-label">จังหวัด</label>
                                                        <select class="form-control" name="province" id="province_add"
                                                            >
                                                            <option value="{{@$item->id_p}}">{{@$item->province}}</option>
                                                            @foreach ($provinces as $province)
                                                            <option value="{{$province->id}}" @if($province->id ==
                                                                @$item->id_p) selected @endif
                                                                >{{$province->name_th}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <label class="col-form-label">อำเภอ</label>
                                                        <select class="form-control" name="amphur" id="amphure_add"
                                                            >
                                                            <option value="{{@$item->id_a}}">{{@$item->amphur}}</option>
                                                            @foreach ($amphures as $amphure)
                                                            <option value="{{$amphure->id}}" @if($amphure->id ==
                                                                @$item->id_a) selected @endif>{{$amphure->name_th}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                        </div>


                                        <div class="form-group row">
                                                    <div class="col-sm-4">
                                                        <label class="col-form-label">ตำบล</label>
                                                        <select class="form-control" name="district" id="district_add"
                                                            >
                                                            <option value="{{@$item->id_d}}">{{@$item->district}}</option>
                                                            @foreach ($districts as $district)
                                                            <option value="{{$district->id}}" @if($district->id ==
                                                                @$item->id_d) selected
                                                                @endif>{{$district->name_th}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-sm-4">
                                                    <label class="col-form-label">Zipcode</label>
                                                    <input  type="text" name="zipcode" class="form-control" id="postcode_add"
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


                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">ชื่อธนาคาร</label>
                                                <input  type="text" name="bank_name" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->bank_name;} ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">ชื่อบัญชี</label>
                                                <input  type="text" name="bank_title" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->bank_title;} ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">หมายเลขบัญชี</label>
                                                <input  type="text" name="bank_number" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->bank_number;} ?>">
                                            </div>
                                        </div>





                                      


                                        <div class="form-group row">
                                            <div class="col-md-6 col-sm-12">
                                                        <label class="col-form-label">จังหวัด</label>
                                                        <select class="form-control" name="work_province" id="province"
                                                            >
                                                            <option value="">ระบุจังหวัด</option>
                                                            @foreach ($provinces as $province)
                                                            <option value="{{$province->id}}" @if($province->id ==
                                                                @$item->work_province) selected @endif
                                                                >{{$province->name_th}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                        </div>


                                        <!-- <div class="form-group row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <label class="col-form-label">อำเภอบริเวณที่ทำงาน</label>
                                                        <select class="form-control" name="work_amupur" id="amphure"
                                                            >
                                                            <option value="">ระบุอำเภอ</option>
                                                            @foreach ($amphures as $amphure)
                                                            <option value="{{$amphure->id}}" @if($amphure->id ==
                                                                @$item->work_amupur) selected @endif>{{$amphure->name_th}}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <label class="col-form-label">ตำบลบริเวณที่ทำงาน</label>
                                                        <select class="form-control" name="work_district" id="district"
                                                            >
                                                            <option value="">ระบุตำบล</option>
                                                            @foreach ($districts as $district)
                                                            <option value="{{$district->id}}" @if($district->id ==
                                                                @$item->work_district) selected
                                                                @endif>{{$district->name_th}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div> -->


                                        <button type="submit" class="btn btn-success " style="color:white;"
                                                onclick="return confirm('Confirm!');"> <i
                                                    class="fa fa-check-circle-o"></i> Save </button>


                                    </form>
                                </div>
                            </div>
                            <!-- Input Alignment card end -->
                        </div>
                    </div>

                    <br><br><br>


                    <div class="m-b-10" style="background-color: red;">.</div>

                    <!-- --------------------- -->
                    <?php $point=DB::table('history_point')->where('id_user',$item->id)->orderby('id','desc')->limit(10)->get(); ?>
                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Zero config.table start -->
                                <div class="card">
                                    <div class="card-header">

                                        <strong>
                                            <h3 class="m-b-10">แต้ม POINT ของผู้ใช้งาน จำนวนปัจจุบัน {{$item->point}}
                                            </h3>
                                        </strong>


                                        <a style="color:white;" class="btn btn-warning" href="{{url('/backend/user')}}">
                                            <i class="fa fa-arrow-left"></i> Back</a>


                                        <br>

                                        <form method="post" id="" action="{{ url('/backend/history_point_store') }}"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <input type="hidden" name="id_user" value="{{$item->id}}">

                                            <br>
                                            <div class="form-group row">
                                                <div class="col-sm-2">
                                                    <label class="col-form-label">Point</label>
                                                    <input type="number" name="point" class="form-control" id=""
                                                        value="" required>
                                                </div>
                                            </div>
                                            <br>

                                            <div class="form-group row">
                                                <div class="col-sm-7">
                                                    <label class="col-form-label">หมายเหตุ</label>
                                                    <input type="text" name="toppic" class="form-control" id=""
                                                        value="" required>
                                                </div>
                                            </div>
                                            <br>


                                            <button type="submit" class="btn btn-success " style="color:white;"
                                                onclick="return confirm('Confirm!');"> <i
                                                    class="fa fa-check-circle-o"></i> Save </button>

                                        </form>

                                        <br>
                                        <strong>
                                            <h3 class="m-b-10">ประวัติการได้รับแต้ม Point 10 รายการล่าสุด
                                            </h3>
                                        </strong>

                                    </div>


                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>

                                                        <th>#</th>
                                                        <th>Title</th>
                                                        <th>Point</th>
                                                        <th>หมายเหตุ</th>
                                                        <th>Date</th>
                                                        <!-- <th>Created_at</th> -->
                                                        <!-- <th>Updated_at</th> -->
                                                        <!-- <th>Tool</th> -->

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($point as $key=>$items)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$items->title}}</td>
                                                        <td>{{$items->point}}</td>
                                                        <td>{{$items->toppic}}</td>
                                                        <?php if($items->date!=null){$date=date('d/m/Y',strtotime($items->date));}else{$date=null;}  ?>
                                                        <td>{{$date}}</td>
                                                        <!-- <td>{{$items->created_at}}</td> -->
                                                        <!-- <td>{{$items->updated_at}}</td> -->
                                                        <!-- <td>
                                                            <a href="{{url('/backend/history_point_destroy/'.$items->id)}}"
                                                                class="btn btn-sm btn-danger"
                                                                onclick="javascript:return confirm('You Want To Delete?')"
                                                                style="color:white;"><i
                                                                    class="fa fa-trash"></i>Delete</a>
                                                        </td> -->
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Title</th>
                                                        <th>Point</th>
                                                        <th>หมายเหตุ</th>
                                                        <th>Date</th>
                                                        <!-- <th>Created_at</th> -->
                                                        <!-- <th>Updated_at</th> -->
                                                        <!-- <th>Tool</th> -->
                                                    </tr>
                                                </tfoot>
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


                    <div class="m-b-10" style="background-color: red;">.</div>



                    <!-- --------------------- -->
                    <?php  $itt = App\Models\buy_point::where('id_user',$id)->orderby('id','asc')->with('item')->with('user')->get();
                    ?>
                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Zero config.table start -->
                                <div class="card">
                                    <div class="card-header">

                                        <strong>
                                            <h3 class="m-b-10">ประวัติการแลกเปลี่ยน</h3>
                                        </strong>

                                    </div>
                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable3" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>

                                                        <th>#</th>
                                                        <!-- <th>ชื่อลูกค้า</th> -->
                                                        <th>Picture</th>
                                                        <!-- <th>Title</th> -->
                                                        <th>Point</th>
                                                        <th>Date</th>
                                                        <th>Status</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($itt as $key=>$itts)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <!-- <td>{{($itts->name)?? '-'}}</td> -->
                                                        <td>
                                                        @if(isset($itts->item->picture))
                                                        <img <?php    $filePath = 'file/upload/' . $itts->item->picture;  
$picture= Storage::disk('s3')->url($filePath);
?>

src="{{$picture}}" style="width:100px">
@else
{{$itts->title}}

@endif
                                                        </td>
                                                        <!-- <td>{{($itts->item->titleen)?? '-'}}</td> -->
                                                        <td>{{$itts->buy_point}}</td>
                                                        <td>{{$itts->date}}</td>
                                                        @if($itts->status==0)
                                                        <td style="color: green;">กำลังรอยืนยัน</td>
                                                        @elseif($itts->status==2)
                                                        <td style="color: red;">ไม่อนุมัติ</td>
                                                        @else
                                                        <td style="color: grey;">อณุมัติ</td>
                                                        @endif
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                    <th>#</th>
                                                        <!-- <th>ชื่อลูกค้า</th> -->
                                                        <th>Picture</th>
                                                        <!-- <th>Title</th> -->
                                                        <th>Point</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </tfoot>
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
    var table = $('#simpletable2').DataTable({
        order: []
    });;
    </script>

    <script>
    var table = $('#simpletable3').DataTable({
        order: []
    });;
    </script>


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












    <script>
    $('#province_add').change(function(){
            id = $('#province_add').val();
            $.get('{{url("fetch_amphure")}}/'+id,function(result){
                $('#amphure_add').empty().append('<option value="">ระบุอำเภอ</option>');
                $('#district_add').empty().append('<option value="">ระบุตำบล</option>');
                $('#postcode_add').val('');
                $.each(result,function(indexInArray,value){
                    $('#amphure_add').append('<option value="'+value.id+'">'+value.name_th+'</option>');
                });
            });
        });

        $('#amphure_add').change(function(){
            id = $('#amphure_add').val();
            $.get('{{url("fetch_district")}}/'+id,function(result){
                $('#district_add').empty().append('<option value="">ระบุตำบล</option>');
                $('#postcode_add').val('');
                $.each(result,function(indexInArray,value){
                    $('#district_add').append('<option value="'+value.id+'">'+value.name_th+'</option>');
                });
            });
        });

        $('#district_add').change(function(){
            id = $('#district_add').val();
            $.get('{{url("fetch_postcode")}}/'+id, function(result){
                $('#postcode_add').val(result);
            });
        });
            </script>

    @endsection