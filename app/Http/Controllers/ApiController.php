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


class ApiController extends Controller

{

    // URL PICTURE
    //  protected $prefix = 'http://www.mitsuheavyth.com/img/upload/';
    // protected $prefix = 'http://hot.orangeworkshop.info/mitsu/img/upload/';

    protected $prefix = 'https://heavyoneclick-mitsu-s3.s3.ap-northeast-1.amazonaws.com/file/upload/';



     ///air_list///
     public function api_air_list($id)
     {
         $air_list = Air_listModel::where('model', $id)->first();
 
         if($air_list!=null){
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
        }else{
            $message = "Not Have Models!";
         $status = true;
         return response()->json([
             'results' => [
             ],
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
 
           if($air_list!=null){
 
           if($r->check1!=null){
             if($r->check1>=$air_list->min1 and $r->check1<=$air_list->max1){$sum1='ปกติ';}else{$sum1='ผิดปกติ';}
           }else{
             $sum1=null;
           }
 
           if($r->check2!=null){
             if($r->check2>=$air_list->min1 and $r->check2<=$air_list->max1){$sum2='ปกติ';}else{$sum2='ผิดปกติ';}
           }else{
             $sum2=null;
           }
 
 
           if($r->check3!=null){
             if($r->check3>=$air_list->min1 and $r->check3<=$air_list->max1){$sum3='ปกติ';}else{$sum3='ผิดปกติ';}
           }else{
             $sum3=null;
           }
   
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
         }else{
             $message = "Not Have Models!";
           $status = true;
           return response()->json([
               'results' => [
               ],
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
   
             if($air_list!=null){
   
             if($r->check1!=null){
               if($r->check1>=$air_list->min2 and $r->check1<=$air_list->max2){$sum1='ปกติ';}else{$sum1='ผิดปกติ';}
             }else{
               $sum1=null;
             }
   
             if($r->check2!=null){
               if($r->check2>=$air_list->min2 and $r->check2<=$air_list->max2){$sum2='ปกติ';}else{$sum2='ผิดปกติ';}
             }else{
               $sum2=null;
             }
   
   
             if($r->check3!=null){
               if($r->check3>=$air_list->min2 and $r->check3<=$air_list->max2){$sum3='ปกติ';}else{$sum3='ผิดปกติ';}
             }else{
               $sum3=null;
             }
     
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
           }else{
               $message = "Not Have Models!";
             $status = true;
             return response()->json([
                 'results' => [
                 ],
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
 
           if($air_list!=null){
 
           if($r->check1!=null){
             if($r->check1>=$air_list->min3 and $r->check1<=$air_list->max3){$sum1='ปกติ';}else{$sum1='ผิดปกติ';}
           }else{
             $sum1=null;
           }
 
           if($r->check2!=null){
             if($r->check2>=$air_list->min3 and $r->check2<=$air_list->max3){$sum2='ปกติ';}else{$sum2='ผิดปกติ';}
           }else{
             $sum2=null;
           }
 
 
           if($r->check3!=null){
             if($r->check3>=$air_list->min3 and $r->check3<=$air_list->max3){$sum3='ปกติ';}else{$sum3='ผิดปกติ';}
           }else{
             $sum3=null;
           }
   
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
         }else{
             $message = "Not Have Models!";
           $status = true;
           return response()->json([
               'results' => [
               ],
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
   
             if($air_list!=null){
   
             if($r->check1!=null){
               if($r->check1>=$air_list->min4 and $r->check1<=$air_list->max4){$sum1='ปกติ';}else{$sum1='ผิดปกติ';}
             }else{
               $sum1=null;
             }
   
             if($r->check2!=null){
               if($r->check2>=$air_list->min4 and $r->check2<=$air_list->max4){$sum2='ปกติ';}else{$sum2='ผิดปกติ';}
             }else{
               $sum2=null;
             }
   
   
             if($r->check3!=null){
               if($r->check3>=$air_list->min4 and $r->check3<=$air_list->max4){$sum3='ปกติ';}else{$sum3='ผิดปกติ';}
             }else{
               $sum3=null;
             }
     
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
           }else{
               $message = "Not Have Models!";
             $status = true;
             return response()->json([
                 'results' => [
                 ],
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
 
           if($air_list!=null){
 
           if($r->check1!=null){
             if($r->check1>=$air_list->min5 and $r->check1<=$air_list->max5){$sum1='ปกติ';}else{$sum1='ผิดปกติ';}
           }else{
             $sum1=null;
           }
 
           if($r->check2!=null){
             if($r->check2>=$air_list->min5 and $r->check2<=$air_list->max5){$sum2='ปกติ';}else{$sum2='ผิดปกติ';}
           }else{
             $sum2=null;
           }
 
 
           if($r->check3!=null){
             if($r->check3>=$air_list->min5 and $r->check3<=$air_list->max5){$sum3='ปกติ';}else{$sum3='ผิดปกติ';}
           }else{
             $sum3=null;
           }
   
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
         }else{
             $message = "Not Have Models!";
           $status = true;
           return response()->json([
               'results' => [
               ],
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
   
             if($air_list!=null){
   
             if($r->check1!=null){
               if($r->check1>=$air_list->min6 and $r->check1<=$air_list->max6){$sum1='ปกติ';}else{$sum1='ผิดปกติ';}
             }else{
               $sum1=null;
             }
   
             if($r->check2!=null){
               if($r->check2>=$air_list->min6 and $r->check2<=$air_list->max6){$sum2='ปกติ';}else{$sum2='ผิดปกติ';}
             }else{
               $sum2=null;
             }
   
   
             if($r->check3!=null){
               if($r->check3>=$air_list->min6 and $r->check3<=$air_list->max6){$sum3='ปกติ';}else{$sum3='ผิดปกติ';}
             }else{
               $sum3=null;
             }
     
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
           }else{
               $message = "Not Have Models!";
             $status = true;
             return response()->json([
                 'results' => [
                 ],
                 'status' =>  $status,
                 'message' =>  $message,
                 'url_picture' => $this->prefix,
             ]);
           }
         }
         ///air_listcheck6///











    //    --------------------------------------------------------ALL

      ///air_list///
    //   public function api_air_list_check(Request $r)
    //   {
    //       $air_list = Air_listModel::where('model', $r->model)->first();

    //       if($air_list!=null){

    //       if($r->check1!=null){
    //         if($r->check1>=$air_list->min1 and $r->check1<=$air_list->max1){$sum1='ปกติ';}else{$sum1='ผิดปกติ';}
    //       }else{
    //         $sum1=null;
    //       }

    //       if($r->check2!=null){
    //         if($r->check2>=$air_list->min2 and $r->check2<=$air_list->max2){$sum2='ปกติ';}else{$sum2='ผิดปกติ';}
    //       }else{
    //         $sum2=null;
    //       }


    //       if($r->check3!=null){
    //         if($r->check3>=$air_list->min3 and $r->check3<=$air_list->max3){$sum3='ปกติ';}else{$sum3='ผิดปกติ';}
    //       }else{
    //         $sum3=null;
    //       }

    //       if($r->check4!=null){
    //         if($r->check4>=$air_list->min4 and $r->check4<=$air_list->max4){$sum4='ปกติ';}else{$sum4='ผิดปกติ';}
    //       }else{
    //         $sum4=null;
    //       }

    //       if($r->check5!=null){
    //         if($r->check5>=$air_list->min5 and $r->check5<=$air_list->max5){$sum5='ปกติ';}else{$sum5='ผิดปกติ';}
    //       }else{
    //         $sum5=null;
    //       }

    //       if($r->check6!=null){
    //         if($r->check6>=$air_list->min6 and $r->check6<=$air_list->max6){$sum6='ปกติ';}else{$sum6='ผิดปกติ';}
    //       }else{
    //         $sum6=null;
    //       }
  
    //       $message = "Success!";
    //       $status = true;
    //       return response()->json([
    //           'results' => [
    //               'air_list' => $air_list,
    //               'sum1' => $sum1,
    //               'sum2' => $sum2,
    //               'sum3' => $sum3,
    //               'sum4' => $sum4,
    //               'sum5' => $sum5,
    //               'sum6' => $sum6,
    //           ],
    //           'status' =>  $status,
    //           'message' =>  $message,
    //           'url_picture' => $this->prefix,
    //       ]);
    //     }else{
    //         $message = "Not Have Models!";
    //       $status = true;
    //       return response()->json([
    //           'results' => [
    //           ],
    //           'status' =>  $status,
    //           'message' =>  $message,
    //           'url_picture' => $this->prefix,
    //       ]);
    //     }
    //   }
      ///air_list///
         //    --------------------------------------------------------ALL

     

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
        if ($r->date == null || $r->date == "null") {
            $wo = WO::where('technician_id', $r->id)->where('d_status', 0)->with('customer')->with('model')->orderby('wo_time', 'asc')->get();
        } else {
            $wo = WO::where('technician_id', $r->id)->where('wo_date', $r->date)->where('d_status', 0)->with('customer')->with('model')->orderby('wo_time', 'asc')->get();
            $date = $r->date;
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
                if($r->phone!=null){
                    $na = $r->phone;
                }else{
                    $na = $r->name . '12345';
                }
                $user->password = Hash::make($na); 
            } else {
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
            $user->num = $nm;

            $num = str_pad($nm, 5, '0', STR_PAD_LEFT);
            $user->code = $year . 'H' . $num;
            // CODE



            $user->save();


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

            if ($r->email != null or $r->email!='-') {
                $check = User::where('id','!=',$r->id_user)->where('email', $r->email)->first();
                if($check==null){
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
                $p = province::where('name_th', $r->province)->first();
                if ($p != null) {
                    $user->id_p = $p->id;
                    $user->province = $r->province;
                }
            }
            if ($r->district != null) {
                $d = district::where('name_th', $r->district)->first();
                if ($d != null) {
                    $user->id_d = $d->id;
                    $user->district = $r->district;
                }
            }
            if ($r->amphur != null) {
                $a = amphur::where('name_th', $r->amphur)->first();
                if ($a != null) {
                    $user->id_a = $a->id;
                    $user->amphur = $r->amphur;
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



    ///LOGIN  User///
    public function api_login_user(Request $r)
    {
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
        $user = User::where('id', $r->id_user)->orderby('id', 'desc')->first();
        $item = item_point::where('id', $r->id_item)->orderby('id', 'desc')->first();

        $cu = $user->point;
        $ci = $item->point;
        if ($cu >= $ci) {
            $sum = $cu - $ci;
            $user->point = $sum;
            $user->save();

            $his = new buy_point();
            $his->id_user = $user->id;
            $his->id_item = $item->id;

            $his->title = $item->titleth;

            $his->old_point = $cu;
            $his->buy_point = $ci;
            $his->bl_point = $sum;
            $his->date = date('Y-m-d H:i:s');
            $his->save();


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
            $message = "Fail!";
            $status = false;
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
    public function api_province()
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

        //check customer
        $check_name_customer = Customer::where('first_name', $request->first_name)->where('last_name', $request->last_name)->get()->count();
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
            /*'indoor_number' => [
                    'required',
                    Rule::unique('air_conditioners','indoor_number')->where('outdoor_number','=',$indoor_number),
                ],
                'outdoor_number' => [
                    'required',
                    Rule::unique('air_conditioners','outdoor_number')->where(function($query) use ($request){
                        return $query->where('indoor_number',$request->outdoor_number);
                    }),
                ],*/
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
        if ($request->indoor_number != null && !isEmpty($request->indoor_number) && $request->indoor_number != '' && isset($request->indoor_number)) {
            $check_serial_indoor = DB::connection('pgsql')->table('serial_numbers')->where('serial_number', $request->indoor_number)->get()->count();
        }
        $check_serial_outdoor = DB::connection('pgsql')->table('serial_numbers')->where('serial_number', $request->outdoor_number)->get()->count();
        if (isset($check_serial_indoor)) {
            if ($check_serial_indoor != 0 && $check_serial_outdoor != 0) {
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

                $air_conditioner = new AirConditioner();
                $air_conditioner->customer_id = $customer->id;
                $air_conditioner->indoor_number = $request->indoor_number;
                $air_conditioner->outdoor_number = $request->outdoor_number;

                if ($air_conditioner->save()) {
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
                return response()->json([
                    'status' => false,
                    'message' => 'Not Found Air Conditioner in Data.'
                ], 400);
            }
        } else {
            if ($check_serial_outdoor != 0) {
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

                $air_conditioner = new AirConditioner();
                $air_conditioner->customer_id = $customer->id;
                $air_conditioner->indoor_number = null;
                $air_conditioner->outdoor_number = $request->outdoor_number;

                if ($air_conditioner->save()) {
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
                return response()->json([
                    'status' => false,
                    'message' => 'Not Found Air Conditioner in Data.'
                ], 400);
            }
        }
    }

    public function update_air_conditioner(Request $request)
    {

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

        if ($request->indoor_number != null && !isEmpty($request->indoor_number) && $request->indoor_number != '' && isset($request->indoor_number)) {
            $check_serial_indoor = DB::connection('pgsql')->table('serial_numbers')->where('serial_number', $request->indoor_number)->get()->count();
        }
        $check_serial_outdoor = DB::connection('pgsql')->table('serial_numbers')->where('serial_number', $request->outdoor_number)->get()->count();

        if (isset($check_serial_indoor)) {
            if ($check_serial_indoor != 0 && $check_serial_outdoor != 0) {
                $air_conditioner = new AirConditioner;
                $air_conditioner->customer_id = $request->customer_id;
                $air_conditioner->indoor_number = $request->indoor_number;
                $air_conditioner->outdoor_number = $request->outdoor_number;

                if ($air_conditioner->save()) {
                    $customer = Customer::where('id', $request->customer_id)->with('airconditioner')->first();


                    // ส่วนเช็ค Model รับ POINT
                    $se = DB::connection('pgsql')->table('serial_numbers')->where('serial_number', $request->indoor_number)->first();
                    if($se){
                    if($customer){
                        $air = AirModel::where('model_name',$se->product_code)->where('des',$se->product_name)->first();
                        if($air){
                        $user = User::where('id', $customer->mechanic_id)->first();
                        if($user){
                        $a1=$user->point;
                        $a2=$model->point;
                        $sum=$a1+$a2;
                        $user->point=$sum;
                        $user->save();

                        $his=new history_point();
                        $his->title='ได้รับ Point จากการทำรายการ';
                        $his->point=$a2;
                        $his->id_user=$user->id;
                        $his->date=date('Y-m-d H:i:s');
                        $his->save();

                        return response()->json([
                            'status' => true,
                            'message' => 'Success Receive '.$a2.' Point!',
                            'result' => [
                                'customer' => $customer,
                            ],
                            'url_picture' => $this->prefix,
                        ]);

                        }
                    }}
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
                return response()->json([
                    'status' => false,
                    'message' => 'Not Found Air Conditioner in Data.'
                ], 400);
            }
        } else {
            if ($check_serial_outdoor != 0) {
                $air_conditioner = new AirConditioner;
                $air_conditioner->customer_id = $request->customer_id;
                $air_conditioner->indoor_number = $request->indoor_number;
                $air_conditioner->outdoor_number = $request->outdoor_number;

                if ($air_conditioner->save()) {
                    $customer = Customer::where('id', $request->customer_id)->with('airconditioner')->first();

                    // ส่วนเช็ค Model รับ POINT
                    $se = DB::connection('pgsql')->table('serial_numbers')->where('serial_number', $request->outdoor_number)->first();
                    if($se){
                    if($customer){
                        $air = AirModel::where('model_name',$se->product_code)->where('des',$se->product_name)->first();
                        if($air){
                        $user = User::where('id', $customer->mechanic_id)->first();
                        if($user){
                        $a1=$user->point;
                        $a2=$model->point;
                        $sum=$a1+$a2;
                        $user->point=$sum;
                        $user->save();

                        $his=new history_point();
                        $his->title='ได้รับ Point จากการทำรายการ';
                        $his->point=$a2;
                        $his->id_user=$user->id;
                        $his->date=date('Y-m-d H:i:s');
                        $his->save();

                        return response()->json([
                            'status' => true,
                            'message' => 'Success Receive '.$a2.' Point!',
                            'result' => [
                                'customer' => $customer,
                            ],
                            'url_picture' => $this->prefix,
                        ]);

                        }
                    }}
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
                return response()->json([
                    'status' => false,
                    'message' => 'Not Found Air Conditioner in Data.'
                ], 400);
            }
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
