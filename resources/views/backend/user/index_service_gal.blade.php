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
                        <h5 class="m-b-10">Gallery Service</h5>
                    </div>
                </div>
                <!-- Page-header end -->

                <?php if($type==1){
                    $item=DB::table('car_pictures')->where('car_service_id',$id)->orderby('id','desc')->get();
                }else{
                    $item=DB::table('tool_pictures')->where('tool_service_id',$id)->orderby('id','desc')->get();
                } ?>


                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Zero config.table start -->
                            <div class="card">
                                <div class="card-header">


                                <a style="color:white;" class="btn btn-warning" href="{{url('/backend/user_service/'.$user)}}">
                                            <i class="fa fa-arrow-left"></i> Back</a>

                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>

                                                    <th>#</th>
                                                    <th>Picture</th>
                                                    <!-- <th>Title</th> -->
                                                    <!-- <th>Created_at</th> -->
                                                    <th>Updated_at</th>
                                                    <th>Tool</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($item as $key=>$items)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td><img <?php    $filePath = 'file/upload/' . $items->picture;  
$picture= Storage::disk('s3')->url($filePath);
?>

src="{{$picture}}"
                                                            style="width:100px"></td>
                                                    <td>{{$items->updated_at}}</td>
                                                    <td>
                                                        @if($type==1)
                                                        <a href="{{url('/backend/service_gal_destroy/1/'.$items->id)}}"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="javascript:return confirm('You Want To Delete?')"
                                                            style="color:white;"><i class="fa fa-trash"></i>Delete</a>
                                                            @else
                                                            <a href="{{url('/backend/service_gal_destroy/2/'.$items->id)}}"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="javascript:return confirm('You Want To Delete?')"
                                                            style="color:white;"><i class="fa fa-trash"></i>Delete</a>
                                                            @endif
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                <th>#</th>
                                                    <th>Picture</th>
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