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
                            <h5 class="m-b-10">รายการแลกเปลี่ยน</h5>
                        </strong>
                       

                    </div>
                </div>
                <!-- Page-header end -->

                <!-- Page body start -->
                <div class="page-body">



                    <!-- --------------------- -->
                    <?php 
                     $data = App\Models\buy_point::where('status',0)->whereBetween('created_at', [$start_date, $end_date])
                     ->with('item')->with('user')->orderby('id','desc')->get();
                    ?>
                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Zero config.table start -->
                                <div class="card">
                                    <div class="card-header">

                                        <strong>
                                            <h3 class="m-b-10" >รายการแลกเปลี่ยนรอยืนยัน</h3>
                                        </strong>


                                        <div><br>
                                    <form class="form-horizontal" action="{{url('/backend/wait_point')}}" method="GET" enctype="multipart/form-data">
                                           @csrf
                                        

                                        <input type="date" name="start_date" value="{{@$start_date}}" required class="col-md-2">Start<br><br>
                                       <input type="date" name="end_date" value="{{@$end_date}}"  required class="col-md-2">End<br><br>

                                       <button type="submit" class="btn btn-danger" style="color:white;"
                                               onclick="return confirm('Confirm!');"> <i
                                                   class="fa fa-check-circle-o"></i> Enter </button>

                                                   <a href="{{ url('/backend/wait_point') }}"
                                               style="color:white;" class="btn btn-warning"> <i
                                                   class="fa fa-share-square-o"></i> Reset </a>
                                                   
                                        </form>
                                        </div>

                                    </div>
                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <!-- <table id="simpletable3" class="table table-striped table-bordered nowrap"> -->
                                            <table id="export_excel_file" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>

                                                        <th>#</th>
                                                        <th>เลขที่คำขอ</th>
                                                        <th>ชื่อลูกค้า</th>
                                                        <th>ข้อมูลติดต่อ</th>
                                                        <th>รูปแบบการรับ</th>
                                                        <th>ที่อยู่จัดส่ง</th>
                                                        <th>ชื่อสินค้า</th>
                                                        <!-- <th>Title</th> -->
                                                        <th>คะแนนที่ใช้</th>
                                                        <th>คะแนนก่อนใช้</th>
                                                        <th>คะแนนหลังใช้</th>
                                                        <th>Date</th>
                                                        <!-- <th>Status</th> -->
                                                        <th>Tool</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($data as $key=>$itts)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$itts->number}}</td>
                                                        <?php $p1=App\User::where('id',$itts->id_user)->first();  ?>
                                                        <td>{{(@$p1->name)?? '-'}} {{(@$p1->lastname)?? '-'}}</td>
                                                        <td>Phone: {{(@$p1->phone)?? '-'}}
                                                            Email: {{(@$p1->email)?? '-'}}
                                                            Line: {{(@$p1->line)?? '-'}}
                                                        </td>
                                                        @if($itts->way==null)
                                                        <td>รับตามที่อยู่</td>
                                                        @else
                                                        <td>{{$itts->way}}</td>
                                                        @endif

                                                        @if($itts->address!=null)
                                                        <td>{{@$p1->province}}/{{@$p1->district}}/{{@$p1->amphur}}/{{@$p1->location}}</td>
                                                        @else
                                                        <td>{{$itts->address}}</td>
                                                        @endif
                                                        <td>{{$itts->title}}</td>
                                                        <!-- <td>{{($itts->item->titleen)?? '-'}}</td> -->
                                                        <td>{{$itts->buy_point}}</td>
                                                        <td>{{$itts->old_point}}</td>
                                                        <td>{{$itts->bl_point}}</td>
                                                        <td>{{$itts->date}}</td>
                                                        <!-- @if($itts->status==0)
                                                        <td style="color: green;">กำลังรอยืนยัน</td>
                                                        @elseif($itts->status==2)
                                                        <td style="color: red;">ไม่อนุมัติ</td>
                                                        @else
                                                        <td style="color: grey;">อณุมัติ</td>
                                                        @endif -->
                                                        <td><a href="{{url('/backend/wait_con/'.$itts->id)}}" class="btn btn-sm btn-success" onclick="javascript:return confirm('Confirm?')"
                                                          style="color:white;"><i class="fa fa-gear" >อนุมัติ</i></a>
                                                          <a href="{{url('/backend/wait_not/'.$itts->id)}}" class="btn btn-sm btn-danger" onclick="javascript:return confirm('Confirm?')"
                                                          style="color:white;"><i class="fa fa-gear">ไม่อนุมัติ</i></a>
                                                        </td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                    <th>#</th>
                                                    <th>เลขที่คำขอ</th>
                                                        <th>ชื่อลูกค้า</th>
                                                        <th>ข้อมูลติดต่อ</th>
                                                        <th>รูปแบบการรับ</th>
                                                        <th>ที่อยู่จัดส่ง</th>
                                                        <th>ชื่อสินค้า</th>
                                                        <!-- <th>Title</th> -->
                                                        <th>คะแนนที่ใช้</th>
                                                        <th>คะแนนก่อนใช้</th>
                                                        <th>คะแนนหลังใช้</th>
                                                        <th>Date</th>
                                                        <!-- <th>Status</th> -->
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

                    <style>
                        button.dt-button, div.dt-button, a.dt-button, button.dt-button:focus:not(.disabled), div.dt-button:focus:not(.disabled), a.dt-button:focus:not(.disabled), button.dt-button:active:not(.disabled), button.dt-button.active:not(.disabled), div.dt-button:active:not(.disabled), div.dt-button.active:not(.disabled), a.dt-button:active:not(.disabled), a.dt-button.active:not(.disabled) {
                            background-color: #ffb64d;
                            border-color: #000;
                            border-radius: 2px;
                            color: #fff;
                            background-image: none;
                            font-size: 14px;
                        }
                    </style>

                    <script>
                    $(document).ready(function() {
                        var table = $('#export_excel_file').DataTable({
                            dom: 'Bfrtip',
                            buttons: [
                                {
                                    extend: 'excel',
                                    filename: 'รายการแลกเปลี่ยนรอยืนยัน',
                                }
                            ]
                        });
                        });
                    </script>



                    <div class="m-b-10" style="background-color: red;">.</div>
                     <!-- --------------------- -->
                     <?php   $data1 = App\Models\buy_point::where('status',1)->with('item')->with('user')->orderby('id','desc')->limit(10)->get();
                    ?>
                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Zero config.table start -->
                                <div class="card">
                                    <div class="card-header">

                                        <strong>
                                            <h3 class="m-b-10" style="color: green;">รายการแลกเปลี่ยนที่อนุมัติ 10 รายการล่าสุด</h3>
                                        </strong>

                                    </div>
                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <!-- <table id="simpletable" class="table table-striped table-bordered nowrap"> -->
                                            <table id="" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>

                                                        <th>#</th>
                                                        <th>เลขที่คำขอ</th>
                                                        <th>ชื่อลูกค้า</th>
                                                        <th>ข้อมูลติดต่อ</th>
                                                        <th>ชื่อสินค้า</th>
                                                        <th>ที่อยู่</th>
                                                        <!-- <th>Title</th> -->
                                                        <th>Point</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Delete</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($data1 as $key=>$itts)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$itts->number}}</td>
                                                        <?php $p2=App\User::where('id',$itts->id_user)->first();  ?>
                                                        <td>{{($p2->name)?? '-'}} {{($p2->lastname)?? '-'}}</td>
                                                        <td>Phone: {{($p2->phone)?? '-'}}
                                                            Email: {{($p2->email)?? '-'}}
                                                            Line: {{($p2->line)?? '-'}}
                                                        </td>
                                                        <td>{{$itts->title}} </td>
                                                        <td>{{$itts->address}}</td>
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
                                                        <td><a href="{{url('/backend/wait_destroy/'.$itts->id)}}" class="btn btn-sm btn-danger" onclick="javascript:return confirm('Confirm?')"
                                                          style="color:white;"><i class="fa fa-trash"></i></a></td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                    <th>#</th>
                                                    <th>เลขที่คำขอ</th>
                                                        <th>ชื่อลูกค้า</th>
                                                        <th>ข้อมูลติดต่อ</th>
                                                        <th>ชื่อสินค้า</th>
                                                        <th>ที่อยู่</th>
                                                        <!-- <th>Title</th> -->
                                                        <th>Point</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Delete</th>
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
                     <?php   $data2 = App\Models\buy_point::where('status',2)->with('item')->with('user')->orderby('id','desc')->limit(10)->get();
                    ?>
                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Zero config.table start -->
                                <div class="card">
                                    <div class="card-header">

                                        <strong>
                                            <h3 class="m-b-10" style="color: red;">รายการแลกเปลี่ยนที่ไม่อนุมัติ 10 รายการล่าสุด</h3>
                                        </strong>

                                    </div>
                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <!-- <table id="simpletable2" class="table table-striped table-bordered nowrap"> -->
                                            <table id="" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>

                                                        <th>#</th>
                                                        <th>เลขที่คำขอ</th>
                                                        <th>ชื่อลูกค้า</th>
                                                        <th>ข้อมูลติดต่อ</th>
                                                        <th>ชื่อสินค้า</th>
                                                        <th>ที่อยู่</th>
                                                        <!-- <th>Title</th> -->
                                                        <th>Point</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Delete</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($data2 as $key=>$itts)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$itts->number}}</td>
                                                        <?php $p3=App\User::where('id',$itts->id_user)->first();  ?>
                                                        <td>{{($p3->name)?? '-'}} {{($p3->lastname)?? '-'}}</td>
                                                        <td>Phone: {{($p3->phone)?? '-'}}
                                                            Email: {{($p3->email)?? '-'}}
                                                            Line: {{($p3->line)?? '-'}}
                                                        </td>
                                                        <td>{{$itts->title}}</td>
                                                        <td>{{$itts->address}}</td>
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
                                                        <td><a href="{{url('/backend/wait_destroy/'.$itts->id)}}" class="btn btn-sm btn-danger" onclick="javascript:return confirm('Confirm?')"
                                                          style="color:white;"><i class="fa fa-trash"></i></a></td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                    <th>#</th>
                                                    <th>เลขที่คำขอ</th>
                                                        <th>ชื่อลูกค้า</th>
                                                        <th>ข้อมูลติดต่อ</th>
                                                        <th>ชื่อสินค้า</th>
                                                        <th>ที่อยู่</th>
                                                        <!-- <th>Title</th> -->
                                                        <th>Point</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Delete</th>
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