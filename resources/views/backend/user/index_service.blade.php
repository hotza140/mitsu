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
                            <h5 class="m-b-10">USERS Service</h5>
                        </strong>

                    </div>
                </div>
                <!-- Page-header end -->

                <!-- Page body start -->
                <div class="page-body">


                    <!-- --------------------- -->
                    <?php $car=DB::table('car_services')->where('machanic_id',$id)->orderby('id','desc')->get(); ?>
                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Zero config.table start -->
                                <div class="card">
                                    <div class="card-header">

                                        <strong>
                                            <h3 class="m-b-10">CAR Service</h3>
                                        </strong>


                                        <a style="color:white;" class="btn btn-warning" href="{{url('/backend/user')}}">
                                            <i class="fa fa-arrow-left"></i> Back</a>

                                    </div>


                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable1" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>

                                                        <th>#</th>
                                                        <th>Brand</th>
                                                        <th>Model</th>
                                                        <th>Color</th>
                                                        <th>Number Plate</th>
                                                        <th>Date</th>
                                                        <th>Gallery</th>
                                                        <th>Delete</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($car as $key=>$items)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$items->brand}}</td>
                                                        <td>{{$items->model}}</td>
                                                        <td>{{$items->color}}</td>
                                                        <td>{{$items->number_plate}}</td>
                                                        <td>{{$items->created_at}}</td>
                                                        <td><a href="{{url('/backend/gal_service/1/'.$items->id.'/'.$items->machanic_id)}}" class="btn btn-sm btn-success" onclick="javascript:return confirm('You Want To Delete?')"
                                                          style="color:white;"><i class="fa fa-picture-o"></i></a></td>
                                                        <td><a href="{{url('/backend/car_destroy/'.$items->id)}}" class="btn btn-sm btn-danger" onclick="javascript:return confirm('You Want To Delete?')"
                                                          style="color:white;"><i class="fa fa-trash"></i></a></td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                    <th>#</th>
                                                        <th>Brand</th>
                                                        <th>Model</th>
                                                        <th>Color</th>
                                                        <th>Number Plate</th>
                                                        <th>Date</th>
                                                        <th>Gallery</th>
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
                    <?php $tool=DB::table('tool_services')->where('machanic_id',$id)->orderby('id','desc')->get(); ?>
                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Zero config.table start -->
                                <div class="card">
                                    <div class="card-header">

                                        <strong>
                                            <h3 class="m-b-10">Tool Service</h3>
                                        </strong>
                                        <a style="color:white;" class="btn btn-warning" href="{{url('/backend/user')}}">
                                            <i class="fa fa-arrow-left"></i> Back</a>

                                    </div>
                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable2" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>

                                                    <th>#</th>
                                                        <th>Tool</th>
                                                        <th>Date</th>
                                                        <th>Gallery</th>
                                                        <th>Delete</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($tool as $key=>$items)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$items->tool}}</td>
                                                        <td>{{($items->created_at)}}</td>
                                                        <td><a href="{{url('/backend/gal_service/2/'.$items->id.'/'.$items->machanic_id)}}" class="btn btn-sm btn-success" onclick="javascript:return confirm('You Want To Delete?')"
                                                          style="color:white;"><i class="fa fa-picture-o"></i></a></td>
                                                        <td><a href="{{url('/backend/tool_destroy/'.$items->id)}}" class="btn btn-sm btn-danger" onclick="javascript:return confirm('You Want To Delete?')"
                                                          style="color:white;"><i class="fa fa-trash"></i></a></td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                    <th>#</th>
                                                        <th>Tool</th>
                                                        <th>Date</th>
                                                        <th>Gallery</th>
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
                    <?php $tec=DB::table('technician_services')->where('machanic_id',$id)->orderby('id','desc')->get(); ?>
                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Zero config.table start -->
                                <div class="card">
                                    <div class="card-header">

                                        <strong>
                                            <h3 class="m-b-10">Technician Service</h3>
                                        </strong>
                                        <a style="color:white;" class="btn btn-warning" href="{{url('/backend/user')}}">
                                            <i class="fa fa-arrow-left"></i> Back</a>

                                    </div>
                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable55" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>

                                                    <th>#</th>
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>Nikname</th>
                                                        <th>Phone</th>
                                                        <th>Line</th>
                                                        <th>Date</th>
                                                        <th>Gallery</th>
                                                        <th>Delete</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($tec as $key=>$itts)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{($itts->fname)}}</td>
                                                        <td>{{($itts->lname)}}</td>
                                                        <td>{{($itts->nick_name)}}</td>
                                                        <td>{{($itts->phone)}}</td>
                                                        <td>{{($itts->line)}}</td>
                                                        <td>{{($itts->created_at)}}</td>
                                                        <td><a href="{{url('/backend/gal_service/3/'.$itts->id.'/'.$itts->machanic_id)}}" class="btn btn-sm btn-success" onclick="javascript:return confirm('You Want To Delete?')"
                                                          style="color:white;"><i class="fa fa-picture-o"></i></a></td>
                                                        <td><a href="{{url('/backend/tec_destroy/'.$itts->id)}}" class="btn btn-sm btn-danger" onclick="javascript:return confirm('You Want To Delete?')"
                                                          style="color:white;"><i class="fa fa-trash"></i></a></td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                    <th>#</th>
                                                        <th>First Name</th>
                                                        <th>Last Name</th>
                                                        <th>Nikname</th>
                                                        <th>Phone</th>
                                                        <th>Line</th>
                                                        <th>Date</th>
                                                        <th>Gallery</th>
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
    var table = $('#simpletable1').DataTable({
        order: []
    });;
    </script>

    <script>
    var table = $('#simpletable2').DataTable({
        order: []
    });;
    </script>

    <script>
    var table = $('#simpletable55').DataTable({
        order: []
    });;
    </script>


    @endsection