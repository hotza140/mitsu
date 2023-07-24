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
                        <h5 class="m-b-10">Air Models POINT BACKEND</h5>
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

                                <!-- <form action="{{url('backend/user_excel')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <h6 style="color: red">(* อัพโหลดไฟล์ Excel ข้อมูล Model )</h6>
                                    <button type="submit" class="btn btn-danger" onclick="javascript:return confirm('Confirm?')" id="main"> Import </button>
                                    <input type="file" name="file"  />
                                   
                                    </form>
                                    <br> -->

                                    <a style="color:white;" class="btn btn-success" href="{{url('/backend/air_model_add')}}">
                                        <i class="fa fa-plus"></i> Add</a>

                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>

                                                    <th>#</th>
                                                    <th>Name (No.)</th>
                                                    <th>Description</th>
                                                    <th>Point</th>
                                                    <!-- <th>Type</th> -->
                                                    <!-- <th>Title</th> -->
                                                    <!-- <th>Created_at</th> -->
                                                    <th>Updated_at</th>
                                                    <th>Tool</th>

                                                </tr>
                                            </thead>
                                            <!-- <tbody class="sortable"> -->
                                            <tbody>
                                                @foreach($item as $key=>$items)
                                                <!-- <tr class="num" id="{{$items->id}}"> -->
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$items->model_name}}</td>
                                                    <td>{{$items->des}}</td>
                                                    <td>{{$items->point}}</td>
                                                    <!-- <td>{{$items->model_type}}</td> -->
                                                    <!-- <td>{{$items->created_at}}</td> -->
                                                    <td>{{$items->updated_at}}</td>
                                                    <td>
                                                        <a href="{{url('/backend/air_model_edit/'.$items->id)}}"
                                                            class="btn btn-sm btn-primary" style="color:white;"><i
                                                                class="fa fa-gear"></i>Edit</a>
                                                        <a href="{{url('/backend/air_model_destroy/'.$items->id)}}"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="javascript:return confirm('You Want To Delete?')"
                                                            style="color:white;"><i class="fa fa-trash"></i>Delete</a>
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                <th>#</th>
                                                <th>Name (No.)</th>
                                                    <th>Description</th>
                                                    <th>Point</th>
                                                    <!-- <th>Type</th> -->
                                                    <!-- <th>Title</th> -->
                                                    <!-- <th>Created_at</th> -->
                                                    <th>Updated_at</th>
                                                    <th>Tool</th>
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