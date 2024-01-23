@extends('layouts.menubar')
@section('content')
<style>
.button{border-radius: 25px;}
</style>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header card">
                    <div class="card-block">
                    <strong><h5 class="m-b-10">BANNER BACKEND</h5></strong>

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

                                    {{-- <a style="color:white;" class="btn btn-success" href="{{url('/backend/banner_add')}}"> <i class="fa fa-plus"></i> Add</a> --}}

                                    <?php $date=date('Y-m-d');   ?>
                               
                               <div><br>
                                   <form class="form-horizontal" action="{{url('/backend/air_conditioner')}}" method="GET" enctype="multipart/form-data">
                                          @csrf
                                       <input type="date" name="date_s" value="<?php if(isset($date_s)){echo $date_s;}else{echo $date;} ?>"  class="col-md-2">Start<br><br>
                                       <input type="date" name="date_e" value="<?php if(isset($date_e)){echo $date_e;}else{echo $date;} ?>"  class="col-md-2">End<br><br>

                                       <button type="submit" class="btn btn-danger" style="color:white;"
                                               onclick="return confirm('Confirm!');"> <i
                                                   class="fa fa-check-circle-o"></i> Enter </button>

                                                   <a href="{{ url('/backend/air_conditioner') }}"
                                               style="color:white;" class="btn btn-warning"> <i
                                                   class="fa fa-share-square-o"></i> Reset </a>
                                       </form>
                                       </div>






                                       <div><br>
                               <h5>Export รายละเอียด</h5>
                                   <form class="form-horizontal" action="{{url('backend/data_export')}}" method="POST" enctype="multipart/form-data">
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
                                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>

                                                <th>#</th>
                                                <th>ช่างติดตั้ง</th>
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
                                            @foreach($item as $key=>$items)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                <?php  $name=App\Models\Customer::where('id',$items->customer_id)->first();  ?>
                                                @if($name!=null)
                                                <?php  $users=App\User::where('id',$name->mechanic_id)->first();  ?>
                                                <td>{{@$users->name}} {{@$users->lastname}}</td>
                                                    <td>{{$name->full_name}}</td>
                                                    @else
                                                    <td></td>
                                                    <td></td>
                                                    @endif
                                                    <td>{{($items->out_name) ?? '-'}}</td>
                                                        <td>{{($items->outdoor_number) ?? '-'}}</td>
                                                        <td>{{($items->in_name)?? '-'}}</td>
                                                        <td>{{($items->indoor_number)?? '-'}}</td>
                                                        <td>{{($items->point)?? '-'}}</td>
                                                        <td>{{$items->created_at}}</td>
                                                    <td>
                                                    <a href="{{url('/backend/air_conditioner/'.$items->id)}}" class="btn btn-sm btn-primary" style="color:white;"><i class="fa fa-gear"></i>Edit</a>
                                                        <a href="{{url('/backend/air_conditioner/destroy/'.$items->id)}}" class="btn btn-sm btn-danger" onclick="javascript:return confirm('You Want To Delete?')"  style="color:white;"><i class="fa fa-trash"></i>Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                <th>#</th>
                                                <th>ช่างติดตั้ง</th>
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
