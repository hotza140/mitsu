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
                        <strong>
                            <h5 class="m-b-10">USERS BACKEND</h5>
                        </strong>

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

                                    <!-- <div class="card-block">
                                        <form method="post" id="" action="{{ url('/backend/user_gen') }}" enctype="multipart/form-data">
                                            @csrf
                                            <br> <input type="text" name="name" class="m-b-10" > Name
                                            <br> <input type="text" name="lastname" class="m-b-10" > Last Name
                                            <br><button type="submit" class="btn btn-danger " style="color:white;"
                                                onclick="return confirm('Confirm!');"> <i
                                                    class="fa fa-check-circle-o"></i> Save
                                            </button>
                                        </form>
                                    </div> -->

                                    <a style="color:white;" class="btn btn-success" href="{{url('/backend/user_add')}}"> <i class="fa fa-plus"></i> Add</a>

                                    <div><br>
                                    <form class="form-horizontal" action="{{url('/backend/user')}}" method="GET" enctype="multipart/form-data">
                                           @csrf
                                        <input type="text" name="search"  class="col-md-2"> Search
                                        </form>
                                        </div>

                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="table_no" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>

                                                    <th>#</th>
                                                    <th>Open/Close</th>
                                                    <th>Code</th>
                                                    <!-- <th>Picture</th> -->
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <!-- <th>Created_at</th> -->
                                                    <!-- <th>Updated_at</th> -->
                                                    <th>Tool</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($item as $key=>$items)
                                                <tr>
                                                    <td>{{$key+1}}</td>

                                                    @if($items->open==0)
                                                    <td>
                                                        <form method="post" id="form{{$items->id}}"
                                                            action="{{ url('/open_close') }}"
                                                            enctype="multipart/form-data" name="form{{$items->id}}"
                                                            onsubmit="submit()">
                                                            @csrf

                                                            <input type="hidden" name="hidden" value="0" class="hidden">
                                                            <input type="hidden" name="id" value="{{$items->id}}"
                                                                class="id">
                                                            <button type="submit" class="btn btn-info  button"
                                                                style="color:white;"> <i
                                                                    class="fa fa-check-circle-o"></i> เปิดการใช้งาน
                                                            </button>
                                                        </form>
                                                    </td>

                                                    @else
                                                    <td>
                                                        <form method="post" id="form{{$items->id}}"
                                                            action="{{ url('/open_close') }}"
                                                            enctype="multipart/form-data" name="form{{$items->id}}"
                                                            onsubmit="submit()">
                                                            @csrf

                                                            <input type="hidden" name="hidden" value="1" class="hidden">
                                                            <input type="hidden" name="id" value="{{$items->id}}"
                                                                class="id">
                                                            <button type="submit" class="btn btn-secondary  button"
                                                                style="color:red;"> <i class="fa fa-times-circle-o"></i>
                                                                ระงับการใช้งาน
                                                            </button>

                                                        </form>
                                                    </td>

                                                    @endif

                                                    <td>{{$items->code}}</td>
                                                    <!-- @if($items->picture!=null)
                                                    <td><img <?php    $filePath = 'file/upload/' . $items->picture;  
$picture= Storage::disk('s3')->url($filePath);
?>

src="{{$picture}}"
                                                            style="width:100px"></td>
                                                    @else
                                                    <td><img src="{{asset('/img/no_img.png')}}" style="width:100px">
                                                    </td>
                                                    @endif -->
                                                    <td>{{$items->name}} {{$items->lastname}}</td>
                                                    <td>{{$items->email}}</td>
                                                    <td>{{$items->phone}}</td>
                                                    <!-- <td>{{$items->created_at}}</td> -->
                                                    <!-- <td>{{$items->updated_at}}</td> -->
                                                    <td>
                                                        <a href="{{url('/backend/user_edit/'.$items->id)}}"
                                                            >ข้อมูลช่างบริการ</a> 
                                                                <br>
                                                        <a href="{{url('/backend/user_service/'.$items->id)}}"
                                                            >ข้อมูลหน่วยบริการ</a> 
                                                                <br>
                                                        <a href="{{url('/backend/user_item/'.$items->id)}}"
                                                            >ข้อมูลลงทะเบียน</a> 
                                                                <br>
                                                        <a href="{{url('/backend/user_destroy/'.$items->id)}}" class="btn btn-sm btn-danger" onclick="javascript:return confirm('You Want To Delete?')"  style="color:white;"><i class="fa fa-trash"></i>Delete</a>
                                                    </td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Open/Close</th>
                                                    <th>Code</th>
                                                    <!-- <th>Picture</th> -->
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <!-- <th>Created_at</th> -->
                                                    <!-- <th>Updated_at</th> -->
                                                    <th>Tool</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <br><br>
                                    {{$item->appends(Request::all())->links()}}
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

<!-- <script>

$(document).on('click', '.button', e => {
    e.preventDefault();

    let hidden = $('.hidden').val();
    let id = $('.id').val();

    $.ajax({
    url: '{{url('/change')}}',
      type:"POST",
      data:{
        "_token": "{{ csrf_token() }}",
        hidden:hidden,
        id:id,
      },
      success:function(response){
        // $('#successMsg').show();
        // console.log(response);
        // alert('success!');
        location.reload();
      },
      error: function(response) {
        // $('#nameErrorMsg').text(response.responseJSON.errors.name);
      },
      });

});
</script> -->


@endsection