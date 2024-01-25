<?php

namespace App\Http\Controllers;


use DB;
use PDF;
use Auth;
use App\User;
use Exception;
use App\Mail\Email;
use App\Models\news;
use App\Models\amphur;
use App\Models\banner;
use App\Models\product;
use App\Models\Customer;
use App\Models\district;

use App\Models\province;
use App\Models\Training;
use App\Models\buy_point;
use App\Mail\Forget_email;
use App\Models\item_point;
use App\Models\TrainingList;
use App\Models\TrainingTurn;
use Illuminate\Http\Request;
use App\Models\history_point;
use App\Models\AirConditioner;
use Illuminate\support\carbon;

use App\Models\TechnicianService;

use App\AirModel;
use App\WO;
use App\WO_item;
use App\Wo_air_checkModel;


use App\Air_listModel;

use App\Models\OTP;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use App\Models\market;

use App\Models\noti;

use App\Models\tb_log;


class ApiController extends Controller

{

    // URL PICTURE
    //  protected $prefix = 'http://www.mitsuheavyth.com/img/upload/';
    // protected $prefix = 'http://hot.orangeworkshop.info/mitsu/img/upload/';

    protected $prefix = 'https://heavyoneclick-mitsu-s3.s3.ap-northeast-1.amazonaws.com/file/upload/';




