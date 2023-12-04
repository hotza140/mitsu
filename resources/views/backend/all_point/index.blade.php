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
                            <h5 class="m-b-10">ประวัติการแลกเปลี่ยน</h5>
                        </strong>
                       

                    </div>
                </div>
                <!-- Page-header end -->

                <!-- Page body start -->
                <div class="page-body">

                <?php $date=date('Y-m-d');   ?>

                    <!-- --------------------- -->
                    <?php 
                    if(@$date_s!=null and @$date_e!=null){
                        $data = App\Models\buy_point::
                        whereDate('created_at', '>=', @$date_s)
        		        ->whereDate('created_at', '<=', @$date_e)
                        ->with('item')->with('user')->orderby('id','desc')->get();
                    }else{
                        $data = App\Models\buy_point::whereDate('created_at',$date)->with('item')->with('user')->orderby('id','desc')->get();
                        // dd('eeee');
                    }
                    
                    ?>
                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Zero config.table start -->
                                <div class="card">
                                    <div class="card-header">


                                     

                                 
                               
                               <div><br>
                                   <form class="form-horizontal" action="{{url('/backend/all_point')}}" method="GET" enctype="multipart/form-data">
                                          @csrf
                                       <input type="date" name="date_s" value="<?php if(isset($date_s)){echo $date_s;}else{echo $date;} ?>"  class="col-md-2">Start<br><br>
                                       <input type="date" name="date_e" value="<?php if(isset($date_e)){echo $date_e;}else{echo $date;} ?>"  class="col-md-2">End<br><br>

                                       <button type="submit" class="btn btn-danger" style="color:white;"
                                               onclick="return confirm('Confirm!');"> <i
                                                   class="fa fa-check-circle-o"></i> Enter </button>

                                                   <a href="{{ url('/backend/all_point') }}"
                                               style="color:white;" class="btn btn-warning"> <i
                                                   class="fa fa-share-square-o"></i> Reset </a>
                                       </form>
                                       </div>






                                       <div><br>
                               <h5>Export ประวัติการแลกเปลี่ยน</h5>
                                   <form class="form-horizontal" action="{{url('backend/all_point_export')}}" method="POST" enctype="multipart/form-data">
                                          @csrf

                                       <input type="hidden" name="date_s" value="<?php if(isset($date_s)){echo $date_s;}else{echo $date;} ?>"  class="col-md-2">
                                       <input type="hidden" name="date_e" value="<?php if(isset($date_e)){echo $date_e;}else{echo $date;} ?>"  class="col-md-2">
                                       
                                       <button type="submit" class="btn btn-danger" style="color:white;"
                                               onclick="return confirm('Confirm!');"> <i
                                                   class="fa fa-check-circle-o"></i> Enter </button>
                                       </form>
                                       </div>
                                       <br>

                                    </div>
                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable3" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>

                                                    <th>#</th>
                                                    <th>เลขที่คำขอ</th>
                                                    <th>วันที่แลกแต้ม</th>
                                                        <th>ชื่อช่าง</th>
                                                        <th>ชื่อสินค้า</th>
                                                        <!-- <th>Title</th> -->
                                                        <th>คะแนนที่ใช้</th>
                                                        <th>คะแนนก่อนใช้</th>
                                                        <th>คะแนนหลังใช้</th>
                                                        <th>Status</th>
                                                        <!-- <th>Tool</th> -->

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($data as $key=>$itts)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$itts->number}}</td>
                                                        <td>{{$itts->date}}</td>
                                                        <?php $p1=App\User::where('id',$itts->id_user)->first();  ?>
                                                        <td>{{($p1->name)?? '-'}} {{($p1->lastname)?? '-'}}}</td>
                                                        <td>{{$itts->title}}</td>
                                                        <td>{{$itts->buy_point}}</td>
                                                        <td>{{$itts->old_point}}</td>
                                                        <td>{{$itts->bl_point}}</td>
                                                        @if($itts->status==0)
                                                        <td style="color: green;">กำลังรอยืนยัน</td>
                                                        @elseif($itts->status==2)
                                                        <td style="color: red;">ไม่อนุมัติ</td>
                                                        @else
                                                        <td style="color: grey;">อณุมัติ</td>
                                                        @endif

                                                        <!-- <td>
                                                        <a href="{{url('/backend/all_point_edit/'.$itts->id)}}"
                                                            class="btn btn-sm btn-primary" style="color:white;"><i
                                                                class="fa fa-gear"></i>Edit</a>
                                                        <a href="{{url('/backend/all_point_destroy/'.$itts->id)}}"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="javascript:return confirm('You Want To Delete?')"
                                                            style="color:white;"><i class="fa fa-trash"></i>Delete</a>
                                                    </td> -->

                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                    <th>#</th>
                                                    <th>เลขที่คำขอ</th>
                                                    <th>วันที่แลกแต้ม</th>
                                                        <th>ชื่อช่าง</th>
                                                        <th>ชื่อสินค้า</th>
                                                        <!-- <th>Title</th> -->
                                                        <th>คะแนนที่ใช้</th>
                                                        <th>คะแนนก่อนใช้</th>
                                                        <th>คะแนนหลังใช้</th>
                                                        <th>Status</th>
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
        order: [],
        stateSave: true,
                stateSaveCallback: function(settings,data) {
                localStorage.setItem( 'DataTables_' + settings.sInstance, JSON.stringify(data) )
                },
                stateLoadCallback: function(settings) {
                return JSON.parse( localStorage.getItem( 'DataTables_' + settings.sInstance ) )
                }
    });;
    </script>

    <script>
    var table = $('#simpletable3').DataTable({
        order: [],
        stateSave: true,
                stateSaveCallback: function(settings,data) {
                localStorage.setItem( 'DataTables_' + settings.sInstance, JSON.stringify(data) )
                },
                stateLoadCallback: function(settings) {
                return JSON.parse( localStorage.getItem( 'DataTables_' + settings.sInstance ) )
                }
    });;
    </script>


    @endsection