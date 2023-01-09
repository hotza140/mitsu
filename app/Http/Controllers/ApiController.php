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

use App\Models\banner;
use App\Models\product;
use App\Models\history_point;
use App\Models\news;

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
     



       ///Register  User///
       public function api_register_user(Request $r){
        $check=User::where('email',$r->email)->first();
        if($check==null){
            $user=new User();
            $user->name=$r->name;
            $user->email=$r->email;
            $user->password=Hash::make($r->password);
            $user->type=5;
            $user->code=rand(11111111,99999999);
            $user->status=0;
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
            ]);
			
        }
     
    }
     ///Register  User///



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
         ]);
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
                ]);
                
            }
         
        }
         ///Add  Product USER///


            ///Delete  Product USER///
        public function api_delete_product_user(Request $r){
            $check=product::where('id',$r->id)->first();
            if($check==null){

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
                ]);
                
            }
         
        }
         ///Delete  Product USER///





           ///NEWS///
        public function api_news(){
            $news=news::orderby('id','desc')->get();
    
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
                $province=province::orderby('id','desc')->get();
                $district=district::orderby('id','desc')->get();
                $amphur=amphur::orderby('id','desc')->get();
        
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
     





}