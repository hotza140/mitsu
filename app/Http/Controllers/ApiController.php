<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\Mail\Email;
use App\User;
use DB;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use PDF;
use Illuminate\Validation\Rule;

use App\Models\banner;
use App\Models\product;
use App\Models\history_point;
use App\Models\news;
use App\Models\Customer;
use App\Models\AirConditioner;

use App\Models\province;
use App\Models\district;
use App\Models\amphur;

use App\Mail\Forget_email;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\support\carbon;


class ApiController extends Controller

{

     // URL PICTURE
    //  protected $prefix = 'http://www.mitsuheavyth.com/img/upload/';
    protected $prefix = 'http://hot.orangeworkshop.info/mitsu/img/upload/';




        ///user///
        public function api_user($id){
            $user=User::where('id',$id)->first();

                $message="Success!";
                $status=true;
                return response()->json([
                    'results'=>[
                        'user'=>$user,
                    ],
                    'status' =>  $status,
                    'message' =>  $message,
                    'url_picture' => $this->prefix,
                ]);

        }
        ///user///



       ///Register  User///
       public function api_register_user(Request $r){
        $year=date('Y');
        $check=User::where('email',$r->email)->first();
        if($check==null){
            $user=new User();
            $user->name=$r->name;
            $user->email=$r->email;
            $user->password=Hash::make($r->password);
            $user->type=5;
            $user->status=1;

            $user->lastname=$r->lastname;
            $user->market=$r->market;
            $user->phone=$r->phone;

            $length=12;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            $cm=User::where('token',$randomString)->first();
            if($cm!=null){
                  $length=12;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            }
            $cmm=User::where('token',$randomString)->first();
            if($cmm!=null){
                  $length=12;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            }

            $user->token=$randomString;

            $p=province::where('name_th',$r->province)->first();
            if($p!=null){
            $user->province=$r->province;
            $user->id_p=$p->id;
            }

               // CODE
         $nu=User::where('type',5)->orderby('id','desc')->first();
         if($nu!=null){
            $nm=$nu->num+1;
         }else{
            $nm=1;
         }
         $user->num=$nm;

         $num = str_pad($nm, 5, '0', STR_PAD_LEFT);
         $user->code=$year.'H'.$num;
         // CODE



            $user->save();


            $message="Register Success!";
            $status=true;
            return response()->json([
                'results'=>[
                    'user'=>$user,
                ],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        }else{
            $message="There is an email on the server!";
            $status=false;
            return response()->json([
                'results'=>[
                ],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ],400);

        }

    }
     ///Register  User///



      ///--------api_change_oldpass---------///
      public function api_change_password(Request $r){
        $user=User::where('id',$r->id_user)->first();
        $check=Hash::make($r->old_pass);
        if(Hash::check($r->old_pass, $user->password)){

        if($r->new_pass==$r->new_pass_check){
        $user=User::where('id',$r->id_user)->first();
        $make=Hash::make($r->new_pass);
        $user->password=$make;
        $user->save();

        $status=true;
        $message="Success!";
        return response()->json([
        'results'=>[
        'user' =>$user,
        ],
        'status'=>$status,
        'message' =>  $message,
        'url_picture' => $this->prefix,
        ]);

    }else{
        $status=false;
        $message="Password Check do not match!";
        return response()->json([
        'results'=>[
        'user' =>$user,
        ],
        'status'=>$status,
        'message' =>  $message,
        'url_picture' => $this->prefix,
        ],400);
    }

        }else{
        $status=false;
        $message="Old Password Wrong!";
        return response()->json([
        'results'=>[
        'user' =>$user,
        ],
        'status'=>$status,
        'message' =>  $message,
        'url_picture' => $this->prefix,
        ],400);
        }
    }
    ///-----------------///



       ///EDIT  User///
       public function api_edit_user(Request $r){
        $user=User::where('id',$r->id_user)->first();
        if($user!=null){
            if($r->market!=null){
                $user->market=$r->market;
            }
    //    ------------------
            if($r->nickname!=null){
                $user->nickname=$r->nickname;
            }
    //    ------------------
            if($r->name!=null){
                $user->name=$r->name;
            }
            if($r->lastname!=null){
                $user->lastname=$r->lastname;
            }
    //    ------------------

            if($r->email!=null){
                $user->email=$r->email;
            }
            if($r->phone!=null){
                $user->phone=$r->phone;
            }
            if($r->line!=null){
                $user->line=$r->line;
            }
    //    ------------------

            if($r->province!=null){
                $p=province::where('name_th',$r->province)->first();
                if($p!=null){
                $user->id_p=$p->id;
                $user->province=$r->province;
                }
            }
            if($r->district!=null){
                $d=district::where('name_th',$r->district)->first();
                if($d!=null){
                $user->id_d=$d->id;
                $user->district=$r->district;
                }
            }
            if($r->amphur!=null){
                $a=amphur::where('name_th',$r->amphur)->first();
                if($a!=null){
                $user->id_a=$a->id;
                $user->amphur=$r->amphur;
                }
            }
            if($r->house!=null){
                $user->house=$r->house;
            }
            if($r->moo!=null){
                $user->moo=$r->moo;
            }
            if($r->condo!=null){
                $user->condo=$r->condo;
            }
            if($r->road!=null){
                $user->road=$r->road;
            }
            if($r->zipcode!=null){
                $user->zipcode=$r->zipcode;
            }

    //    ------------------

            if($r->picture!=null){
                if(!$r->hasFile('picture')) {
                    return response()->json(['upload_file_not_found'], 400);
                }
                $file = $r->file('picture');
                if(!$file->isValid()) {
                    return response()->json(['invalid_file_upload'], 400);
                }
                $picture = $_FILES['picture']['name'];
                $r->picture->move(public_path() . '/img/upload', $picture);
                $user->picture = $picture;}



            $user->save();


            $message="Success!";
            $status=true;
            return response()->json([
                'results'=>[
                    'user'=>$user,
                ],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ]);
        }else{
            $message="There is an ID on the server!";
            $status=false;
            return response()->json([
                'results'=>[
                ],
                'status' =>  $status,
                'message' =>  $message,
                'url_picture' => $this->prefix,
            ],400);

        }

    }
     ///EDIT  User///



      ///LOGIN  User///
    public function api_login_user(Request $r)
    {
    $check =User::where('email',$r->email)->where('type',5)->first();
    if($check){
            $confirm =User::where('email',$r->email)->where('type',5)->where('open',0)->first();
            if($confirm){
            if(!Hash::check($r->password, $confirm->password)){
            $password ="";
            }else{
            $password =User::where('email',$r->email)->where('type',5)->first();
            }
            if($password){
            $message = "Success";



            }else{
            $message = "Invalid Password";
            }
            }else{
            $message = "Not ConFirm Or User Are Close!";}
    }else{
    $message = "Invalid Email";
    }
          if ($message == "Success") {
              $status = true;
                           return response()->json([
          'results'=>[
                      'user'=>$password,
                    ],
          'status'=>$status,
          'message'=>$message,
          'url_picture' => $this->prefix,

         ]);
          }else{
           $status = false;
                        return response()->json([
          'results'=>[
        'email'=>$r->email,'password'=>$r->password,
          ],
          'status'=>$status,
          'message'=>$message,
          'url_picture' => $this->prefix,
         ],400);
          }

     }
       ///LOGIN  User///



        ///Add  Product USER///
        public function api_add_product_user(Request $r){
            $check=product::where('code',$r->code)->first();
            if($check==null){
                $item=new product();
                $item->titleth=$r->title;
                $item->desth=$r->desth;
                $item->detailth=$r->detailth;
                $item->date=date('Y-m-d H:i:s');
                $item->code=$r->code;
                $item->price=$r->price;

                $item->id_user=$r->id_user;
                $item->save();

                $user=User::where('id',$r->id_user)->first();
                if($user!=null){
                $point=$user->point;
                $user->point=$point+10;
                $user->save();
                }

                $item=new history_point();
                $item->title='ได้รับแต้ม 10 Point จากการลงสินค้า';
                $item->point=10;
                $item->id_user=$r->id_user;
                $item->date=date('Y-m-d H:i:s');
                $item->save();


                $message="Success!";
                $status=true;
                return response()->json([
                    'results'=>[
                        'item'=>$item,
                    ],
                    'status' =>  $status,
                    'message' =>  $message,
                    'url_picture' => $this->prefix,
                ]);
            }else{
                $message="There is an Product Code on the server!";
                $status=false;
                return response()->json([
                    'results'=>[
                    ],
                    'status' =>  $status,
                    'message' =>  $message,
                    'url_picture' => $this->prefix,
                ],400);

            }

        }
         ///Add  Product USER///


            ///Delete  Product USER///
        public function api_delete_product_user(Request $r){
            $check=product::where('id',$r->id)->first();
            if($check!=null){

                $check->delete();


                $message="Success!";
                $status=true;
                return response()->json([
                    'results'=>[
                    ],
                    'status' =>  $status,
                    'message' =>  $message,
                    'url_picture' => $this->prefix,
                ]);
            }else{
                $message="Not have Product Same in This Id!";
                $status=false;
                return response()->json([
                    'results'=>[
                    ],
                    'status' =>  $status,
                    'message' =>  $message,
                    'url_picture' => $this->prefix,
                ],400);

            }

        }
         ///Delete  Product USER///





           ///NEWS///
        public function api_news(Request $r){
            $type=$r->type;

            if($type=='banner'){
                $news=news::orderby('id','desc')->limit(4)->get();
            }elseif($type=='new'){
                $news=news::orderby('id','desc')->limit(5)->get();
            }elseif($type=='advice'){
                $news=news::where('choose',1)->orderby('id','desc')->get();
            }else{
                $news=news::orderby('id','desc')->paginate(9);
            }

                $message="Success!";
                $status=true;
                return response()->json([
                    'results'=>[
                        'news'=>$news,
                    ],
                    'status' =>  $status,
                    'message' =>  $message,
                    'url_picture' => $this->prefix,
                ]);

        }
        ///NEWS///



            ///province///
            public function api_province(){

                $ps = 'select name_th,id,name_en
                FROM tb_province
                ORDER BY
                CONVERT ( name_th USING tis620 ) ASC' ;

                $ds = 'select name_th,id,name_en
                FROM tb_districts
                ORDER BY
                CONVERT ( name_th USING tis620 ) ASC' ;

                $as = 'select name_th,id,name_en
                FROM tb_amupur
                ORDER BY
                CONVERT ( name_th USING tis620 ) ASC' ;

                $province =  DB::select($ps);
                $district =  DB::select($ds);
                $amphur =  DB::select($as);


                    $message="Success!";
                    $status=true;
                    return response()->json([
                        'results'=>[
                            'province'=>$province,
                            'district'=>$district,
                            'amphur'=>$amphur,
                        ],
                        'status' =>  $status,
                        'message' =>  $message,
                        'url_picture' => $this->prefix,
                    ]);

            }
            ///province///



        //===============  add air conditionner ==================//
        public function search_customer_name($mechanic_id ,$name = null){

            if($name == null){
                $get_customer = Customer::where('mechanic_id',$mechanic_id)->orderby('full_name','asc')->get();
            }else{
                $get_customer = Customer::where('mechanic_id',$mechanic_id)->where('full_name','like',$name)->get();
            }

            if($get_customer->count() != 0){
                return response()->json([
                    'status' => true,
                    'message' => 'Success!',
                    'result' => [
                        'customer' => $get_customer,
                    ],
                    'url_picture' => $this->prefix,
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Not found',
                ],400);
            }
        }

        public function get_customer($id){
            $customer = Customer::where('id',$id)->with('airconditioner')->first();

            if(!empty($customer)){
                return response()->json([
                    'status' => true,
                    'message' => 'Success!',
                    'result' => [
                        'customer' => $customer,
                    ],
                    'url_picture' => $this->prefix,
                ]);
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'This information already exists.',
                ],400);
            }
        }

