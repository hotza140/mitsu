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
                            <h5 class="m-b-10">ข้อมูลสมาชิก Excel</h5>
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

                            
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <!-- <table id="table_no" class="table table-striped table-bordered nowrap"> -->
                                        <table id="export_excel_file" class="table table-striped table-bordered nowrap">
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

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($item as $key=>$items)
                                                <tr>
                                                    <td>{{$key+1}}</td>

                                                    @if($items->open==0)
                                                    <td>เปิดการใช้งาน
                                                    </td>

                                                    @else
                                                    <td>ระงับการใช้งาน</td>
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
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>


                                <style>
                        button.dt-button, div.dt-button, a.dt-button, button.dt-button:focus:not(.disabled), div.dt-button:focus:not(.disabled), a.dt-button:focus:not(.disabled), button.dt-button:active:not(.disabled), button.dt-button.active:not(.disabled), div.dt-button:active:not(.disabled), div.dt-button.active:not(.disabled), a.dt-button:active:not(.disabled), a.dt-button.active:not(.disabled) {
                            background-color: #ffb64d;
                            border-color: #000;
                            border-radius: 2px;
                            color: #fff;
                            background-image: none;
                            font-size: 14px;
                        }
                    </style>


<script>
    $(document).ready(function() {
        var table = $('#export_excel_file').DataTable({
            dom: '<"wrapper"B>',
            paging: false, // Disable pagination
            scrollY: '400px', // Adjust the height as needed
            buttons: [
                {
                    extend: 'excel',
                    filename: 'ข้อมูลสมาชิก',
                }
            ]
        });
    });
</script>


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