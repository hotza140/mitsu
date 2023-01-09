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
            $user->status=0;

            $user->lastname=$r->lastname;
            $user->market=$r->market;
            $user->phone=$r->phone;

            $user->token=random_bytes(12);

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



       ///EDIT  User///
       public function api_edit_user(Request $r){
        $user=User::where('id',$r->id_user)->first();
        if($user==null){
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
            ]);
			
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
                      'token'=>$password->token,
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
     





}