        public function verify_customer(Request $request){
            $find_customer = Customer::where('first_name',$request->first_name)->where('last_name',$request->last_name)->get();

            //Don't Have Customer values
            if($find_customer->count() == 0 ){
                $message="This information is not yet available.";
                $status=true;
                return response()->json([
                    'status' =>  $status,
                    'message' =>  $message,
                    'url_picture' => $this->prefix,
                ]);
            }else{
                $status = false;
                $message = 'This information already exists.';
                return response()->json([
                    'status' => $status,
                    'message' =>  $message,
                    'message' => 'Error',
                ],400);
            }
        }

        public function add_air_conditioner(Request $request){

            //check customer
            $check_name_customer = Customer::where('first_name',$request->first_name)->where('last_name',$request->last_name)->get()->count();
            if($check_name_customer != 0){
                return response()->json([
                    'status' => false,
                    'error' => [
                        'customer' => 'A Customer Name has already been taken.'
                    ],
                ],400);
            }

            $air_conditioner_validator = [
                'indoor_number' => 'required|unique:air_conditioners,indoor_number',
                'indoor_number' => 'required|unique:air_conditioners,outdoor_number',
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

            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'error' => $validator->errors(),
                ],400);
            }

            //Find Serial number in database
            $check_serial_indoor = DB::connection('pgsql')->table('serial_numbers')->where('serial_number',$request->indoor_number)->get()->count();
            $check_serial_outdoor = DB::connection('pgsql')->table('serial_numbers')->where('serial_number',$request->outdoor_number)->get()->count();

            if($check_serial_indoor != 0 && $check_serial_outdoor != 0){
                $customer = new Customer();
                $customer->mechanic_id = $request->mechanic_id;
                $customer->first_name = $request->first_name;
                $customer->last_name = $request->last_name;
                $customer->full_name = $request->first_name.' '.$request->last_name;
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

                if($air_conditioner->save()){
                    return response()->json([
                        'status' => true,
                        'message' => 'Success!',
                        'url_picture' => $this->prefix,
                    ]);
                }else{
                    return response()->json([
                        'status' => false,
                        'message' => 'Data cannot be saved!'
                    ],400);
                }
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Not Found Air Conditioner in Data.'
                ],400);
            }
        }

        public function update_air_conditioner(Request $request){

            $check_validate = [
                'customer_id' => 'required',
                'indoor_number' => 'required|unique:air_conditioners,indoor_number',
                'indoor_number' => 'required|unique:air_conditioners,outdoor_number',
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

            if($validator->fails()){
                return response()->json([
                    'status' => false,
                    'error' => $validator->errors(),
                ],400);
            }

            $check_serial_indoor = DB::connection('pgsql')->table('serial_numbers')->where('serial_number',$request->indoor_number)->get()->count();
            $check_serial_outdoor = DB::connection('pgsql')->table('serial_numbers')->where('serial_number',$request->outdoor_number)->get()->count();

            if($check_serial_indoor != 0 && $check_serial_outdoor != 0){
                $air_conditioner = new AirConditioner;
                $air_conditioner->customer_id = $customer->id;
                $air_conditioner->indoor_number = $request->indoor_number;
                $air_conditioner->outdoor_number = $request->outdoor_number;

                if($air_conditioner->save()){
                    $customer = Customer::where('id',$request->customer_id)->with('airconditioner')->first();
                    return response()->json([
                        'status' => true,
                        'message' => 'Success!',
                        'result' => [
                            'customer' => $customer,
                        ],
                        'url_picture' => $this->prefix,
                    ]);
                }else{
                    return response()->json([
                        'status' => false,
                        'message' => 'Can Not Update'
                    ],400);
                }
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Not Found Air Conditioner in Data.'
                ],400);
            }

        }

        public function update_customer(Request $request){
            // return $request->all();
            foreach($request->all() as $key =>$item){

                if($key == 'full_name'){
                    $text = $request->full_name;
                    $arr_name =   array_filter(explode(" ", $text), fn ($value) =>  $value != "");
                    $arr_name = array_values($arr_name);
                    // return  $arr_name;
                    // $key->full_name = $arr_name[0].' '.$arr_name[1];
                    // return $key->full_name;
                    // $key
                }


                $dataPrepare = [
                    $key => $item,
                ];

                Customer::find($request->id)->update($dataPrepare);
            }


        }

        public function test_database(){
            $test = DB::connection('pgsql')->table('products')->get();

            return $test;
        }
}
