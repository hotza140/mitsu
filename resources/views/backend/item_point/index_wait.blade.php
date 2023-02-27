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
                        <a href="{{ url('/backend/user') }}" style="color:white;" class="btn btn-warning">
                                        <i class="fa fa-share-square-o"></i> Back </a>

                    </div>
                </div>
                <!-- Page-header end -->

                <!-- Page body start -->
                <div class="page-body">



                    <!-- --------------------- -->
                    <?php  $data = App\Models\buy_point::where('status',0)->with('item')->with('user')->orderby('id','desc')->get();
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

                                    </div>
                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable3" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>

                                                        <th>#</th>
                                                        <th>ชื่อลูกค้า</th>
                                                        <th>ข้อมูลติดต่อ</th>
                                                        <th>Picture</th>
                                                        <!-- <th>Title</th> -->
                                                        <th>Point</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Tool</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($data as $key=>$itts)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <?php $p1=App\User::where('id',$itts->id_user)->first();  ?>
                                                        <td>{{($p1->name)?? '-'}} {{($p1->lastname)?? '-'}}</td>
                                                        <td>{{($p1->phone)?? '-'}}<br>
                                                            {{($p1->email)?? '-'}}<br>
                                                            {{($p1->line)?? '-'}}
                                                        </td>
                                                        <td>
                                                        <img src="{{asset('/img/upload/'.$itts->item->picture)}}" style="width:100px">
                                                        </td>
                                                        <!-- <td>{{($itts->item->titleen)?? '-'}}</td> -->
                                                        <td>{{($itts->item->point)?? '-'}}</td>
                                                        <td>{{$itts->date}}</td>
                                                        @if($itts->status==0)
                                                        <td style="color: green;">กำลังรอยืนยัน</td>
                                                        @elseif($itts->status==2)
                                                        <td style="color: red;">ไม่อนุมัติ</td>
                                                        @else
                                                        <td style="color: grey;">สำเร็จ</td>
                                                        @endif
                                                        <td><a href="{{url('/backend/wait_con/'.$itts->id)}}" class="btn btn-sm btn-success" onclick="javascript:return confirm('You Want To Delete?')"
                                                          style="color:white;"><i class="fa fa-gear" >อนุมัติ</i></a>
                                                          <a href="{{url('/backend/wait_not/'.$itts->id)}}" class="btn btn-sm btn-danger" onclick="javascript:return confirm('You Want To Delete?')"
                                                          style="color:white;"><i class="fa fa-gear">ไม่อนุมัติ</i></a>
                                                        </td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                    <th>#</th>
                                                        <th>ชื่อลูกค้า</th>
                                                        <th>ข้อมูลติดต่อ</th>
                                                        <th>Picture</th>
                                                        <!-- <th>Title</th> -->
                                                        <th>Point</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
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
                     <?php   $data1 = App\Models\buy_point::where('status',1)->with('item')->with('user')->orderby('id','desc')->get();
                    ?>
                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Zero config.table start -->
                                <div class="card">
                                    <div class="card-header">

                                        <strong>
                                            <h3 class="m-b-10" style="color: green;">รายการแลกเปลี่ยนที่อนุมัติ</h3>
                                        </strong>

                                    </div>
                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>

                                                        <th>#</th>
                                                        <th>ชื่อลูกค้า</th>
                                                        <th>ข้อมูลติดต่อ</th>
                                                        <th>Picture</th>
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
                                                        <?php $p2=App\User::where('id',$itts->id_user)->first();  ?>
                                                        <td>{{($p2->name)?? '-'}} {{($p2->lastname)?? '-'}}</td>
                                                        <td>{{($p2->phone)?? '-'}}<br>
                                                            {{($p2->email)?? '-'}}<br>
                                                            {{($p2->line)?? '-'}}
                                                        </td>
                                                        <td>
                                                        <img src="{{asset('/img/upload/'.$itts->item->picture)}}" style="width:100px">
                                                        </td>
                                                        <!-- <td>{{($itts->item->titleen)?? '-'}}</td> -->
                                                        <td>{{($itts->item->point)?? '-'}}</td>
                                                        <td>{{$itts->date}}</td>
                                                        @if($itts->status==0)
                                                        <td style="color: green;">กำลังรอยืนยัน</td>
                                                        @elseif($itts->status==2)
                                                        <td style="color: red;">ไม่อนุมัติ</td>
                                                        @else
                                                        <td style="color: grey;">สำเร็จ</td>
                                                        @endif
                                                        <td><a href="{{url('/backend/wait_destroy/'.$itts->id)}}" class="btn btn-sm btn-danger" onclick="javascript:return confirm('You Want To Delete?')"
                                                          style="color:white;"><i class="fa fa-trash"></i></a></td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                    <th>#</th>
                                                        <th>ชื่อลูกค้า</th>
                                                        <th>ข้อมูลติดต่อ</th>
                                                        <th>Picture</th>
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
                     <?php   $data2 = App\Models\buy_point::where('status',2)->with('item')->with('user')->orderby('id','desc')->get();
                    ?>
                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Zero config.table start -->
                                <div class="card">
                                    <div class="card-header">

                                        <strong>
                                            <h3 class="m-b-10" style="color: red;">รายการแลกเปลี่ยนที่ไม่อนุมัติ</h3>
                                        </strong>

                                    </div>
                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable2" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>

                                                        <th>#</th>
                                                        <th>ชื่อลูกค้า</th>
                                                        <th>ข้อมูลติดต่อ</th>
                                                        <th>Picture</th>
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
                                                        <?php $p3=App\User::where('id',$itts->id_user)->first();  ?>
                                                        <td>{{($p3->name)?? '-'}} {{($p3->lastname)?? '-'}}</td>
                                                        <td>{{($p3->phone)?? '-'}}<br>
                                                            {{($p3->email)?? '-'}}<br>
                                                            {{($p3->line)?? '-'}}
                                                        </td>
                                                        <td>
                                                        <img src="{{asset('/img/upload/'.$itts->item->picture)}}" style="width:100px">
                                                        </td>
                                                        <!-- <td>{{($itts->item->titleen)?? '-'}}</td> -->
                                                        <td>{{($itts->item->point)?? '-'}}</td>
                                                        <td>{{$itts->date}}</td>
                                                        @if($itts->status==0)
                                                        <td style="color: green;">กำลังรอยืนยัน</td>
                                                        @elseif($itts->status==2)
                                                        <td style="color: red;">ไม่อนุมัติ</td>
                                                        @else
                                                        <td style="color: grey;">สำเร็จ</td>
                                                        @endif
                                                        <td><a href="{{url('/backend/wait_destroy/'.$itts->id)}}" class="btn btn-sm btn-danger" onclick="javascript:return confirm('You Want To Delete?')"
                                                          style="color:white;"><i class="fa fa-trash"></i></a></td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                    <th>#</th>
                                                        <th>ชื่อลูกค้า</th>
                                                        <th>ข้อมูลติดต่อ</th>
                                                        <th>Picture</th>
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
        order: []
    });;
    </script>

    <script>
    var table = $('#simpletable3').DataTable({
        order: []
    });;
    </script>


    @endsection