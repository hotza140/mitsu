@extends('layouts.menubar')
@section('content')
<style>
.button {
    border-radius: 25px;
}
</style>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header card">
                    <div class="card-block">
                        <h5 class="m-b-10">WORK BACKEND</h5>
                    </div>
                </div>
                <!-- Page-header end -->


                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Zero config.table start -->
                            <div class="card">
                                <div class="card-header">

                                    <a style="color:white;" class="btn btn-success" href="{{url('/backend/wo_add')}}">
                                        <i class="fa fa-plus"></i> Add</a>

                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>

                                                <th>#</th>
                                                <th>Work Number</th>
                                                    <th>ประเภทงาน</th>
                                                    <th>Air Models</th>
                                                    <th>รหัสข้อผิดพลาด</th>
                                                    <th>ราคาค่าบริการ</th>
                                                     <th>วันที่/เวลา</th>
                                                    <!-- <th>Created_at</th> -->
                                                    <th>มีคนรับรึยัง</th>
                                                    <th>สถานะงาน</th>
                                                    <!-- <th>Updated_at</th> -->
                                                    <th>Tool</th>
                                                    <th>ใบงาน</th>

                                                </tr>
                                            </thead>
                                            <!-- <tbody class="sortable"> -->
                                            <tbody>
                                                @foreach($item as $key=>$items)
                                                <!-- <tr class="num" id="{{$items->id}}"> -->
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$items->wo_number}}</td>
                                                    <td>{{$items->wo_type}}</td>

                                                    <?php $aii=App\AirModel::where('id',$items->air_model)->first(); ?>
                                                    @if($aii==null)
                                                    <td>-</td>
                                                    @else
                                                    <td>{{$aii->model_name}}</td>
                                                    @endif
                                                    
                                                    <td>{{$items->error_code}}</td>
                                                    <td>{{$items->wo_price}}</td>
                                                     <td>{{$items->wo_date}}<br>{{$items->wo_time}}</td>

                                                    @if($items->technician_id==null)
                                                    <td style="color:red">ยังไม่มีผู้รับ</td>
                                                    @else
                                                    <?php $aaa=App\User::where('id',$items->technician_id)->first(); ?>
                                                    <td style="color:#20E850">ผู้รับงาน {{$aaa->name}}</td>
                                                    @endif

                                                    @if($items->wo_status==0)
                                                    <td style="color:red">งานยังไม่เสร็จ</td>
                                                    @else
                                                    <td style="color:#20E850">งานสำเร็จ</td>
                                                    @endif
                                                    <!-- <td>{{$items->created_at}}</td> -->
                                                    <!-- <td>{{$items->updated_at}}</td> -->
                                                    <td>
                                                        <a href="{{url('/backend/wo_edit/'.$items->id)}}"
                                                            class="btn btn-sm btn-warning" style="color:white;"><i
                                                                class="fa fa-eye"></i>View</a>

                                                                <a href="{{url('/backend/wo_item/'.$items->id)}}"
                                                            class="btn btn-sm btn-success" style="color:white;"><i
                                                                class="fa fa-pencil"></i>Add item</a>
                                                        <a href="{{url('/backend/wo_destroy/'.$items->id)}}"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="javascript:return confirm('You Want To Delete?')"
                                                            style="color:white;"><i class="fa fa-trash"></i>Delete</a>
                                                    </td>

                                                    <td>
                                                        <a href="{{url('/backend/pdf_work')}}" target="_blank"
                                                            class="btn btn-sm btn-primary" style="color:white;"><i
                                                                class="fa fa-eye"></i>View</a>
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                <th>#</th>
                                                <th>Work Number</th>
                                                    <th>ประเภทงาน</th>
                                                    <th>Air Models</th>
                                                    <th>รหัสข้อผิดพลาด</th>
                                                    <th>ราคาค่าบริการ</th>
                                                    <th>วันที่/เวลา</th>
                                                    <!-- <th>Created_at</th> -->
                                                    <th>มีคนรับรึยัง</th>
                                                    <th>สถานะงาน</th>
                                                    <!-- <th>Updated_at</th> -->
                                                    <th>Tool</th>
                                                    <th>ใบงาน</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>


                                <!-- การซ่อนปุ่ม -->
                                <!-- <input type='button' style='display:none' value='ปุ่มกด'> -->
                                <!-- การซ่อนปุ่ม -->

                            </div>
                            <!-- Zero config.table end -->
                            <!-- Default ordering table start -->


                            <!-- Default ordering table end -->
                            <!-- Multi-column table start -->

                            <!-- Language - Comma Decimal Place table end -->
                        </div>
                    </div>
                </div>
                <!-- Page-body end -->
            </div>
        </div>
        <!-- Main-body end -->


        <div id="styleSelector">


        </div>
    </div>
</div>
</div>


@endsection

@section('script')


@endsection