     ///user_bank///
     public function api_user_bank(Request $r)
     {
         $user = User::where('id', $r->user_id)->first();
         if($user!=null){
            if(@$r->bank_number!=null){
                $user->bank_number=$r->bank_number;
            }
            
            if(@$r->bank_title!=null){
            $user->bank_title=$r->bank_title;
            }

            if(@$r->bank_name!=null){
                $user->bank_name=$r->bank_name;
                }

            if(@$r->bank_number!=null or @$r->bank_title!=null){
            $user->save();
            }

            $message = "Success!";
            $status = true;
            return response()->json([
                'results' => [
                    'user' => $user,
                ],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
         }else{
            $status = false;
            $message = "Not Have User!.";
            return response()->json([
                'results' => [
                ],
                'status' => $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
         }
     }
     ///user_bank///
       


        // API TEST LOG
        public function test_log()
        {

        try{
            $add=new tb_log();
            $add->id_user=8263;
            $add->id_item=37;
            $add->title='TEST แลกแต้ม Log History';
            $add->detail='TEST แลกแต้ม';
            $add->save();

            return response()->json([
                'status' => true,
                'message' => 'Success',
                'result' => [
                    'add' => $add,
                ],
            ]);
        
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'result' => [],
                'status' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
           
    }


    // trainning

    public function train_all()
    {
        $data = Training::with('province', 'amphure', 'district')->get();

        return response()->json([
            'status' => true,
            'message' => 'Success',
            'result' => [
                'data' => $data,
            ],
        ]);
    }


    public function train_turn(Request $r)
    {
        $data_detail = Training::where('id',$r->training_id)->with('province', 'amphure', 'district')->first();
        $data = TrainingTurn::where('training_id', $r->training_id)->orderby('turn', 'asc')->get();
        
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'result' => [
                'data' => $data,
                'data_detail' => $data_detail,
            ],
        ]);
    }

    public function train_turn_detail(Request $r)
    {
        $data = TrainingTurn::where('id', $r->turn_id)->orderby('turn', 'asc')->first();

        return response()->json([
            'status' => true,
            'message' => 'Success',
            'result' => [
                'data' => $data,
            ],
        ]);
    }


    public function train_list(Request $r)
    {
        if($r->training_id!=null){
            $data_detail = Training::where('id',$r->training_id)->with('province', 'amphure', 'district')->first();
        }else{
            $data_detail =null;
        }
   
        $data = TrainingTurn::where('id', $r->turn_id)->orderby('turn', 'asc')->first();

        $lists = TrainingList::where('turn_id', $r->turn_id)->orderby('id','asc')->get();

        return response()->json([
            'status' => true,
            'message' => 'Success',
            'result' => [
                'data' => $data,
                'lists' => $lists,
                'data_detail' => $data_detail,
            ],
        ]);
    }


    public function history_train_list(Request $r)
    {
        if($r->training_id!=null){
            $data_detail = Training::where('id',$r->training_id)->with('province', 'amphure', 'district')->first();
        }else{
            $data_detail =null;
        }
   
        $data = TrainingTurn::where('id', $r->turn_id)->orderby('turn', 'asc')->first();

        $lists = TrainingList::where('turn_id', $r->turn_id)->where('user_id', $r->user_id)->orderby('id','desc')->get();

        return response()->json([
            'status' => true,
            'message' => 'Success',
            'result' => [
                'data' => $data,
                'lists' => $lists,
                'data_detail' => $data_detail,
            ],
        ]);
    }



    public function train_turn_confirm(Request $request)
    {
        $data = TrainingTurn::where('id', $request->turn_id)->orderby('turn', 'asc')->first();
        if($data!=null){

        $check = Training::where('id', $data->training_id)->with('province', 'amphure', 'district')->first();
        if(@$check->status == 'off'){
            $status = false;
            $message = "The Training is close.";
            return response()->json([
                'results' => [
                ],
                'status' => $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        }

        $user = new TrainingList;
                    $user->user_id = $request->user_id;
                    $user->first_name = $request->first_name;
                    $user->last_name = $request->last_name;
                    $user->nickname = $request->nickname;
                    $user->full_name = $request->first_name . ' ' . $request->last_name;
                    $user->phone = $request->phone;
                    $usersResult = User::find($request->user_id);
                    $user->agency = $usersResult->market;

                    $user->training_id = $data->training_id;
                    $user->turn_id = $request->turn_id;
                    $user->save();


        return response()->json([
            'status' => true,
            'message' => 'Success',
            'result' => [
                'data' => $data,
                'user' => $user,
            ],
        ]);
        }else{
            $status = false;
            $message = "Not Have Data!";
            return response()->json([
                'results' => [
                ],
                'status' => $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        }
    }




    public function train_turn_remove($id)
    {
        try {
            $user_training = TrainingList::where('id', $id)->first();
            if ($user_training) {
                $user_training->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Success',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'ไม่พบข้อมูล',
                ], 400);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'result' => [],
                'status' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function train_turn_edit(Request $request)
    {
        if ($request->id) {
            $user_training = TrainingList::where('id', $request->id)->with('training')->first();
            //check status
            if ($user_training->training->status == 'off') {
                return response()->json([
                    'status' => false,
                    'message' => 'The Training is close',
                ], 400);
            }
            //check status

            //check validate value
            $user_training_validate = [
                'user_id' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'phone' => 'required',
                // 'agency' => 'required'
            ];

            $error_validator = [
                'user_id' => 'กรุณากรอกข้อมูล',
                'first_name:required' => 'กรุณากรอกข้อมูล',
                'last_name:required' => 'กรุณากรอกข้อมูล',
                'phone:required' => 'กรุณากรอกข้อมูล',
                // 'agency:required' => 'กรุณากรอกข้อมูล'
            ];

            $validator = Validator::make(
                $request->all(),
                $user_training_validate,
                $error_validator
            );

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'error' => $validator->errors(),
                ], 400);
            }
            //check validate value

            try {
                $list = TrainingList::find($request->id);
                $list->first_name = $request->first_name;
                $list->last_name = $request->last_name;
                $list->full_name = $request->first_name . ' ' . $request->last_name;
                $list->nickname = $request->nickname;
                $list->user_id = $request->user_id;
                $list->phone = $request->phone;
                // $list->agency = $request->agency;
                $list->save();

                $training = Training::where('id', $list->training_id)->with('province', 'amphure', 'district')->first();
                $turn_id = TrainingTurn::where('training_id', $training->id)->orderby('turn', 'desc')->first();

                return response()->json([
                    'status' => true,
                    'message' => "success",
                    'result' => [
                        'list' => $list,
                        'data' => $training,
                        'turn_id' => $turn_id,
                    ],
                ]);
            } catch (Exception $e) {
                Log::error($e->getMessage());
                return response()->json([
                    'result' => [],
                    'status' => false,
                    'message' => $e->getMessage(),
                ], 400);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Not Found User',
            ], 400);
        }
    }

    public function train_turn_approve(Request $request)
    {
        try{
        if ($request->id) {
            // $training_id = $request->id;

            //Check Validate
            $check_validate = [
                'user_id' => 'required',
                'status' => 'required',
            ];

            $error_validator = [
                'user_id:required' => 'กรุณากรอกข้อมูล',
                'status:required' => 'กรุณากรอกข้อมูล',
            ];

            $validator = Validator::make(
                $request->all(),
                $check_validate,
                $error_validator
            );

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'error' => $validator->errors(),
                ], 400);
            }

            // $training = Training::where('id', $request->id)->with('province', 'amphure', 'district')->first();

            // if($training==null){
            //     return response()->json([
            //     'status' => false,
            //     'message' => 'Not Found Training'
            // ], 400);
            // }

            $turn_id = TrainingTurn::where('id', $request->id)->orderby('turn', 'desc')->first();

            if($turn_id==null){
                return response()->json([
                'status' => false,
                'message' => 'Not Found TrainingTurn'
            ], 400);
            }

            $turn_list = TrainingList::where('user_id', $request->user_id)->where('turn_id', $request->id)->get();

            foreach ($turn_list as $traning_list) {
                $list = TrainingList::find($traning_list->id);
                $list->status_approve = $request->status;
                $list->save();
            }

            return response()->json([
                'status' => true,
                'message' => 'Success!',
                'data' => [
                    // 'training' => $training,
                    'list' => $turn_list,
                ]
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Not Found Training'
            ], 400);
        }

        } catch (Exception $e) {
                Log::error($e->getMessage());
                return response()->json([
                    'result' => [],
                    'status' => false,
                    'message' => $e->getMessage(),
                ], 400);
            }
    }


    // trainning




    ///NOtification///
    public function api_noti_add(Request $r)
    {

        $item = new noti();

        if ($r->id_user != null) {
            $item->id_user = $r->id_user;
        }
        if ($r->id_customer != null) {
            $item->id_customer = $r->id_customer;
        }
        if ($r->id_work != null) {
            $item->id_work = $r->id_work;
        }
        if ($r->title != null) {
            $item->titleth = $r->title;
        }
        if ($r->detail != null) {
            $item->detailth = $r->detail;
        }
        if ($r->status != null) {
            $item->status = $r->status;
        }

        $item->save();

        $message = "Success!";
        $status = true;
        return response()->json([
            'results' => [
                'item' => $item,
            ],
            'status' =>  $status,
            'message' =>  $message,
            'url_picture' => $this->prefix,
        ]);
    }
    ///NOtification///

    ///NOtification GET///
    public function api_noti($id)
    {
        $item = noti::where('id_user', $id)->orwhere('id_user', null)->orderby('id', 'desc')->get();

        $message = "Success!";
        $status = true;
        return response()->json([
            'results' => [
                'item' => $item,
            ],
            'status' =>  $status,
            'message' =>  $message,
            'url_picture' => $this->prefix,
        ]);
    }
    ///NOtification GET///


    ///NOtification GET ALL///
    public function api_noti_all()
    {
        $item = noti::orderby('id', 'desc')->get();

        $message = "Success!";
        $status = true;
        return response()->json([
            'results' => [
                'item' => $item,
            ],
            'status' =>  $status,
            'message' =>  $message,
            'url_picture' => $this->prefix,
        ]);
    }
    ///NOtification GET ALL///



    ///province///
    public function api_province(Request $r)
    {

        $ps = 'select name_th,id,name_en,code
                FROM tb_province
                ORDER BY
                CONVERT ( name_th USING tis620 ) ASC';

        $province =  DB::select($ps);


        $message = "Success!";
        $status = true;
        return response()->json([
            'results' => [
                'province' => $province,
            ],
            'status' =>  $status,
            'message' =>  $message,
            'url_picture' => $this->prefix,
        ]);
    }
    ///province///





    ///amupur///
    public function api_amupur(Request $r)
    {

        if ($r->code != null) {
            $as = 'select name_th,id,name_en,code,province_id
            FROM tb_amupur
            WHERE  province_id = ' . $r->code . '
            ORDER BY
            CONVERT ( name_th USING tis620 ) ASC';
        } else {
            $as = 'select name_th,id,name_en,code,province_id
            FROM tb_amupur
            ORDER BY
            CONVERT ( name_th USING tis620 ) ASC';
        }

        $amphur =  DB::select($as);


        $message = "Success!";
        $status = true;
        return response()->json([
            'results' => [
                'amphur' => $amphur,
            ],
            'status' =>  $status,
            'message' =>  $message,
            'url_picture' => $this->prefix,
        ]);
    }
    ///amupur///


    ///district///
    public function api_district(Request $r)
    {

        if ($r->id != null) {
            $ds = 'select name_th,id,name_en,amphure_id,zip_code
                  FROM tb_districts
                  WHERE  amphure_id = ' . $r->id . '
                  ORDER BY
                  CONVERT ( name_th USING tis620 ) ASC';
        } else {
            $ds = 'select name_th,id,name_en,amphure_id,zip_code
            FROM tb_districts
            ORDER BY
            CONVERT ( name_th USING tis620 ) ASC';
        }

        $district =  DB::select($ds);


        $message = "Success!";
        $status = true;
        return response()->json([
            'results' => [
                'district' => $district,
            ],
            'status' =>  $status,
            'message' =>  $message,
            'url_picture' => $this->prefix,
        ]);
    }
    ///district///




    ///--------api_forget_pass---------///
    public function api_forget_pass(Request $r)
    {
        $user = User::where('email', $r->email)->first();

        if ($user != null) {

            $length = 12;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            $rand_num = $randomString;
            $user->forgot_code = $rand_num;
            $user->save();

            $link = url('forget_pass') . '1/' . $rand_num;
            $email = $user->email;



            $forget_mail = new Forget_email([
                'link' => $link,
                'email' => $email,

            ]);

            Mail::to($user->email)->send($forget_mail);


            $status = true;
            $message = "Success!";
            return response()->json([
                'results' => [
                    'user' => $user,
                ],
                'status' => $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        } else {
            $status = false;
            $message = "Email Wrong!";
            return response()->json([
                'results' => [
                    'user' => $user,
                ],
                'status' => $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        }
    }
    ///----------------///


    ///air_list///
    public function api_air_list($id)
    {
        $air_list = Air_listModel::where('model', $id)->first();

        if ($air_list != null) {
            $message = "Success!";
            $status = true;
            return response()->json([
                'results' => [
                    'air_list' => $air_list,
                ],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        } else {
            $message = "Not Have Models!";
            $status = true;
            return response()->json([
                'results' => [],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        }
    }
    ///air_list///



    ///air_listcheck1///
    public function api_air_list_check1(Request $r)
    {
        $air_list = Air_listModel::where('model', $r->model)->first();
        $wo = WO::where('id', $r->id_work)->first();

        if ($air_list != null and $wo != null) {

            $cc = Wo_air_checkModel::where('id_wo', $wo->id)->first();
            if ($cc == null) {
                $cc = new Wo_air_checkModel();
                $cc->id_wo = $wo->id;
                $cc->model = $r->model;
            }

            if ($r->check1 != null) {
                if ($r->check1 >= $air_list->min1 and $r->check1 <= $air_list->max1) {
                    $sum1 = 'ปกติ';
                } else {
                    $sum1 = 'ผิดปกติ';
                }
                $r1 = $r->check1 . '-' . $sum1;
                $cc->min1 = $r1;
            } else {
                $sum1 = null;
            }

            if ($r->check2 != null) {
                if ($r->check2 >= $air_list->min1 and $r->check2 <= $air_list->max1) {
                    $sum2 = 'ปกติ';
                } else {
                    $sum2 = 'ผิดปกติ';
                }
                $r2 = $r->check2 . '-' . $sum2;
                $cc->stan1 = $r2;
            } else {
                $sum2 = null;
            }


            if ($r->check3 != null) {
                if ($r->check3 >= $air_list->min1 and $r->check3 <= $air_list->max1) {
                    $sum3 = 'ปกติ';
                } else {
                    $sum3 = 'ผิดปกติ';
                }
                $r3 = $r->check3 . '-' . $sum3;
                $cc->max1 = $r3;
            } else {
                $sum3 = null;
            }

            $cc->save();

            $wo->status_air_check = 'มีการตรวจสอบแล้ว';
            $wo->save();

            $message = "Success!";
            $status = true;
            return response()->json([
                'results' => [
                    'air_list' => $air_list,
                    'sum1' => $sum1,
                    'sum2' => $sum2,
                    'sum3' => $sum3,
                ],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        } else {
            $message = "Not Have Models or Work!";
            $status = true;
            return response()->json([
                'results' => [],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        }
    }
    ///air_listcheck1///


    ///air_listcheck2///
    public function api_air_list_check2(Request $r)
    {
        $air_list = Air_listModel::where('model', $r->model)->first();
        $wo = WO::where('id', $r->id_work)->first();

        if ($air_list != null and $wo != null) {

            $cc = Wo_air_checkModel::where('id_wo', $wo->id)->first();
            if ($cc == null) {
                $cc = new Wo_air_checkModel();
                $cc->id_wo = $wo->id;
                $cc->model = $r->model;
            }

            if ($r->check1 != null) {
                if ($r->check1 >= $air_list->min2 and $r->check1 <= $air_list->max2) {
                    $sum1 = 'ปกติ';
                } else {
                    $sum1 = 'ผิดปกติ';
                }
                $r1 = $r->check1 . '-' . $sum1;
                $cc->min2 = $r1;
            } else {
                $sum1 = null;
            }

            if ($r->check2 != null) {
                if ($r->check2 >= $air_list->min2 and $r->check2 <= $air_list->max2) {
                    $sum2 = 'ปกติ';
                } else {
                    $sum2 = 'ผิดปกติ';
                }
                $r2 = $r->check2 . '-' . $sum2;
                $cc->stan2 = $r2;
            } else {
                $sum2 = null;
            }


            if ($r->check3 != null) {
                if ($r->check3 >= $air_list->min2 and $r->check3 <= $air_list->max2) {
                    $sum3 = 'ปกติ';
                } else {
                    $sum3 = 'ผิดปกติ';
                }
                $r3 = $r->check3 . '-' . $sum3;
                $cc->max2 = $r3;
            } else {
                $sum3 = null;
            }

            $cc->save();

            $wo->status_air_check = 'มีการตรวจสอบแล้ว';
            $wo->save();

            $message = "Success!";
            $status = true;
            return response()->json([
                'results' => [
                    'air_list' => $air_list,
                    'sum1' => $sum1,
                    'sum2' => $sum2,
                    'sum3' => $sum3,
                ],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        } else {
            $message = "Not Have Models or Work!";
            $status = true;
            return response()->json([
                'results' => [],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        }
    }
    ///air_listcheck2///



    ///air_listcheck3///
    public function api_air_list_check3(Request $r)
    {
        $air_list = Air_listModel::where('model', $r->model)->first();
        $wo = WO::where('id', $r->id_work)->first();

        if ($air_list != null and $wo != null) {

            $cc = Wo_air_checkModel::where('id_wo', $wo->id)->first();
            if ($cc == null) {
                $cc = new Wo_air_checkModel();
                $cc->id_wo = $wo->id;
                $cc->model = $r->model;
            }

            if ($r->check1 != null) {
                if ($r->check1 >= $air_list->min3 and $r->check1 <= $air_list->max3) {
                    $sum1 = 'ปกติ';
                } else {
                    $sum1 = 'ผิดปกติ';
                }
                $r1 = $r->check1 . '-' . $sum1;
                $cc->min3 = $r1;
            } else {
                $sum1 = null;
            }

            if ($r->check2 != null) {
                if ($r->check2 >= $air_list->min3 and $r->check2 <= $air_list->max3) {
                    $sum2 = 'ปกติ';
                } else {
                    $sum2 = 'ผิดปกติ';
                }
                $r2 = $r->check2 . '-' . $sum2;
                $cc->stan3 = $r2;
            } else {
                $sum2 = null;
            }


            if ($r->check3 != null) {
                if ($r->check3 >= $air_list->min3 and $r->check3 <= $air_list->max3) {
                    $sum3 = 'ปกติ';
                } else {
                    $sum3 = 'ผิดปกติ';
                }
                $r3 = $r->check3 . '-' . $sum3;
                $cc->max3 = $r3;
            } else {
                $sum3 = null;
            }

            $cc->save();

            $wo->status_air_check = 'มีการตรวจสอบแล้ว';
            $wo->save();

            $message = "Success!";
            $status = true;
            return response()->json([
                'results' => [
                    'air_list' => $air_list,
                    'sum1' => $sum1,
                    'sum2' => $sum2,
                    'sum3' => $sum3,
                ],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        } else {
            $message = "Not Have Models or Work!";
            $status = true;
            return response()->json([
                'results' => [],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        }
    }
    ///air_listcheck3///




    ///air_listcheck4///
    public function api_air_list_check4(Request $r)
    {
        $air_list = Air_listModel::where('model', $r->model)->first();
        $wo = WO::where('id', $r->id_work)->first();

        if ($air_list != null and $wo != null) {

            $cc = Wo_air_checkModel::where('id_wo', $wo->id)->first();
            if ($cc == null) {
                $cc = new Wo_air_checkModel();
                $cc->id_wo = $wo->id;
                $cc->model = $r->model;
            }

            if ($r->check1 != null) {
                if ($r->check1 >= $air_list->min4 and $r->check1 <= $air_list->max4) {
                    $sum1 = 'ปกติ';
                } else {
                    $sum1 = 'ผิดปกติ';
                }
                $r1 = $r->check1 . '-' . $sum1;
                $cc->min4 = $r1;
            } else {
                $sum1 = null;
            }

            if ($r->check2 != null) {
                if ($r->check2 >= $air_list->min4 and $r->check2 <= $air_list->max4) {
                    $sum2 = 'ปกติ';
                } else {
                    $sum2 = 'ผิดปกติ';
                }
                $r2 = $r->check2 . '-' . $sum2;
                $cc->stan4 = $r2;
            } else {
                $sum2 = null;
            }


            if ($r->check3 != null) {
                if ($r->check3 >= $air_list->min4 and $r->check3 <= $air_list->max4) {
                    $sum3 = 'ปกติ';
                } else {
                    $sum3 = 'ผิดปกติ';
                }
                $r3 = $r->check3 . '-' . $sum3;
                $cc->max4 = $r3;
            } else {
                $sum3 = null;
            }

            $cc->save();

            $wo->status_air_check = 'มีการตรวจสอบแล้ว';
            $wo->save();

            $message = "Success!";
            $status = true;
            return response()->json([
                'results' => [
                    'air_list' => $air_list,
                    'sum1' => $sum1,
                    'sum2' => $sum2,
                    'sum3' => $sum3,
                ],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        } else {
            $message = "Not Have Models or Work!";
            $status = true;
            return response()->json([
                'results' => [],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        }
    }
    ///air_listcheck4///




    ///air_listcheck5///
    public function api_air_list_check5(Request $r)
    {
        $air_list = Air_listModel::where('model', $r->model)->first();
        $wo = WO::where('id', $r->id_work)->first();

        if ($air_list != null and $wo != null) {

            $cc = Wo_air_checkModel::where('id_wo', $wo->id)->first();
            if ($cc == null) {
                $cc = new Wo_air_checkModel();
                $cc->id_wo = $wo->id;
                $cc->model = $r->model;
            }

            if ($r->check1 != null) {
                if ($r->check1 >= $air_list->min5 and $r->check1 <= $air_list->max5) {
                    $sum1 = 'ปกติ';
                } else {
                    $sum1 = 'ผิดปกติ';
                }
                $r1 = $r->check1 . '-' . $sum1;
                $cc->min5 = $r1;
            } else {
                $sum1 = null;
            }

            if ($r->check2 != null) {
                if ($r->check2 >= $air_list->min5 and $r->check2 <= $air_list->max5) {
                    $sum2 = 'ปกติ';
                } else {
                    $sum2 = 'ผิดปกติ';
                }
                $r2 = $r->check2 . '-' . $sum2;
                $cc->stan5 = $r2;
            } else {
                $sum2 = null;
            }


            if ($r->check3 != null) {
                if ($r->check3 >= $air_list->min5 and $r->check3 <= $air_list->max5) {
                    $sum3 = 'ปกติ';
                } else {
                    $sum3 = 'ผิดปกติ';
                }
                $r3 = $r->check3 . '-' . $sum3;
                $cc->max5 = $r3;
            } else {
                $sum3 = null;
            }

            $cc->save();

            $wo->status_air_check = 'มีการตรวจสอบแล้ว';
            $wo->save();

            $message = "Success!";
            $status = true;
            return response()->json([
                'results' => [
                    'air_list' => $air_list,
                    'sum1' => $sum1,
                    'sum2' => $sum2,
                    'sum3' => $sum3,
                ],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        } else {
            $message = "Not Have Models or Work!";
            $status = true;
            return response()->json([
                'results' => [],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        }
    }
    ///air_listcheck5///



    ///air_listcheck6///
    public function api_air_list_check6(Request $r)
    {
        $air_list = Air_listModel::where('model', $r->model)->first();
        $wo = WO::where('id', $r->id_work)->first();

        if ($air_list != null and $wo != null) {

            $cc = Wo_air_checkModel::where('id_wo', $wo->id)->first();
            if ($cc == null) {
                $cc = new Wo_air_checkModel();
                $cc->id_wo = $wo->id;
                $cc->model = $r->model;
            }

            if ($r->check1 != null) {
                if ($r->check1 >= $air_list->min6 and $r->check1 <= $air_list->max6) {
                    $sum1 = 'ปกติ';
                } else {
                    $sum1 = 'ผิดปกติ';
                }
                $r1 = $r->check1 . '-' . $sum1;
                $cc->min6 = $r1;
            } else {
                $sum1 = null;
            }

            if ($r->check2 != null) {
                if ($r->check2 >= $air_list->min6 and $r->check2 <= $air_list->max6) {
                    $sum2 = 'ปกติ';
                } else {
                    $sum2 = 'ผิดปกติ';
                }
                $r2 = $r->check2 . '-' . $sum2;
                $cc->stan6 = $r2;
            } else {
                $sum2 = null;
            }


            if ($r->check3 != null) {
                if ($r->check3 >= $air_list->min6 and $r->check3 <= $air_list->max6) {
                    $sum3 = 'ปกติ';
                } else {
                    $sum3 = 'ผิดปกติ';
                }
                $r3 = $r->check3 . '-' . $sum3;
                $cc->max6 = $r3;
            } else {
                $sum3 = null;
            }

            $cc->save();

            $wo->status_air_check = 'มีการตรวจสอบแล้ว';
            $wo->save();

            $message = "Success!";
            $status = true;
            return response()->json([
                'results' => [
                    'air_list' => $air_list,
                    'sum1' => $sum1,
                    'sum2' => $sum2,
                    'sum3' => $sum3,
                ],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        } else {
            $message = "Not Have Models or Work!";
            $status = true;
            return response()->json([
                'results' => [],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        }
    }
    ///air_listcheck1///






    // PDF WORK
    public function api_pdf_work($id)
    {
        $papersize = array(0, 0, 1000, 205);
        $pdf = PDF::loadview('pdf_work', ['id' => $id], [], [
            'orientation' => 'P',
            'format' => [58, 1000]
        ]);
        return @$pdf->stream();
    }
    // PDF WORK


    ///otp_register///
    public function api_otp_register(Request $r)
    {
        $phone = $r->phone;
        $pass_check = $r->pass_check;
        $datenow = date('Y-m-d H:i:s');
        $otp = rand(1000, 9999);

        $check = OTP::where('phone', $phone)->first();
        $check = OTP::where('phone', $phone)->first();

        if ($check != null) {
            if ($datenow > $check->endtime) {
                $ot = OTP::where('id', $check->id)->first();
                $date = Carbon::createFromFormat('Y-m-d H:i:s', $datenow);
                $endtime = $date->addMinutes(5)->format('Y-m-d H:i:s');

                $ot->phone = $phone;
                $ot->otp = $otp;
                $ot->pass_check = $pass_check;
                $ot->endtime = $endtime;
                $ot->save();
            } else {
                $otp = $check->otp;
                $pass_check = $check->pass_check;
            }
        } else {
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $datenow);
            $endtime = $date->addMinutes(5)->format('Y-m-d H:i:s');


            $ot = new OTP;
            $ot->phone = $phone;
            $ot->otp = $otp;
            $ot->pass_check = $pass_check;
            $ot->endtime = $endtime;
            $ot->save();
        }


        try {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://thsms.com/api/send-sms',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
            "sender": "MitsuHeavy",
            "msisdn": ["' . $phone . '"],
            "message": "รหัส OTP ของคุณคือ ' . $otp . ' รหัสอ้างอิง ' . $pass_check . ' รหัสมีอายุการใช้งาน 5 นาที ห้ามบอก OTP นี้แก่ผู้อื่นไม่ว่ากรณีใด"
            }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC90aHNtcy5jb21cL21hbmFnZVwvYXBpLWtleSIsImlhdCI6MTY4NzQ5MjI5MSwibmJmIjoxNjg3NDkyMjkxLCJqdGkiOiJYb2t4enZWMEJIa2NEUm1PIiwic3ViIjoxMDk5NzIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.R_YjpLEyW5wS7DRiTMBG7IEx1D-aKMgfIhHDK-7WMyw',
                ),

            ));

            $response = curl_exec($curl);
            curl_close($curl);

            $message = "Success!";
            $status = true;
            return response()->json([
                'results' => [
                    'otp' => $otp,
                    'phone' => $phone,
                    'pass_check' => $pass_check,

                    'data' => $response,
                ],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        } catch (\Exception $e) {
            $message = "Error.";
            $status = false;
            return response()->json([
                'results' => [],
                'status' =>  $status,
                'message' =>  $message,

                'otp' => $otp,
                'phone' => $phone,
                'pass_check' => $pass_check,

                'url_picture' => $this->prefix,
            ], 400);
        }
    }
    ///otp_register///






    ///user///
    public function api_user($id)
    {
        $user = User::where('id', $id)->first();

        $message = "Success!";
        $status = true;
        return response()->json([
            'results' => [
                'user' => $user,
            ],
            'status' =>  $status,
            'message' =>  $message,
            'url_picture' => $this->prefix,
        ]);
    }
    ///user///






    ///air_model///
    public function api_air_model()
    {
        $air_model = AirModel::orderby('model_name', 'asc')->get();

        $message = "Success!";
        $status = true;
        return response()->json([
            'results' => [
                'air_model' => $air_model,
            ],
            'status' =>  $status,
            'message' =>  $message,
            'url_picture' => $this->prefix,
        ]);
    }
    ///air_model///



    ///WORK///
    public function api_work()
    {
        $wo = WO::where('technician_id', null)->where('d_status', 0)->with('customer')->with('model')->orderby('wo_date', 'desc')->get();

        $message = "Success!";
        $status = true;
        return response()->json([
            'results' => [
                'wo' => $wo,
            ],
            'status' =>  $status,
            'message' =>  $message,
            'url_picture' => $this->prefix,
        ]);
    }
    ///WORK///


    ///WORK_item///
    public function api_work_item($id)
    {
        $wo = WO::where('id', $id)->where('d_status', 0)->with('customer')->with('model')->first();
        $item = WO_item::where('id_wo', $id)->get();

        $message = "Success!";
        $status = true;
        return response()->json([
            'results' => [
                'wo' => $wo,
                'item' => $item,
            ],
            'status' =>  $status,
            'message' =>  $message,
            'url_picture' => $this->prefix,
        ]);
    }
    ///WORK_item///

    ///WORK_item///
    public function api_work_item_add(Request $r)
    {

        $item = new WO_item();
        $item->id_wo = $r->id_work;
        $item->title = $r->title;
        $item->number = $r->number;
        $item->value = $r->value;

        $item->status = $r->status;

        $item->save();

        $message = "Success!";
        $status = true;
        return response()->json([
            'results' => [
                'item' => $item,
            ],
            'status' =>  $status,
            'message' =>  $message,
            'url_picture' => $this->prefix,
        ]);
    }
    ///WORK_item///


    ///WORK_item///
    public function api_work_item_delete(Request $r)
    {
        $item = WO_item::where('id', $r->id)->where('d_status', 0)->first();

        if ($item->status == 0) {
            $item->status = 1;
            $item->save();
        } else {
            $item->status = 0;
            $item->save();
        }

        $message = "Success!";
        $status = true;
        return response()->json([
            'results' => [
                'item' => $item,
            ],
            'status' =>  $status,
            'message' =>  $message,
            'url_picture' => $this->prefix,
        ]);
    }
    ///WORK_item///


    ///WORK ITEM SUBMIT///
    public function api_work_item_submit(Request $r)
    {
        $item = WO::where('id', $r->id)->where('d_status', 0)->first();
        // $all=App\WO_item::where('id_wo',$r->id)->where('status',0)->sum('value');
        // $rr=$item->wo_price;
        // $rs=$rr+$all;
        // $item->service_item_price = $rs;
        $item->service_item_price = $r->sum;
        $item->save();

        $message = "Success!";
        $status = true;
        return response()->json([
            'results' => [
                'item' => $item,
            ],
            'status' =>  $status,
            'message' =>  $message,
            'url_picture' => $this->prefix,
        ]);
    }
    ///WORK ITEM SUBMIT///


    ///WORK DETAIL///
    public function api_work_detail($id)
    {
        $wo = WO::where('id', $id)->where('d_status', 0)->with('customer')->with('model')->first();

        $message = "Success!";
        $status = true;
        return response()->json([
            'results' => [
                'wo' => $wo,
            ],
            'status' =>  $status,
            'message' =>  $message,
            'url_picture' => $this->prefix,
        ]);
    }
    ///WORK DETAIL///



    ///WORK งานที่รับของแต่ละคน///
    public function api_work_list(Request $r)
    {
        $date = date('Y-m-d');
        $date_a = date('Y-m-d', strtotime($date . ' + 7 days'));
        if ($r->date == null or $r->date == "null") {
            $wo = WO::where('technician_id', '!=', null)->where('technician_id', $r->id)->wheredate('wo_date', '>=', $date)
                ->wheredate('wo_date', '<=', $date_a)
                ->where('d_status', 0)->with('customer')->with('model')->orderby('wo_time', 'asc')->get();
        } else {
            $date = $r->date;
            $wo = WO::where('technician_id', '!=', null)->where('technician_id', $r->id)->wheredate('wo_date', $date)->where('d_status', 0)->with('customer')->with('model')->orderby('wo_time', 'asc')->get();
        }

        $message = "Success!";
        $status = true;
        return response()->json([
            'results' => [
                'wo' => $wo,
                'date' => $date,
            ],
            'status' =>  $status,
            'message' =>  $message,
            'url_picture' => $this->prefix,
        ]);
    }
    ///WORK งานที่รับของแต่ละคน///





    ///WORK submit///
    public function api_work_submit(Request $r)
    {
        $wo = WO::where('id', $r->id_work)->where('d_status', 0)->with('customer')->with('model')->first();

        if ($wo->technician_id == null) {

            if ($wo->technician_id == null) {
                $wo->technician_id = $r->id;
                $wo->save();

                $aaa = new noti();
                $aaa->id_user = $r->id;
                $aaa->id_work = $wo->id;

                $aaa->titleth = 'คุณรับงานสำเร็จ หมายเลขงาน/' . $wo->wo_number;
                $aaa->detailth = 'คุณรับงานสำเร็จแล้ว';

                $aaa->save();
            } else {
                $message = "Someone already took this job.";
                $status = false;
                return response()->json([
                    'results' => [],
                    'status' =>  $status,
                    'message' =>  $message,
                    'url_picture' => $this->prefix,
                ], 400);
            }
        } else {
            $message = "Someone already took this job.";
            $status = false;
            return response()->json([
                'results' => [],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ], 400);
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://heavyoneclick.com:3000/updateRealtime',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;

        $message = "Success!";
        $status = true;
        return response()->json([
            'results' => [
                'wo' => $wo,
            ],
            'status' =>  $status,
            'message' =>  $message,
            'url_picture' => $this->prefix,
        ]);
    }
    ///WORK submit///






    ///END WORK///
    public function api_end_work(Request $r)
    {
        $wo = wo::where('id', $r->id)->where('d_status', 0)->with('customer')->with('model')->first();
        if ($wo != null) {

            if ($r->wo_status != null) {
                $wo->wo_status = $r->wo_status;
            }
            if ($r->wo_time_end != null) {
                $wo->wo_time_end = $r->wo_time_end;
            }
            if ($r->wo_remark != null) {
                $wo->wo_remark = $r->wo_remark;
            }
            if ($r->review != null) {
                $wo->review = $r->review;
            }

            if ($r->wo_picture != null) {
                if (!$r->hasFile('wo_picture')) {
                    return response()->json(['upload_file_not_found'], 400);
                }
                $file = $r->file('wo_picture');
                if (!$file->isValid()) {
                    return response()->json(['invalid_file_upload'], 400);
                }
                $fileName = $_FILES['wo_picture']['name'];
                $fileName = date('YmdHis') . '_' . $fileName;
                $filePath = 'file/upload/' . $fileName;
                Storage::disk('s3')->put($filePath, file_get_contents($file));
                $wo->wo_picture = $fileName;
            }

            if ($r->pic_before != null) {
                if (!$r->hasFile('pic_before')) {
                    return response()->json(['upload_file_not_found'], 400);
                }
                $file = $r->file('pic_before');
                if (!$file->isValid()) {
                    return response()->json(['invalid_file_upload'], 400);
                }
                $fileName = $_FILES['pic_before']['name'];
                $fileName = date('YmdHis') . '_' . $fileName;
                $filePath = 'file/upload/' . $fileName;
                Storage::disk('s3')->put($filePath, file_get_contents($file));
                $wo->pic_before = $fileName;
            }

            if ($r->pic_before2 != null) {
                if (!$r->hasFile('pic_before2')) {
                    return response()->json(['upload_file_not_found'], 400);
                }
                $file = $r->file('pic_before2');
                if (!$file->isValid()) {
                    return response()->json(['invalid_file_upload'], 400);
                }
                $fileName = $_FILES['pic_before2']['name'];
                $fileName = date('YmdHis') . '_' . $fileName;
                $filePath = 'file/upload/' . $fileName;
                Storage::disk('s3')->put($filePath, file_get_contents($file));
                $wo->pic_before2 = $fileName;
            }

            if ($r->pic_after != null) {
                if (!$r->hasFile('pic_after')) {
                    return response()->json(['upload_file_not_found'], 400);
                }
                $file = $r->file('pic_after');
                if (!$file->isValid()) {
                    return response()->json(['invalid_file_upload'], 400);
                }
                $fileName = $_FILES['pic_after']['name'];
                $fileName = date('YmdHis') . '_' . $fileName;
                $filePath = 'file/upload/' . $fileName;
                Storage::disk('s3')->put($filePath, file_get_contents($file));
                $wo->pic_after = $fileName;
            }

            if ($r->pic_after2 != null) {
                if (!$r->hasFile('pic_after2')) {
                    return response()->json(['upload_file_not_found'], 400);
                }
                $file = $r->file('pic_after2');
                if (!$file->isValid()) {
                    return response()->json(['invalid_file_upload'], 400);
                }
                $fileName = $_FILES['pic_after2']['name'];
                $fileName = date('YmdHis') . '_' . $fileName;
                $filePath = 'file/upload/' . $fileName;
                Storage::disk('s3')->put($filePath, file_get_contents($file));
                $wo->pic_after2 = $fileName;
            }

            $wo->save();


            if ($r->review != null) {
                $star = WO::where('technician_id', $wo->technician_id)->where('d_status', 0)->where('wo_status', 1)->where('wo_time_end', '!=', null)
                    ->selectRaw('SUM(review)/COUNT(id) AS avg_rating')->first()->avg_rating;
                if ($star == null or $star == 0) {
                    $star = 5;
                }
                $rrr = User::where('id', $wo->technician_id)->first();
                if ($rrr != null) {
                    $rrr->rate = $star;
                    $rrr->save();
                }
            }

            $message = "Success!";
            $status = true;
            return response()->json([
                'results' => [
                    'wo' => $wo,
                ],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        } else {
            $message = "There is an ID on the server!";
            $status = false;
            return response()->json([
                'results' => [],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ], 400);
        }
    }
    ///END WORK///









    ///Register  User///
    public function api_register_user(Request $r)
    {

        try{
        // CHECK OTP  เพิ่มรับค่า otp มาเช็ค
        $dff = date('Y-m-d H:i:s');
        $otp = OTP::where('phone', $r->phone)->first();
        if ($otp == null) {
            $message = "OTP Phonenumber Wrong!";
            $status = false;
            return response()->json([
                'results' => [],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ], 400);
        } else {
            if ($otp->otp != $r->otp) {
                $message = "OTP Wrong!";
                $status = false;
                return response()->json([
                    'results' => [],
                    'status' =>  $status,
                    'message' =>  $message,
                    'url_picture' => $this->prefix,
                ], 400);
            } else {
                if ($dff > $otp->endtime) {
                    $message = "OTP out of time!";
                    $status = false;
                    return response()->json([
                        'results' => [],
                        'status' =>  $status,
                        'message' =>  $message,
                        'url_picture' => $this->prefix,
                    ], 400);
                }
            }
        }
        // CHECK OTP  เพิ่มรับค่า otp มาเช็ค

        $year = date('Y');
        $check = User::where('email', $r->email)->first();
        if ($check == null) {
            $user = new User();
            $user->name = $r->name;
            $user->email = $r->email;

            if ($r->password == null) {
                if ($r->phone != null) {
                    $na = $r->phone;
                } else {
                    $na = $r->name . '12345';
                }
                $user->password = Hash::make($na);
            } else {
                $na = $r->password;
                $user->password = Hash::make($r->password);
            }

            $user->type = 5;
            $user->status = 0;

            $user->lastname = $r->lastname;
            $user->phone = $r->phone;

            // MARKET
            $user->market = $r->market;
            $mm = market::where('titleth', $r->market)->first();
            if ($mm) {
                $user->id_market = $mm->id;
            }
            // MARKET

            $length = 12;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $cm = User::where('token', $randomString)->first();
            if ($cm != null) {
                $length = 12;
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
            }
            $cmm = User::where('token', $randomString)->first();
            if ($cmm != null) {
                $length = 12;
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
            }

            $user->token = $randomString;

            $p = province::where('name_th', $r->province)->first();
            if ($p != null) {
                $user->province = $r->province;
                $user->id_p = $p->id;
            }

            // CODE
            $nu = User::where('type', 5)->orderby('id', 'desc')->first();
            if ($nu != null) {
                $nm = $nu->num + 1;
            } else {
                $nm = 1;
            }
            $idd=$nu->id+1;
            $user->num = $nm;
            // $ggg=$user->id;
            $ggg=$idd;

            // $num = str_pad($nm, 5, '0', STR_PAD_LEFT);
            $num = str_pad($ggg, 5, '0', STR_PAD_LEFT);
            $user->code = $year . 'H' . $num;
            // CODE



            $user->save();


            // ส่ง sms รหัส--------------
            if ($r->phone != null) {
                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://thsms.com/api/send-sms',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => '{
            "sender": "MitsuHeavy",
            "msisdn": ["' . $r->phone . '"],
            "message": "รหัส ID User ของคุณคือ ' . $r->email . ' รหัส Password ของคุณคือ  ' . $na . '"
            }',
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC90aHNtcy5jb21cL21hbmFnZVwvYXBpLWtleSIsImlhdCI6MTY4NzQ5MjI5MSwibmJmIjoxNjg3NDkyMjkxLCJqdGkiOiJYb2t4enZWMEJIa2NEUm1PIiwic3ViIjoxMDk5NzIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.R_YjpLEyW5wS7DRiTMBG7IEx1D-aKMgfIhHDK-7WMyw',
                    ),

                ));

                $response = curl_exec($curl);
                curl_close($curl);
            }
            // ส่ง sms รหัส--------------


            $message = "Register Success!";
            $status = true;
            return response()->json([
                'results' => [
                    'user' => $user,
                ],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        } else {
            $message = "There is an email on the server!";
            $status = false;
            return response()->json([
                'results' => [],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ], 400);
        }


      } catch (Exception $e) {
        return response()->json([
            'result' => [],
            'status' => false,
            'message' => $e->getMessage(),
        ], 400);
        }


    }
    ///Register  User///



    ///--------api_change_oldpass---------///
    public function api_change_password(Request $r)
    {
        $user = User::where('id', $r->id_user)->first();
        $check = Hash::make($r->old_pass);
        if (Hash::check($r->old_pass, $user->password)) {

            if ($r->new_pass == $r->new_pass_check) {
                $user = User::where('id', $r->id_user)->first();
                $make = Hash::make($r->new_pass);
                $user->password = $make;
                $user->save();

                $status = true;
                $message = "Success!";
                return response()->json([
                    'results' => [
                        'user' => $user,
                    ],
                    'status' => $status,
                    'message' =>  $message,
                    'url_picture' => $this->prefix,
                ]);
            } else {
                $status = false;
                $message = "Password Check do not match!";
                return response()->json([
                    'results' => [
                        'user' => $user,
                    ],
                    'status' => $status,
                    'message' =>  $message,
                    'url_picture' => $this->prefix,
                ], 400);
            }
        } else {
            $status = false;
            $message = "Old Password Wrong!";
            return response()->json([
                'results' => [
                    'user' => $user,
                ],
                'status' => $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ], 400);
        }
    }
    ///-----------------///



    ///EDIT  User///
    public function api_edit_user(Request $r)
    {
        $user = User::where('id', $r->id_user)->first();
        if ($user != null) {
            if ($r->market != null) {
                $user->market = $r->market;
            }
            //    ------------------
            if ($r->nickname != null) {
                $user->nickname = $r->nickname;
            }
            //    ------------------
            if ($r->name != null) {
                $user->name = $r->name;
            }
            if ($r->lastname != null) {
                $user->lastname = $r->lastname;
            }
            //    ------------------

            if ($r->email != null or $r->email != '-') {
                $check = User::where('id', '!=', $r->id_user)->where('email', $r->email)->first();
                if ($check == null) {
                    $user->email = $r->email;
                }
            }
            if ($r->phone != null) {
                $user->phone = $r->phone;
            }
            if ($r->line != null) {
                $user->line = $r->line;
            }
            //    ------------------

            if ($r->province != null) {
                $p = province::where('id', $r->province)->first();
                if ($p != null) {
                    $user->id_p = $r->province;
                    $user->province = @$p->name_th;
                }
            }
            if ($r->district != null) {
                $d = district::where('id', $r->district)->first();
                if ($d != null) {
                    $user->id_d = $r->district;
                    $user->district = @$d->name_th;
                }
            }
            if ($r->amphur != null) {
                $a = amphur::where('id', $r->amphur)->first();
                if ($a != null) {
                    $user->id_a = $r->amphur;
                    $user->amphur = @$a->name_th;
                }
            }
            if ($r->house != null) {
                $user->house = $r->house;
            }
            if ($r->moo != null) {
                $user->moo = $r->moo;
            }
            if ($r->condo != null) {
                $user->condo = $r->condo;
            }
            if ($r->road != null) {
                $user->road = $r->road;
            }
            if ($r->zipcode != null) {
                $user->zipcode = $r->zipcode;
            }

            //    ------------------

            if ($r->picture != null) {
                if (!$r->hasFile('picture')) {
                    return response()->json(['upload_file_not_found'], 400);
                }
                $file = $r->file('picture');
                if (!$file->isValid()) {
                    return response()->json(['invalid_file_upload'], 400);
                }
                $fileName = $_FILES['picture']['name'];
                $fileName = date('YmdHis') . '_' . $fileName;
                $filePath = 'file/upload/' . $fileName;
                Storage::disk('s3')->put($filePath, file_get_contents($file));
                $user->picture = $fileName;
            }



            $user->save();


            $message = "Success!";
            $status = true;
            return response()->json([
                'results' => [
                    'user' => $user,
                ],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        } else {
            $message = "There is an ID on the server!";
            $status = false;
            return response()->json([
                'results' => [],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ], 400);
        }
    }
    ///EDIT  User///





       ///เรียก  User /// 
       public function api_user_call(Request $r)
       {
           $user = User::where('id', $r->id_user)->first();
           if ($user != null) {
   
               $message = "Success!";
               $status = true;
               return response()->json([
                   'results' => [
                       'user' => $user,
                   ],
                   'status' =>  $status,
                   'message' =>  $message,
                   'url_picture' => $this->prefix,
               ]);
           } else {
               $message = "There is an ID on the server!";
               $status = false;
               return response()->json([
                   'results' => [],
                   'status' =>  $status,
                   'message' =>  $message,
                   'url_picture' => $this->prefix,
               ], 400);
           }
       }
       ///เรียก  User ///



     ///EDIT  User  ที่อยู่/// 
    public function api_edit_user_address(Request $r)
    {
        $user = User::where('id', $r->id_user)->first();
        if ($user != null) {

            if ($r->province != null) {
                $p = province::where('id', $r->province)->first();
                if ($p != null) {
                    $user->id_p = $r->province;
                    $user->province = @$p->name_th;
                }
            }
            if ($r->district != null) {
                $d = district::where('id', $r->district)->first();
                if ($d != null) {
                    $user->id_d = $r->district;
                    $user->district = @$d->name_th;
                }
            }
            if ($r->amphur != null) {
                $a = amphur::where('id', $r->amphur)->first();
                if ($a != null) {
                    $user->id_a = $r->amphur;
                    $user->amphur = @$a->name_th;
                }
            }
            if ($r->house != null) {
                $user->house = $r->house;
            }
            if ($r->moo != null) {
                $user->moo = $r->moo;
            }
            if ($r->condo != null) {
                $user->condo = $r->condo;
            }
            if ($r->road != null) {
                $user->road = $r->road;
            }
            if ($r->zipcode != null) {
                $user->zipcode = $r->zipcode;
            }
            $user->save();


            $message = "Success!";
            $status = true;
            return response()->json([
                'results' => [
                    'user' => $user,
                ],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        } else {
            $message = "There is an ID on the server!";
            $status = false;
            return response()->json([
                'results' => [],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ], 400);
        }
    }
    ///EDIT  User ที่อยู่///



    ///LOGIN  User///
    public function api_login_user(Request $r)
    {
        try {
            $check = User::where('email', $r->email)->where('type', 5)->first();
            if ($check) {
                $confirm = User::where('email', $r->email)->where('type', 5)->where('open', 0)->where('status', 1)->first();
                if ($confirm) {
                    if (!Hash::check($r->password, $confirm->password)) {
                        $password = "";
                    } else {
                        $password = User::where('email', $r->email)->where('type', 5)->first();
                    }
                    if ($password) {
                        $message = "Success";
                    } else {
                        $message = "Invalid Password";
                    }
                } else {
                    $message = "Not ConFirm Or User Are Close!";
                }
            } else {
                $message = "Invalid Email";
            }
            if ($message == "Success") {
                $status = true;
                return response()->json([
                    'results' => [
                        'user' => $password,
                    ],
                    'status' => $status,
                    'message' => $message,
                    'url_picture' => $this->prefix,

                ]);
            } else {
                $status = false;
                return response()->json([
                    'results' => [
                        'email' => $r->email, 'password' => $r->password,
                    ],
                    'status' => $status,
                    'message' => $message,
                    'url_picture' => $this->prefix,
                ], 400);
            }
        } catch (Exception $e) {
            return response()->json([
                'result' => [],
                'status' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }
    ///LOGIN  User///


    ///NEWS///
    public function api_news(Request $r)
    {
        $type = $r->type;

        if ($type == 'banner') {
            $news = news::orderby('id', 'desc')->limit(4)->get();
        } elseif ($type == 'new') {
            $news = news::orderby('id', 'desc')->limit(5)->get();
        } elseif ($type == 'advice') {
            $news = news::where('choose', 1)->orderby('id', 'desc')->get();
        } else {
            $news = news::orderby('id', 'desc')->paginate(
                9,
                ['*'],
                'page',
                $r->page
            );
        }

        $message = "Success!";
        $status = true;
        return response()->json([
            'results' => [
                'news' => $news,
                'page' => $r->page,
            ],
            'status' =>  $status,
            'message' =>  $message,
            'url_picture' => $this->prefix,
        ]);
    }
    ///NEWS///



    ///market///
    public function api_market()
    {
        $market = market::orderby('id', 'desc')->get();

        $message = "Success!";
        $status = true;
        return response()->json([
            'results' => [
                'market' => $market,
            ],
            'status' =>  $status,
            'message' =>  $message,
            'url_picture' => $this->prefix,
        ]);
    }
    ///market///


    ///item_point///
    public function api_item_point(Request $r)
    {
        $item_point = item_point::where('choose', 0)->orderby('id', 'desc')->paginate(
            9,
            ['*'],
            'page',
            $r->page
        );
        $item_point_choose = item_point::where('choose', 1)->orderby('id', 'desc')->get();
        $message = "Success!";
        $status = true;
        return response()->json([
            'results' => [
                'item_point' => $item_point,
                'item_point_choose' => $item_point_choose,
                'page' => $r->page,
            ],
            'status' =>  $status,
            'message' =>  $message,
            'url_picture' => $this->prefix,
        ]);
    }
    ///item_point///

    ///item_point_detail///
    public function api_item_point_detail(Request $r)
    {
        $item_point = item_point::where('id', $r->id)->orderby('id', 'desc')->first();

        $message = "Success!";
        $status = true;
        return response()->json([
            'results' => [
                'item_point' => $item_point,
            ],
            'status' =>  $status,
            'message' =>  $message,
            'url_picture' => $this->prefix,
        ]);
    }
    ///item_point_detail///



    ///Buy Item ///
    public function api_buy_item(Request $r)
    {

        try{
        $user = User::where('id', $r->id_user)->orderby('id', 'desc')->first();
        $item = item_point::where('id', $r->id_item)->orderby('id', 'desc')->first();

        $cu = $user->point;
        $ci = $item->point;
        if ($cu >= $ci) {
            $sum = $cu - $ci;
            $user->point = $sum;


            if($user->save()){
            $his = new buy_point();
            $his->id_user = $user->id;
            $his->id_item = $item->id;

            $his->title = $item->titleth;
            if($r->address!=null){
                $his->address = $r->address;
            }
            $his->old_point = $cu;
            $his->buy_point = $ci;
            $his->bl_point = $sum;
            $his->date = date('Y-m-d H:i:s');

            $length = 12;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            $rand_num = $randomString;
            $his->number = $rand_num;

            if($his->save()){

            }else{
            $uu = User::where('id', $r->id_user)->orderby('id', 'desc')->first();
            $uu->point = $cu;
            $uu->save();

            
            $add=new tb_log();
            $add->id_user=$user->id;
            $add->id_item=$item->id;
            $add->title='แลกแต้ม Log ล้มเหลว';
            $add->detail='แลกแต้ม ชื่อคนแลก '.$user->name.' แลกสินค้าชื่อ '.$item->titleth;
            $add->point=$ci;
            $add->old_point=$cu;
            $add->bl_point=$sum;

            if($add->save()){
                 $message = "Data Fail But Log Save!";
                $status = false;
                Log::channel('point_logs')->error('Data Fail But Log Save');
                return response()->json([
                    'results' => [
                        'item' => $item,
                        'user' => $user,
                    ],
                    'status' =>  $status,
                    'message' =>  $message,
                    'url_picture' => $this->prefix,
                ],400);
            }else{
                 $message = "Log Fail!";
                $status = false;
                Log::channel('point_logs')->error('Log Fail!');
                return response()->json([
                    'results' => [
                        'item' => $item,
                        'user' => $user,
                    ],
                    'status' =>  $status,
                    'message' =>  $message,
                    'url_picture' => $this->prefix,
                ], 400);
            }


            }

            }else{
                $message = "User Save Fail!";
                $status = false;
                Log::channel('point_logs')->error('User Save Fail!');
                return response()->json([
                    'results' => [
                        'item' => $item,
                        'user' => $user,
                    ],
                    'status' =>  $status,
                    'message' =>  $message,
                    'url_picture' => $this->prefix,
                ], 400);
            }

           

            $message = "Success!";
            $status = true;
            return response()->json([
                'results' => [
                    'item' => $item,
                    'user' => $user,
                ],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        } else {
            $message = "คะแนนของคุณไม่เพียงพอ";
            $status = false;
            Log::channel('point_logs')->error('คะแนนของคุณไม่เพียงพอ');
            return response()->json([
                'results' => [
                    'item' => $item,
                    'user' => $user,
                ],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ], 400);
        }


        } catch (Exception $e) {
        Log::error($e->getMessage());
        Log::channel('point_logs')->error($e->getMessage());

        $f=new tb_log();
        $f->id_user=$r->id_user;
        $f->id_item=$r->id_item;
        $f->title='Error Buy Item POINT';
        $f->detail=$e->getMessage();
        $f->save();

        return response()->json([
            'result' => [],
            'status' => false,
            'message' => $e->getMessage(),
        ], 400);
        }
    
    
    }
    ///Buy Item ///


    ///CHECK POINT ///
    public function api_check_point(Request $r)
    {
        $user = User::where('id', $r->id_user)->orderby('id', 'desc')->first();

        if ($user != null) {
            $point = $user->point;

            $message = "Success!";
            $status = true;
            return response()->json([
                'results' => [
                    'point' => $point,
                ],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        } else {
            $message = "Fail!";
            $status = false;
            return response()->json([
                'results' => [],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ], 400);
        }
    }
    ///CHECK POINT ///



    ///province///
    public function api_province_all()
    {

        $ps = 'select name_th,id,name_en
                FROM tb_province
                ORDER BY
                CONVERT ( name_th USING tis620 ) ASC';

        $ds = 'select name_th,id,name_en
                FROM tb_districts
                ORDER BY
                CONVERT ( name_th USING tis620 ) ASC';

        $as = 'select name_th,id,name_en
                FROM tb_amupur
                ORDER BY
                CONVERT ( name_th USING tis620 ) ASC';

        $province =  DB::select($ps);
        $district =  DB::select($ds);
        $amphur =  DB::select($as);


        $message = "Success!";
        $status = true;
        return response()->json([
            'results' => [
                'province' => $province,
                'district' => $district,
                'amphur' => $amphur,
            ],
            'status' =>  $status,
            'message' =>  $message,
            'url_picture' => $this->prefix,
        ]);
    }
    ///province///



    //===============  add air conditionner ==================//
    public function search_customer_name($mechanic_id, $name = null)
    {

        if ($name == null) {
            $get_customer = Customer::where('mechanic_id', $mechanic_id)->orderby('full_name', 'asc')->get();
        } else {
            $get_customer = Customer::where('mechanic_id', $mechanic_id)->where('full_name', 'like', '%' . $name . '%')->get();
        }

        if ($get_customer->count() != 0) {
            return response()->json([
                'status' => true,
                'message' => 'Success!',
                'result' => [
                    'customer' => $get_customer,
                ],
                'url_picture' => $this->prefix,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Not found',
            ], 400);
        }
    }

    public function get_customer($id)
    {
        $customer = Customer::where('id', $id)->with('airconditioner')->first();
        if (!empty($customer)) {
            return response()->json([
                'status' => true,
                'message' => 'Success!',
                'result' => [
                    'customer' => $customer,
                ],
                'url_picture' => $this->prefix,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'This information already exists.',
            ], 400);
        }
    }

    public function verify_customer(Request $request)
    {
        $find_customer = Customer::where('first_name', $request->first_name)->where('last_name', $request->last_name)->get();

        //Don't Have Customer values
        if ($find_customer->count() == 0) {
            $message = "This information is not yet available.";
            $status = true;
            return response()->json([
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        } else {
            $status = false;
            $message = 'This information already exists.';
            return response()->json([
                'status' => $status,
                'message' =>  $message,
                'message' => 'Error',
            ], 400);
        }
    }

    public function add_air_conditioner(Request $request)
    {

        try {
        //check customer
        $check_name_customer = Customer::where('mechanic_id', '!=', null)->where('first_name', $request->first_name)->where('last_name', $request->last_name)->get()->count();
        if ($check_name_customer != 0) {
            return response()->json([
                'status' => false,
                'message' => 'A Customer Name has already been taken.',
            ], 400);
        }

        $air_conditioner_validator = [
            'indoor_number' => 'nullable|unique:air_conditioners,indoor_number',
            'indoor_number' => 'nullable|unique:air_conditioners,outdoor_number',
            'outdoor_number' => 'required|unique:air_conditioners,indoor_number',
            'outdoor_number' => 'required|unique:air_conditioners,outdoor_number',
        ];

        $error_validator = [
            'indoor_number:unique' => 'มีข้อมูลนี้อยู่ในระบบแล้ว',
            'outdoor_number:unique' => 'มีข้อมูลนี้อยู่ในระบบแล้ว',
        ];

        $validator = Validator::make(
            $request->all(),
            $air_conditioner_validator,
            $error_validator
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 400);
        }

        //Find Serial number in database
        if ($request->indoor_number != null  && $request->indoor_number != '' && isset($request->indoor_number)) {
            $king1 = strlen($request->indoor_number);

            if ($king1 > 11) {
                $ca1 = substr($request->indoor_number, 0, -1);
            } else {
                $ca1 = $request->indoor_number;
            }

            $check_serial_indoor = DB::connection('pgsql')->table('serial_numbers')
                ->where('serial_number', $ca1)
                ->get()->count();
        }else{
            $ca1=null;
        }

        $king2 = strlen($request->outdoor_number);

        if ($king2 > 11) {
            $ca2 = substr($request->outdoor_number, 0, -1);
        } else {
            $ca2 = $request->outdoor_number;
        }

        $check_serial_outdoor = DB::connection('pgsql')->table('serial_numbers')
            ->where('serial_number', $ca2)
            ->get()->count();

        // if (isset($check_serial_indoor)) {
        //     if ($check_serial_indoor != 0 && $check_serial_outdoor != 0) {

        //         $customer = Customer::where('first_name', $request->first_name)
        //         ->where('last_name', $request->last_name)
        //         ->first();

        //         if($customer==null){
        //         $customer = new Customer();
        //         $customer->mechanic_id = $request->mechanic_id;
        //         $customer->first_name = $request->first_name;
        //         $customer->last_name = $request->last_name;
        //         $customer->full_name = $request->first_name . ' ' . $request->last_name;
        //         $customer->phone = $request->phone;
        //         $customer->line = $request->line;
        //         $customer->address = $request->address;
        //         $customer->more_address = $request->more_address;
        //         $customer->latitude = $request->latitude;
        //         $customer->longitude = $request->longitude;
        //         $customer->save();
        //         }else{
        //         $customer->mechanic_id = $request->mechanic_id;
        //         $customer->first_name = $request->first_name;
        //         $customer->last_name = $request->last_name;
        //         $customer->full_name = $request->first_name . ' ' . $request->last_name;
        //         $customer->phone = $request->phone;
        //         $customer->line = $request->line;
        //         $customer->address = $request->address;
        //         $customer->more_address = $request->more_address;
        //         $customer->latitude = $request->latitude;
        //         $customer->longitude = $request->longitude;
        //         $customer->save();
        //         }

        //         $air_conditioner = new AirConditioner();
        //         $air_conditioner->customer_id = $customer->id;
        //         $air_conditioner->indoor_number = $ca1;
        //         $air_conditioner->outdoor_number = $ca2;

        //         if ($air_conditioner->save()) {

        //              // ส่วนเช็ค Model รับ POINT
        //              $se = DB::connection('pgsql')->table('serial_numbers')
        //              ->where('serial_number', 'LIKE', '%'.$ca1.'%')
        //              // ->where('serial_number', $request->indoor_number)
        //              ->first();
        //              if($se!=null){
        //              if($customer!=null){
        //                  $air = AirModel::where('model_name',$se->product_code)->where('des',$se->product_name)->first();
        //                  if($air!=null){
        //                  $user = User::where('id', $customer->mechanic_id)->first();
        //                  if($user!=null){
        //                  $a1=$user->point;
        //                  $a2=$air->point;
        //                  $sum=$a1+$a2;
        //                  $user->point=$sum;
        //                  $user->save();

        //                  $his=new history_point();
        //                  $his->title='ได้รับ Point จากการทำรายการ';
        //                  $his->point=$a2;
        //                  $his->id_user=$user->id;
        //                  $his->date=date('Y-m-d H:i:s');
        //                  $his->save();

        //                  $air_conditioner->in_name = $air->des;
        //                  $air_conditioner->point = $air->point;
        //                  $air_conditioner->save();

        //                  return response()->json([
        //                      'status' => true,
        //                      'message' => 'Success Receive '.$a2.' Point!',
        //                      'url_picture' => $this->prefix,
        //                  ]);

        //                  }
        //              }}
        //              }
        //              // ส่วนเช็ค Model รับ POINT

        //             return response()->json([
        //                 'status' => true,
        //                 'message' => 'Success!',
        //                 'url_picture' => $this->prefix,
        //             ]);
        //         } else {
        //             return response()->json([
        //                 'status' => false,
        //                 'message' => 'Data cannot be saved!'
        //             ], 400);
        //         }
        //     } else {
        //         return response()->json([
        //             'status' => false,
        //             'message' => 'Not Found Air Conditioner in Data.'
        //         ], 400);
        //     }
        // } else {

           


        if ($check_serial_outdoor != 0) {

            $customer = Customer::where('first_name', $request->first_name)
                ->where('last_name', $request->last_name)
                ->first();

            if ($customer == null) {
                $customer = new Customer();
                $customer->mechanic_id = $request->mechanic_id;
                $customer->first_name = $request->first_name;
                $customer->last_name = $request->last_name;
                $customer->full_name = $request->first_name . ' ' . $request->last_name;
                $customer->phone = $request->phone;
                $customer->line = $request->line;
                $customer->address = $request->address;
                $customer->more_address = $request->more_address;
                $customer->latitude = $request->latitude;
                $customer->longitude = $request->longitude;
                $customer->save();
            } else {
                $customer->mechanic_id = $request->mechanic_id;
                $customer->first_name = $request->first_name;
                $customer->last_name = $request->last_name;
                $customer->full_name = $request->first_name . ' ' . $request->last_name;
                $customer->phone = $request->phone;
                $customer->line = $request->line;
                $customer->address = $request->address;
                $customer->more_address = $request->more_address;
                $customer->latitude = $request->latitude;
                $customer->longitude = $request->longitude;
                $customer->save();
            }

            $air_conditioner = new AirConditioner();
            $air_conditioner->customer_id = $customer->id;
            $air_conditioner->indoor_number = $ca1;
            $air_conditioner->outdoor_number = $ca2;

            if ($air_conditioner->save()) {

                // ส่วนเช็ค Model รับ POINT
                $se = DB::connection('pgsql')->table('serial_numbers')
                    // ->where('serial_number', 'LIKE', '%' . $ca2 . '%')
                    ->where('serial_number', $ca2)
                    ->first();

                $ae = DB::connection('pgsql')->table('serial_numbers')
                    // ->where('serial_number', 'LIKE', '%' . $ca1 . '%')
                    ->where('serial_number', $ca1)
                    ->first();

                if ($customer != null) {
                    // $air = AirModel::where('model_name', $se->product_code)->where('des', $se->product_name)->first();
                    // $air_2 = AirModel::where('model_name', @$ae->product_code)->where('des', @$ae->product_name)->first();
                    $air = AirModel::where('des', $se->product_name)->first();
                    if($se->product_name==@$ae->product_name){
                        $air_2=null;
                    }else{
                        $air_2 = AirModel::where('des', @$ae->product_name)->first();
                    }
                    if ($air != null or $air_2 != null) {
                        $user = User::where('id', $customer->mechanic_id)->first();
                        if ($user != null) {
                            $a1 = $user->point;

                            // if($air!=null and $air_2!=null){
                            //     $w1=$air->point;
                            //     $w2=$air_2->point;
                            //     $ws=$w1+$w2;
                            //     $a2 = $ws;
                            // }else{
                            //     $a2 = $air->point;
                            // }

                            $a2 = $air->point;
                            $sum = $a1 + $a2;
                            $user->point = $sum;
                            // $user->save();

                            if($user->save()){
                            $his = new history_point();
                            $his->title = 'ได้รับ Point จากการทำรายการ serial indoor : '.$ca1.' และ serial outdoor : '.$ca2;
                            $his->point = @$a2;
                            $his->id_user = $user->id;
                            $his->id_air = $air_conditioner->id;
                            $his->date = date('Y-m-d H:i:s');
                            $his->save();
                            }

                            $air_conditioner->out_name = @$air->des;
                            $air_conditioner->in_name = @$air_2->des;
                            $air_conditioner->point = @$a2;
                            $air_conditioner->point2 = @$air_2->point;
                            $air_conditioner->save();

                            return response()->json([
                                'status' => true,
                                'message' => 'Success Receive ' . $a2 . ' Point!',
                                'url_picture' => $this->prefix,
                            ]);
                        }
                    }else{


                        try{
                            $cus = Customer::where('mechanic_id', '!=', null)->where('first_name', $request->first_name)->where('last_name', $request->last_name)->first();
                            $sss = User::where('id', $request->mechanic_id)->first();
            
                            $add=new tb_log();
                            $add->id_user=$request->mechanic_id;
                            $add->id_other=$cus->id;
                            $add->title='เพิ่มแอร์ แต่ไม่ได้คะแนน';
                            $add->detail='เพิ่มแอร์ ชื่อคนเพิ่ม '.$sss->name.' เพิ่มให้ลูกค้าชื่อ '.$request->first_name.' '.$request->last_name;
                            $add->serial=$ca2;
                            $add->save();
                            } catch (Exception $e) {
                            return response()->json([
                                'result' => [],
                                'status' => false,
                                'message' => $e->getMessage(),
                            ], 400);
                            }


                    }
                }
                // ส่วนเช็ค Model รับ POINT

                return response()->json([
                    'status' => true,
                    'message' => 'Success!',
                    'url_picture' => $this->prefix,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data cannot be saved!'
                ], 400);
            }
        } else {

            try{
                $cus = Customer::where('mechanic_id', '!=', null)->where('first_name', $request->first_name)->where('last_name', $request->last_name)->first();
                $sss = User::where('id', $request->mechanic_id)->first();

                $add=new tb_log();
                $add->id_user=$request->mechanic_id;
                $add->id_other=$cus->id;
                $add->title='เพิ่มแอร์';
                $add->detail='เพิ่มแอร์ ชื่อคนเพิ่ม '.$sss->name.' เพิ่มให้ลูกค้าชื่อ '.$request->first_name.' '.$request->last_name;
                $add->serial=$ca2;
                $add->save();
                } catch (Exception $e) {
                return response()->json([
                    'result' => [],
                    'status' => false,
                    'message' => $e->getMessage(),
                ], 400);
                }

                
            return response()->json([
                'status' => false,
                'message' => 'Not Found Air Conditioner in Data.'
            ], 400);
        }
        // }
        } catch (Exception $e) {
            Log::error($e->getMessage());
    
            $f=new tb_log();
            $f->id_user=$request->mechanic_id;
            $f->title='Error FIX AIR /in '.$request->indoor_number.' /out '.$request->outdoor_number;
            $f->detail=$e->getMessage();
            $f->save();
    
            return response()->json([
                'result' => [],
                'status' => false,
                'message' => $e->getMessage(),
            ], 400);
            }

        

        
    }

    public function update_air_conditioner(Request $request)
    {

        try{
        $check_validate = [
            'customer_id' => 'required',
            'indoor_number' => 'nullable|unique:air_conditioners,indoor_number',
            'indoor_number' => 'nullable|unique:air_conditioners,outdoor_number',
            'outdoor_number' => 'required|unique:air_conditioners,indoor_number',
            'outdoor_number' => 'required|unique:air_conditioners,outdoor_number',
        ];

        $error_validator = [
            'indoor_number:unique' => 'มีข้อมูลนี้อยู่ในระบบแล้ว',
            'outdoor_number:unique' => 'มีข้อมูลนี้อยู่ในระบบแล้ว',
        ];

        $validator = Validator::make(
            $request->all(),
            $check_validate,
            $error_validator
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
            ], 400);
        }

        if ($request->indoor_number != null  && $request->indoor_number != '' && isset($request->indoor_number)) {

            $king1 = strlen($request->indoor_number);

            if ($king1 > 11) {
                $ca1 = substr($request->indoor_number, 0, -1);
            } else {
                $ca1 = $request->indoor_number;
            }

            $check_serial_indoor = DB::connection('pgsql')->table('serial_numbers')
                ->where('serial_number', $ca1)
                ->get()->count();
        }else{
            $ca1=null;
        }


        $king2 = strlen($request->outdoor_number);

        if ($king2 > 11) {
            $ca2 = substr($request->outdoor_number, 0, -1);
        } else {
            $ca2 = $request->outdoor_number;
        }

        $check_serial_outdoor = DB::connection('pgsql')->table('serial_numbers')
            ->where('serial_number', $ca2)
            ->get()->count();

        // if (isset($check_serial_indoor)) {
        //     if ($check_serial_indoor != 0 && $check_serial_outdoor != 0) {
        //         $air_conditioner = new AirConditioner;
        //         $air_conditioner->customer_id = $request->customer_id;
        //         $air_conditioner->indoor_number = $ca1;
        //         $air_conditioner->outdoor_number = $ca2;

        //         if ($air_conditioner->save()) {
        //             $customer = Customer::where('id', $request->customer_id)->with('airconditioner')->first();


        //             // ส่วนเช็ค Model รับ POINT
        //             $se = DB::connection('pgsql')->table('serial_numbers')
        //             ->where('serial_number', 'LIKE', '%'.$ca1.'%')
        //             // ->where('serial_number', $request->indoor_number)
        //             ->first();
        //             if($se!=null){
        //             if($customer!=null){
        //                 $air = AirModel::where('model_name',$se->product_code)->where('des',$se->product_name)->first();
        //                 if($air!=null){
        //                 $user = User::where('id', $customer->mechanic_id)->first();
        //                 if($user!=null){
        //                 $a1=$user->point;
        //                 $a2=$air->point;
        //                 $sum=$a1+$a2;
        //                 $user->point=$sum;
        //                 $user->save();

        //                 $his=new history_point();
        //                 $his->title='ได้รับ Point จากการทำรายการ';
        //                 $his->point=$a2;
        //                 $his->id_user=$user->id;
        //                 $his->date=date('Y-m-d H:i:s');
        //                 $his->save();

        //                 $air_conditioner->in_name = $air->des;
        //                 $air_conditioner->point = $air->point;
        //                 $air_conditioner->save();

        //                 return response()->json([
        //                     'status' => true,
        //                     'message' => 'Success Receive '.$a2.' Point!',
        //                     'result' => [
        //                         'customer' => $customer,
        //                     ],
        //                     'url_picture' => $this->prefix,
        //                 ]);

        //                 }
        //             }}
        //             }
        //             // ส่วนเช็ค Model รับ POINT

        //             return response()->json([
        //                 'status' => true,
        //                 'message' => 'Success!',
        //                 'result' => [
        //                     'customer' => $customer,
        //                 ],
        //                 'url_picture' => $this->prefix,
        //             ]);
        //         } else {
        //             return response()->json([
        //                 'status' => false,
        //                 'message' => 'Can Not Update'
        //             ], 400);
        //         }
        //     } else {
        //         return response()->json([
        //             'status' => false,
        //             'message' => 'Not Found Air Conditioner in Data.'
        //         ], 400);
        //     }
        // } else {

         

        if ($check_serial_outdoor != 0) {
            $air_conditioner = new AirConditioner;
            $air_conditioner->customer_id = $request->customer_id;
            $air_conditioner->indoor_number = $ca1;
            $air_conditioner->outdoor_number = $ca2;

            if ($air_conditioner->save()) {
                $customer = Customer::where('id', $request->customer_id)->with('airconditioner')->first();

                // ส่วนเช็ค Model รับ POINT
                $se = DB::connection('pgsql')->table('serial_numbers')
                    // ->where('serial_number', 'LIKE', '%' . $ca2 . '%')
                    ->where('serial_number', $ca2)
                    ->first();

                $ae = DB::connection('pgsql')->table('serial_numbers')
                    // ->where('serial_number', 'LIKE', '%' . $ca1 . '%')
                    ->where('serial_number', $ca1)
                    ->first();

                if ($customer != null) {
                    // $air = AirModel::where('model_name', @$se->product_code)->where('des', @$se->product_name)->first();
                    // $air_2 = AirModel::where('model_name', @$ae->product_code)->where('des', @$ae->product_name)->first();
                    $air = AirModel::where('des', @$se->product_name)->first();
                    if($se->product_name==@$ae->product_name){
                        $air_2=null;
                    }else{
                        $air_2 = AirModel::where('des', @$ae->product_name)->first();
                    }
                    if ($air != null or $air_2 != null) {
                        $user = User::where('id', $customer->mechanic_id)->first();
                        if ($user != null) {
                            $a1 = $user->point;

                            // if($air!=null and $air_2!=null){
                            //     $w1=$air->point;
                            //     $w2=$air_2->point;
                            //     $ws=$w1+$w2;
                            //     $a2 = $ws;
                            // }else{
                            //     $a2 = $air->point;
                            // }
                            
                            $a2 = $air->point;
                            $sum = $a1 + $a2;
                            $user->point = $sum;
                            // $user->save();

                            if($user->save()){
                            $his = new history_point();
                            $his->title = 'ได้รับ Point จากการทำรายการ serial indoor : '.$ca1.' และ serial outdoor : '.$ca2;
                            $his->point = @$a2;
                            $his->id_air = $air_conditioner->id;
                            $his->id_user = $user->id;
                            $his->date = date('Y-m-d H:i:s');
                            $his->save();
                            }

                            $air_conditioner->out_name = @$air->des;
                            $air_conditioner->in_name = @$air_2->des;
                            $air_conditioner->point = @$a2;
                            $air_conditioner->point2 = @$air_2->point;
                            $air_conditioner->save();

                            return response()->json([
                                'status' => true,
                                'message' => 'Success Receive ' . $a2 . ' Point!',
                                'result' => [
                                    'customer' => $customer,
                                ],
                                'url_picture' => $this->prefix,
                            ]);
                        }
                    }else{
                        try{
                            $cus = Customer::where('mechanic_id', '!=', null)->where('first_name', $request->first_name)->where('last_name', $request->last_name)->first();
                            $sss = User::where('id', $request->mechanic_id)->first();
            
                            $add=new tb_log();
                            $add->id_user=$request->mechanic_id;
                            $add->id_other=$cus->id;
                            $add->title='เพิ่มแอร์ แต่ไม่ได้คะแนน';
                            $add->detail='เพิ่มแอร์ ชื่อคนเพิ่ม '.$sss->name.' เพิ่มให้ลูกค้าชื่อ '.$request->first_name.' '.$request->last_name;
                            $add->serial=$ca2;
                            $add->save();
                            } catch (Exception $e) {
                            return response()->json([
                                'result' => [],
                                'status' => false,
                                'message' => $e->getMessage(),
                            ], 400);
                            }

                    }
                }
                // ส่วนเช็ค Model รับ POINT

                return response()->json([
                    'status' => true,
                    'message' => 'Success!',
                    'result' => [
                        'customer' => $customer,
                    ],
                    'url_picture' => $this->prefix,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Can Not Update'
                ], 400);
            }
        } else {

            try{
                $cus = Customer::where('mechanic_id', '!=', null)->where('first_name', $request->first_name)->where('last_name', $request->last_name)->first();
                $sss = User::where('id', $request->mechanic_id)->first();

                $add=new tb_log();
                $add->id_user=$request->mechanic_id;
                $add->id_other=$cus->id;
                $add->title='เพิ่มแอร์';
                $add->detail='เพิ่มแอร์ ชื่อคนเพิ่ม '.$sss->name.' เพิ่มให้ลูกค้าชื่อ '.$request->first_name.' '.$request->last_name;
                $add->serial=$ca2;
                $add->save();
                } catch (Exception $e) {
                return response()->json([
                    'result' => [],
                    'status' => false,
                    'message' => $e->getMessage(),
                ], 400);
                }


            return response()->json([
                'status' => false,
                'message' => 'Not Found Air Conditioner in Data.'
            ], 400);
        }
        // }

        } catch (Exception $e) {
            Log::error($e->getMessage());
    
            $f=new tb_log();
            $f->id_user=$request->mechanic_id;
            $f->title='Error FIX AIR /in '.$request->indoor_number.' /out '.$request->outdoor_number;
            $f->detail=$e->getMessage();
            $f->save();
    
            return response()->json([
                'result' => [],
                'status' => false,
                'message' => $e->getMessage(),
            ], 400);
            }
    }

    public function update_customer(Request $request)
    {
        // return $request->all();
        $find_customer = Customer::where('id', $request->id)->first();

        if (!empty($find_customer)) {
            foreach ($request->all() as $key => $item) {

                if ($key == 'full_name') {
                    $text = $request->full_name;
                    $arr_name =   array_filter(explode(" ", $text), fn ($value) =>  $value != "");
                    $arr_name = array_values($arr_name);
                    // return  $arr_name;
                    $dataPrepare = [
                        'full_name' => $arr_name[0] . ' ' . $arr_name[1],
                        'first_name' => $arr_name[0],
                        'last_name' => $arr_name[1],
                    ];

                    // return $dataPrepare;
                } else {
                    $dataPrepare = [
                        $key => $item,
                    ];
                }
                $update_customer = Customer::find($request->id)->update($dataPrepare);
                $fetch_customer = Customer::where('id', $request->id)->first();
            }
            //======check update
            if ($update_customer) {
                return response()->json([
                    'status' => true,
                    'message' => 'Update Success!',
                    'result' => [
                        'customer' => $fetch_customer,
                    ]
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Can Not Update!',
                ], 400);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Not found Customer in clound!',
            ], 400);
        }
    }

    //================== Traing

    public function get_traing_list()
    {
        $data = Training::with('province')->where('status', 'on')->get();

        return response()->json([
            'status' => true,
            'message' => 'Success',
            'result' => [
                'data' => $data,
            ],
        ]);
    }

    public function training_detail($id, $user)
    {
        $max_turn = TrainingTurn::where('training_id', $id)->orderby('turn', 'desc')->first()->id;
        /*$training = Training::where('id', $id)->with('traininglist','trainingturn')
            ->whereHas('traininglist','turn_id',$max_turn->id)->get();*/
        $data = Training::where('id', $id)->with('province', 'amphure', 'district')->get();

        $lists = TrainingList::where('training_id', $id)->where('user_id', $user)->where('turn_id', $max_turn)->get();

        return response()->json([
            'status' => true,
            'message' => 'Success',
            'result' => [
                'data' => $data,
                'turn_id' => $max_turn,
                'list' => $lists,
            ],
        ]);
    }

    public function book_training(Request $request, $id = null)
    {
        if ($id != null) {
            $training = Training::where('id', $id)->first();
            $get_turn_now = TrainingTurn::where('training_id', $id)->orderby('turn', 'desc')->first();

            //check status
            if ($training->status == 'off') {
                return response()->json([
                    'status' => false,
                    'message' => 'The Training is close',
                ], 400);
            }
            //check status

            //check validate value
            $user_training_validate = [
                'user_id' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'phone' => 'required',
                // 'agency' => 'required'
            ];

            $error_validator = [
                'user_id' => 'กรุณากรอกข้อมูล',
                'first_name:required' => 'กรุณากรอกข้อมูล',
                'last_name:required' => 'กรุณากรอกข้อมูล',
                'phone:required' => 'กรุณากรอกข้อมูล',
                // 'agency:required' => 'กรุณากรอกข้อมูล'
            ];

            $validator = Validator::make(
                $request->all(),
                $user_training_validate,
                $error_validator
            );

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'error' => $validator->errors(),
                ], 400);
            }
            //check validate value

            try {
                if (!empty($get_turn_now)) {
                    $user = new TrainingList;
                    $user->user_id = $request->user_id;
                    $user->first_name = $request->first_name;
                    $user->last_name = $request->last_name;
                    $user->nickname = $request->nickname;
                    $user->full_name = $request->first_name . ' ' . $request->last_name;
                    $user->phone = $request->phone;
                    $usersResult = User::find($request->user_id);
                    $user->agency = $usersResult->market;

                    $user->training_id = $id;
                    $user->turn_id = $get_turn_now->id;
                    // create & get data
                    if ($user->save()) {
                        $data = Training::where('id', $id)->with('province', 'amphure', 'district')->first();
                        $turn_id = TrainingTurn::where('training_id', $id)->orderby('turn', 'desc')->first()->id;
                        $list = TrainingList::where('training_id', $id)->where('turn_id', $turn_id)->get();
                        return response()->json([
                            'result' => [
                                'data' => $data,
                                'turn_id' => $turn_id,
                                'list' => $list,
                            ],
                            'status' => true,
                            'message' => 'Success!',
                        ]);
                    }
                }
            } catch (Exception $e) {
                Log::error($e->getMessage());
                return response()->json([
                    'result' => [],
                    'status' => false,
                    'message' => $e->getMessage(),
                ], 400);
            }
        } else {
            $status = false;
            $message = 'Error For Create';

            return response()->json([
                'status' => $status,
                'message' => $message,
            ], 400);
        }
    }

    public function removeBooktraing($id)
    {
        try {
            $user_training = TrainingList::where('id', $id)->first();
            if ($user_training) {
                $user_training->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Success',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'ไม่พบข้อมูล',
                ], 400);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'result' => [],
                'status' => false,
                'message' => $e->getMessage(),
            ], 400);
        }
    }

    public function edit_book_training(Request $request, $id = null)
    {
        if ($id) {
            $user_training = TrainingList::where('id', $id)->with('training')->first();
            //check status
            if ($user_training->training->status == 'off') {
                return response()->json([
                    'status' => false,
                    'message' => 'The Training is close',
                ], 400);
            }
            //check status

            //check validate value
            $user_training_validate = [
                'user_id' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'phone' => 'required',
                // 'agency' => 'required'
            ];

            $error_validator = [
                'user_id' => 'กรุณากรอกข้อมูล',
                'first_name:required' => 'กรุณากรอกข้อมูล',
                'last_name:required' => 'กรุณากรอกข้อมูล',
                'phone:required' => 'กรุณากรอกข้อมูล',
                // 'agency:required' => 'กรุณากรอกข้อมูล'
            ];

            $validator = Validator::make(
                $request->all(),
                $user_training_validate,
                $error_validator
            );

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'error' => $validator->errors(),
                ], 400);
            }
            //check validate value

            try {
                $list = TrainingList::find($id);
                $list->first_name = $request->first_name;
                $list->last_name = $request->last_name;
                $list->full_name = $request->first_name . ' ' . $request->last_name;
                $list->user_id = $request->user_id;
                $list->phone = $request->phone;
                // $list->agency = $request->agency;
                $list->save();

                $training = Training::where('id', $list->training_id)->first();
                $turn_id = TrainingTurn::where('training_id', $training->id)->orderby('turn', 'desc')->first();

                return response()->json([
                    'status' => true,
                    'message' => "success",
                    'result' => [
                        'list' => $list,
                        'data' => $training,
                        'turn_id' => $turn_id,
                    ],
                ]);
            } catch (Exception $e) {
                Log::error($e->getMessage());
                return response()->json([
                    'result' => [],
                    'status' => false,
                    'message' => $e->getMessage(),
                ], 400);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Not Found User',
            ], 400);
        }
    }

    public function approve_training_list(Request $request, $id = null)
    {
        if ($id) {
            // $training_id = $id;

            //Check Validate
            $check_validate = [
                'user_id' => 'required',
                'status' => 'required',
            ];

            $error_validator = [
                'user_id:required' => 'กรุณากรอกข้อมูล',
                'status:required' => 'กรุณากรอกข้อมูล',
            ];

            $validator = Validator::make(
                $request->all(),
                $check_validate,
                $error_validator
            );

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'error' => $validator->errors(),
                ], 400);
            }

            $training = Training::where('id', $id)->first();
            $turn_id = TrainingTurn::where('training_id', $id)->orderby('turn', 'desc')->first();

            $turn_list = TrainingList::where('user_id', $request->user_id)->where('turn_id', $turn_id->id)->where('training_id', $id)->get();

            foreach ($turn_list as $traning_list) {
                $list = TrainingList::find($traning_list->id);
                $list->status_approve = $request->status;
                $list->save();
            }

            return response()->json([
                'status' => true,
                'message' => 'Success!',
                'data' => [
                    'training' => $training,
                    'list' => $turn_list,
                    'turn' => $turn_id->turn,
                ]
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Not Found Training'
            ], 400);
        }
    }

    public function test_database()
    {
        $test = DB::connection('pgsql')->table('products')->get();

        return $test;
    }
}
