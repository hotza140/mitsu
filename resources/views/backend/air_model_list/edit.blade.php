@extends('layouts.menubar')
<!-- <style>
    .atm {
    background-image: linear-gradient(to right, #4cff40 10%, #008697 51%, #08e3ff 100%);
}
</style> -->
@section('content')
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header card">
                    <div class="card-block atm">
                        <h5 class="m-b-10">Air Models/EDIT</h5>

                    </div>
                </div>
                <!-- Page-header end -->

                <!-- Page body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Basic Form Inputs card start -->
                            <div class="card">
                                <div class="card-header">

                                </div>
                                
                                <div class="card-block">

                                    <form method="post" id="" action="{{ url('/backend/air_model_list_update/'.$item->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf


                                        <!-- -------EDIT---------- -->
                                        @if(isset($item))
                                        <input type="hidden" name="edit" value="{{$item->id}}">
                                        @else
                                        <input type="hidden" name="edit" value="">
                                        @endif
                                        <!-- -------EDIT---------- -->

                                        
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <label class="col-form-label">Model</label>
                                                <input type="text" name="model" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->model;} ?>">
                                            </div>
                                        </div>




                                        <div class="form-group row">
                                            <h4>1. อุณหภูมิลมกลับ</h4>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">Min</label>
                                                <input type="text" name="min1" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->min1;} ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">Standard</label>
                                                <input type="text" name="stan1" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->stan1;} ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">Max</label>
                                                <input type="text" name="max1" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->max1;} ?>">
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <h4>2. อุณหภูมิลมจ่าย</h4>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">Min</label>
                                                <input type="text" name="min2" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->min2;} ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">Standard</label>
                                                <input type="text" name="stan2" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->stan2;} ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">Max</label>
                                                <input type="text" name="max2" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->max2;} ?>">
                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <h4>3. อุณหภูมิภายนอก</h4>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">Min</label>
                                                <input type="text" name="min3" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->min3;} ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">Standard</label>
                                                <input type="text" name="stan3" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->stan3;} ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">Max</label>
                                                <input type="text" name="max3" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->max3;} ?>">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <h4>4. ความดันน้ำยา</h4>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">Min</label>
                                                <input type="text" name="min4" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->min4;} ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">Standard</label>
                                                <input type="text" name="stan4" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->stan4;} ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">Max</label>
                                                <input type="text" name="max4" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->max4;} ?>">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <h4>5. กระแสคอมเพรสเซอร์</h4>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">Min</label>
                                                <input type="text" name="min5" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->min5;} ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">Standard</label>
                                                <input type="text" name="stan5" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->stan5;} ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">Max</label>
                                                <input type="text" name="max5" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->max5;} ?>">
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <h4>6. แรงดันไฟฟ้า</h4>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">Min</label>
                                                <input type="text" name="min6" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->min6;} ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">Standard</label>
                                                <input type="text" name="stan6" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->stan6;} ?>">
                                            </div>
                                            <div class="col-sm-4">
                                                <label class="col-form-label">Max</label>
                                                <input type="text" name="max6" class="form-control" id="pic"
                                                    value="<?php if(isset($item)){echo $item->max6;} ?>">
                                            </div>
                                        </div>



                                         <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label class="col-form-label">สรุป</label>
                                                <textarea class="form-control" name="sum" id=""
                                                    style="height:300px"><?php if(isset($item)){echo $item->sum;} ?></textarea>
                                            </div>
                                        </div>

                                        

                                   


                                        <p class="text-right">
                                            <a href="{{ url('/backend/air_model_list') }}" style="color:white;"
                                                class="btn btn-success"> <i class="fa fa-share-square-o"></i> Back </a>
                                            <button type="submit" class="btn btn-danger " style="color:white;"
                                                onclick="return confirm('Confirm!');"> <i
                                                    class="fa fa-check-circle-o"></i> Save </button>
                                        </p>

                                    </form>
                                </div>

                            <!-- Input Alignment card end -->
                        </div>
                    </div>
                </div>
                <!-- Page body end -->
            </div>
        </div>
        <div id="styleSelector">

        </div>
    </div>


    @endsection

    @section('script')

    @endsection