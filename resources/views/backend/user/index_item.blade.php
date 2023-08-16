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
                            <h5 class="m-b-10">รายการเครื่องปรับอากาศ</h5>
                        </strong>
                        <a href="{{ url('/backend/user') }}" style="color:white;" class="btn btn-warning">
                                        <i class="fa fa-share-square-o"></i> Back </a>

                    </div>
                </div>
                <!-- Page-header end -->

                <!-- Page body start -->
                <div class="page-body">

                    <!-- --------------------- -->
                    <?php  $data = App\Models\AirConditioner::where('mechanic_id',$id)->orderby('id','asc')->with('customer')->get();
                    ?>
                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Zero config.table start -->
                                <div class="card">
                                    <div class="card-header">

                                        <strong>
                                            <h3 class="m-b-10">รายการเครื่องปรับอากาศ</h3>
                                        </strong>

                                    </div>
                                    <div class="card-block">
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable2" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>

                                                        <th>#</th>
                                                        <th>ชื่อลูกค้า</th>
                                                        <th>Outdoor Model Name</th>
                                                        <th>Outdoor number</th>
                                                        <th>Indoor Model Name</th>
                                                        <th>Indoor number</th>
                                                        <th>Point</th>
                                                        <th>Date</th>
                                                      
                                                        <th>Tool</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($data as $key=>$items)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$items->customer->full_name}}</td>
                                                        <td>{{($items->out_name) ?? '-'}}</td>
                                                        <td>{{($items->outdoor_number) ?? '-'}}</td>
                                                        <td>{{($items->in_name)?? '-'}}</td>
                                                        <td>{{($items->indoor_number)?? '-'}}</td>
                                                        <td>{{($items->point)?? '-'}}</td>
                                                        <td>{{$items->created_at}}</td>
                                                       
                                                        <td>
                                                            <a href="{{url('/backend/air_conditioner/'.$items->id.'/'.$id)}}"
                                                                class="btn btn-sm btn-primary" style="color:white;"><i
                                                                    class="fa fa-gear"></i>Edit</a>
                                                            <a href="{{url('/backend/air_conditioner/destroy/'.$items->id)}}"
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
                                                        <th>ชื่อลูกค้า</th>
                                                        <th>Outdoor Model Name</th>
                                                        <th>Outdoor number</th>
                                                        <th>Indoor Model Name</th>
                                                        <th>Indoor number</th>
                                                        <th>Point</th>
                                                        <th>Date</th>
                                                        
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