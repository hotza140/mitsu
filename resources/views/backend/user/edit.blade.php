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
                    <strong><h5 class="m-b-10">USERS/EDIT</h5></strong>

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

                                            <a href="{{ url('/backend/user') }}" style="color:white;"
                                                class="btn btn-warning"> <i class="fa fa-share-square-o"></i> Back </a>
                                            

                                </div>
                                <div class="card-block">

                                    <!-- <form method="post" id="" action="{{ url('/backend/user_update/'.$item->id) }}"
                                        enctype="multipart/form-data"> -->
                                        <form>
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
                                        <center><img src="{{asset('img/upload/'.$item->picture)}}" width="200px">
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
                                                <label class="col-form-label">Nickname</label>
                                                <input disabled type="text" name="nickname" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->nickname;} ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Name</label>
                                                <input disabled type="text" name="name" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->name;} ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Lastname</label>
                                                <input disabled  type="text" name="lastname" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->lastname;} ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Phone</label>
                                                <input disabled  type="text" name="phone" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->phone;} ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Email</label>
                                                <input disabled type="email" name="email" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->email;} ?>" required>
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">LINE</label>
                                                <input disabled type="text" name="line" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->line;} ?>" required>
                                            </div>
                                        </div>

                                        <!-- <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">New
                                                    Password(หากไม่ต้องการเปลี่ยนให้เว้นว่างเอาไว้)</label>
                                                <input disabled type="text" name="password" class="form-control" id="" value="">
                                            </div>
                                        </div> -->


                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Marget</label>
                                                <input disabled  type="text" name="marget" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->marget;} ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Province</label>
                                                <input disabled  type="text" name="province" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->province;} ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">District</label>
                                                <input disabled  type="text" name="district" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->district;} ?>">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Amphur</label>
                                                <input disabled  type="text" name="amphur" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->amphur;} ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">Zipcode</label>
                                                <input disabled  type="text" name="zipcode" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->zipcode;} ?>">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">บ้านเลขที่</label>
                                                <input disabled  type="text" name="house" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->house;} ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">หมู่ที่</label>
                                                <input disabled  type="text" name="moo" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->moo;} ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <label class="col-form-label">หมู่บ้าน/คอนโด</label>
                                                <input disabled  type="text" name="condo" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->condo;} ?>">
                                            </div>
                                            <div class="col-sm-3">
                                                <label class="col-form-label">ถนน</label>
                                                <input disabled  type="text" name="road" class="form-control" id=""
                                                    value="<?php if(isset($item)){echo $item->road;} ?>">
                                            </div>
                                        </div>


                                        <!-- <button type="submit" class="btn btn-success " style="color:white;"
                                                onclick="return confirm('Confirm!');"> <i
                                                    class="fa fa-check-circle-o"></i> Save </button> -->
                                       

                                    </form>
                                </div>
                            </div>
                            <!-- Input Alignment card end -->
                        </div>
                    </div>

                    <br><br><br>


                    <div class="m-b-10" style="background-color: red;">.</div>

                       <!-- --------------------- -->
                       <?php $point=DB::table('history_point')->where('id_user',$item->id)->orderby('id','desc')->get(); ?>
                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Zero config.table start -->
                                <div class="card">
                                    <div class="card-header">

                                        <strong><h3 class="m-b-10">แต้ม POINT ของผู้ใช้งาน จำนวนปัจจุบัน {{$item->point}}</h3></strong>


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
                                                <input type="number" name="point" class="form-control" id="" value="" required>
                                            </div>
                                            </div>
                                            <br>


                                        <button type="submit" class="btn btn-success " style="color:white;"
                                                onclick="return confirm('Confirm!');"> <i
                                                    class="fa fa-check-circle-o"></i> Save </button>

                                        </form>

                                    </div>


                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>

                                                        <th>#</th>
                                                        <th>Title</th>
                                                        <th>Point</th>
                                                        <th>Date</th>
                                                        <!-- <th>Created_at</th> -->
                                                        <!-- <th>Updated_at</th> -->
                                                        <th>Tool</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($point as $key=>$items)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$items->title}}</td>
                                                        <td>{{$items->point}}</td>
                                                        <?php if($items->date!=null){$date=date('d/m/Y',strtotime($items->date));}else{$date=null;}  ?>
                                                        <td>{{$date}}</td>
                                                        <!-- <td>{{$items->created_at}}</td> -->
                                                        <!-- <td>{{$items->updated_at}}</td> -->
                                                        <td>
                                                            <a href="{{url('/backend/history_point_destroy/'.$items->id)}}"
                                                                class="btn btn-sm btn-danger"
                                                                onclick="javascript:return confirm('You Want To Delete?')"
                                                                style="color:white;"><i
                                                                    class="fa fa-trash"></i>Delete</a>
                                                        </td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                    <th>#</th>
                                                        <th>Title</th>
                                                        <th>Point</th>
                                                        <th>Date</th>
                                                        <!-- <th>Created_at</th> -->
                                                        <!-- <th>Updated_at</th> -->
                                                        <th>Tool</th>
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
                    <?php  $data = App\Models\AirConditioner::orderby('id','asc')->with('customer')->get();
                    ?>
                    <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Zero config.table start -->
                            <div class="card">
                                <div class="card-header">

                                <strong><h3 class="m-b-10">รายการเครื่องปรับอากาศ</h3></strong>

                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="simpletable2" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>

                                                    <th>#</th>
                                                    <th>ชื่อลูกค้า</th>
                                                    <th>outdoor number</th>
                                                    <th>indoor number</th>
                                                    <th>Updated_at</th>
                                                    <th>Tool</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data as $key=>$items)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$items->customer->full_name}}</td>
                                                    <td>{{($items->outdoor_number) ?? '-'}}</td>
                                                    <td>{{($items->indoor_number)?? '-'}}</td>
                                                    <td>{{$items->updated_at}}</td>
                                                    <td>
                                                    <a href="{{url('/backend/air_conditioner/'.$items->id.'/'.$id)}}" class="btn btn-sm btn-primary" style="color:white;"><i class="fa fa-gear"></i>Edit</a>
                                                        <a href="{{url('/backend/air_conditioner/destroy/'.$items->id)}}" class="btn btn-sm btn-danger" onclick="javascript:return confirm('You Want To Delete?')"  style="color:white;"><i class="fa fa-trash"></i>Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                <th>#</th>
                                                <th>ชื่อลูกค้า</th>
                                                <th>outdoor number</th>
                                                <th>indoor number</th>
                                                <th>Updated_at</th>
                                                <th>Tool</th>
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
                order:[]
            });;
</script>


    @endsection