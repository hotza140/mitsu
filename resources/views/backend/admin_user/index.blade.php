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
                    <strong><h5 class="m-b-10">ADMIN BACKEND</h5></strong>

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

                                    <a style="color:white;" class="btn btn-success" href="{{url('/backend/admin_user_add')}}"> <i class="fa fa-plus"></i> Add</a>

                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                               
                                                    <th>#</th>
                                                    <th>Open/Close</th>
                                                    <th>สถานะ</th>
                                                    <!-- <th>Picture</th> -->
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <!-- <th>Created_at</th> -->
                                                    <th>Updated_at</th>
                                                    <th>Tool</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($item as $key=>$items)
                                                <tr>
                                                    <td>{{$key+1}}</td>

                                                    @if($items->open==0)
                                                    <td>
                                                    <form method="post" id="form{{$items->id}}" action="{{ url('/open_close') }}" enctype="multipart/form-data" name="form{{$items->id}}" onsubmit="submit()">
                                                    @csrf

                                                            <input type="hidden" name="hidden" value="0" class="hidden">
                                                            <input type="hidden" name="id" value="{{$items->id}}" class="id">
                                                            <button type="submit" class="btn btn-info  button" style="color:white;"
                                                            > <i class="fa fa-check-circle-o"></i> Open
                                                            </button>
                                                    </form>
                                                            </td>
                                                            
                                                         @else
                                                         <td>
                                                         <form method="post" id="form{{$items->id}}" action="{{ url('/open_close') }}" enctype="multipart/form-data" name="form{{$items->id}}" onsubmit="submit()">
                                                         @csrf

                                                            <input type="hidden" name="hidden" value="1" class="hidden">
                                                            <input type="hidden" name="id" value="{{$items->id}}" class="id">
                                                            <button type="submit" class="btn btn-secondary  button" style="color:red;"
                                                            > <i class="fa fa-times-circle-o"></i> Close
                                                            </button>
                                                        
                                                         </form>    
                                                            </td>       
                                                           
                                                         @endif  

                                                    @if($items->type==0)
                                                    <td style="color: #dfce00;" >SUPER ADMIN</td>
                                                    @else
                                                    <td style="color: #d712b5;" >ADMIN</td>
                                                    @endif
                                                    <td>{{$items->name}}</td>
                                                    <td>{{$items->email}}</td>
                                                    <!-- <td>{{$items->created_at}}</td> -->
                                                    <td>{{$items->updated_at}}</td>
                                                    <td>
                                                    <a href="{{url('/backend/admin_user_edit/'.$items->id)}}" class="btn btn-sm btn-primary" style="color:white;"><i class="fa fa-gear"></i>แก้ใข</a>
                                                      @if($items->id!=1)  
                                                    <a href="{{url('/backend/admin_user_destroy/'.$items->id)}}" class="btn btn-sm btn-danger" onclick="javascript:return confirm('You Want To Delete?')"  style="color:white;"><i class="fa fa-trash"></i>Delete</a>
                                                    @endif
                                                </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                <th>#</th>
                                                <th>Open/Close</th>
                                                <th>สถานะ</th>
                                                <!-- <th>Picture</th> -->
                                                <th>Name</th>
                                                <th>Email</th>
                                                <!-- <th>Created_at</th> -->
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