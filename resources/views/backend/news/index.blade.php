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
                        <h5 class="m-b-10">NEWS BACKEND</h5>
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

                                    <a style="color:white;" class="btn btn-success" href="{{url('/backend/news_add')}}">
                                        <i class="fa fa-plus"></i> Add</a>

                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>

                                                    <th>#</th>
                                                    <th>เลือกเพื่อแนะนำ</th>
                                                    <th>Picture</th>
                                                    <th>Title</th>
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

                                                    @if($items->choose==0)
                                                    <td>
                                                    <form  class="FormStatus"  >
                                                            <input type="hidden" name="hidden" value="0" class="hidden ">
                                                            <input type="hidden" name="id" value="{{$items->id}}" class="id ">
                                                            <center><input type="checkbox" class="choose switchery switchery-default"  ></center>
                                                    </form>
                                                            </td>
                                                            
                                                         @else
                                                         <td>
                                                         <form  class="FormStatus"  >
                                                            <input type="hidden" name="hidden" value="1" class="hidden ">
                                                            <input type="hidden" name="id" value="{{$items->id}}" class="id ">
                                                            <center><input type="checkbox" class="choose switchery switchery-default" checked ></center>
                                                        
                                                         </form>    
                                                            </td>       
                                                           
                                                         @endif 


                                                    <td><img src="{{asset('/img/upload/'.$items->picture)}}"
                                                            style="width:200px"></td>
                                                    <td>{{$items->titleen}}</td>
                                                    <!-- <td>{{$items->created_at}}</td> -->
                                                    <td>{{$items->updated_at}}</td>
                                                    <td>
                                                        <a href="{{url('/backend/news_edit/'.$items->id)}}"
                                                            class="btn btn-sm btn-primary" style="color:white;"><i
                                                                class="fa fa-gear"></i>Edit</a>
                                                        <a href="{{url('/backend/news_destroy/'.$items->id)}}"
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
                                                    <th>เลือกเพื่อแนะนำ</th>
                                                    <th>Picture</th>
                                                    <th>Title</th>
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

<script>
    $(document).on('change', '.choose', function () {

        var form_tr = $(this).closest('.FormStatus');
        var id = form_tr.find('.id').val();
        var hidden = form_tr.find('.hidden').val();
        
            $.ajax({
                url: "{!!url('/news_choose')!!}",
                method: "POST",
                type: "PUT",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                    hidden: hidden,
                },
                success: function(status) {
                    console.log(status);
                    if(status=='success'){
                        // alert('save');
                        // $('#form').submit();
                    }else{
                        // alert('error');
                        // location.reload();
                    }
                   
                },
            });

    });
    </script>


@endsection