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

use App\Models\market;

use App\Models\banner;
use App\Models\product;
use App\Models\history_point;
use App\Models\news;
use App\Models\item_point;
use App\Models\buy_point;

use App\Models\province;
use App\Models\district;
use App\Models\amphur;

use App\Models\CarService;
use App\Models\TechnicianService;
use App\Models\ToolService;

use App\Wo_air_checkModel;

use App\Mail\Forget_email;
use App\Models\ToolPicture;
use App\Models\CarPicture;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\support\carbon;

use App\Models\AirConditioner;

use App\Exports\all_pointExport;

use App\Models\noti;

use App\Models\tb_log;

use App\Imports\UserImport;


class BackendController extends Controller

{

    public function aaa_2(){
        $user=history_point::where('id','>=',3622)->where('id','<=',4007)->get();
        foreach($user as $us){
                $aaa=AirConditioner::where('id',$us->id_air)->first();

                if($aaa!=null){
                $a1=$aaa->point;
                $a2=$aaa->point2;
                $sum=$a1-$a2;
                $aaa->point=$sum;
                $aaa->save();

                $bbb=history_point::where('id',$us->id)->first();
                if($bbb!=null){
                $bbb->point=$sum;
                $bbb->save();
                }
            }
        }

        $count=count($user);
        dd($count);

        return redirect()->back()->with('success','Success!');
    }
    


       ///Welcome---------------
       public function welcome(){
        return view('backend.welcome');
    }


    public function fix(){
        $user=User::where('type',5)->where('id','>',2)->where('id','<',2000)->orderby('id','asc')->get();
        // $year = date('Y');   
        $year=2023;
        foreach($user as $us){
                $aaa=User::where('id',$us->id)->first();
                $nm=$us->id;
                $num = str_pad($nm, 5, '0', STR_PAD_LEFT);
                $aaa->code = $year . 'H' . $num;

                $aaa->save();
        }

        return redirect()->back()->with('success','Success!');
    }

    public function fix2(){
        $user=User::where('type',5)->where('id','>',2000)->where('id','<',7000)->orderby('id','asc')->get();
        // $year = date('Y');
        $year=2023;
        foreach($user as $us){
                $aaa=User::where('id',$us->id)->first();
                $nm=$us->id;
                $num = str_pad($nm, 5, '0', STR_PAD_LEFT);
                $aaa->code = $year . 'H' . $num;

                $aaa->save();
        }

        return redirect()->back()->with('success','Success!');
    }

    public function fix3(){
        $user=User::where('type',5)->where('id','>',7000)->orderby('id','asc')->get();
        // $year = date('Y');
        $year=2023;
        foreach($user as $us){
                $aaa=User::where('id',$us->id)->first();
                $nm=$us->id;
                $num = str_pad($nm, 5, '0', STR_PAD_LEFT);
                $aaa->code = $year . 'H' . $num;

                $aaa->save();
        }

        return redirect()->back()->with('success','Success!');
    }


     ///Forget Password---------------

     public function forget_pass1($id){
        $user=User::where('forgot_code',$id)->first();

        return view('forget_pass',[
            'user'=>$user,
            'id'=>$id,
        ]);
    }

    public function change_pass(Request $r){
        $user=User::where('id',$r->id)->first();

        if($r->pass==$r->pass_check){
            $user->password=Hash::make($r->pass);
            $user->forgot_code=null;

            $user->save();
            return redirect()->back()->with('success','Change Password Success!');
        }else{
            return redirect()->back()->with('success','Password Not Match Please Try again!')->with('pass',$r->pass)
            ->with('pass_check',$r->pass_check);
        }
    }




    public function login_backend(Request $r)
    {
        
        if (Auth::attempt(['email' => $r->email, 'password' => $r->password])){
            if(Auth::user()->type < 5){
                if(Auth::user()->open == 0){
                    return redirect("/backend");
                }else{
                    Auth::logout();
                    return redirect()->to('/login')->with('success','You User Are Close!');
                }
            }else{
                Auth::logout();
                return redirect()->to('/login')->with('success','You Not Admin!');
            }
        }else{
            return redirect()->to('/login')->with('login','Email or Password Wrong!');
        }
    }

     ///LOGOUT---------------
    public function logout(){
        Auth::logout();
        return redirect()->to('/login')->with('success','Logout Sucess!');
    }

     ///register---------------
   public function register(){
        return view('auth/register');
    }

     ///verify---------------
    public function verify(){
        return view('auth/verify');
    }




      //noti//
      public function noti(){
        $item=noti ::orderby('id','desc')->get();
        return view('backend.noti.index',[
            'item'=>$item,
            'page'=>"noti",
            'list'=>"noti",
        ]);
    }
    public function noti_store(Request $r){
        $item = new noti();

        if($r->id_user!=null){
           $item->id_user = $r->id_user;
        }
        if($r->id_customer!=null){
           $item->id_customer = $r->id_customer;
        }
        if($r->id_work!=null){
           $item->id_work = $r->id_work;
        }
        if($r->titleth!=null){
           $item->titleth = $r->titleth;
        }
        if($r->detailth!=null){
           $item->detailth = $r->detailth;
        }
        if($r->status!=null){
           $item->status = $r->status;
        }

        $item->id_admin = Auth::user()->id;
   
        $item->save();

        

        return redirect()->to('/backend/noti')->with('success','Sucess!');

    }
    public function noti_update(Request $r,$id){
        $item=noti::where('id',$id)->first();
        
       if($r->id_user!=null){
          $item->id_user = $r->id_user;
       }
       if($r->id_customer!=null){
          $item->id_customer = $r->id_customer;
       }
       if($r->id_work!=null){
          $item->id_work = $r->id_work;
       }
       if($r->titleth!=null){
          $item->titleth = $r->titleth;
       }
       if($r->detailth!=null){
          $item->detailth = $r->detailth;
       }
       if($r->status!=null){
          $item->status = $r->status;
       }
  

       $item->id_admin = Auth::user()->id;

          $item->save();

        return redirect()->to('/backend/noti')->with('success','Sucess!');
    }
    public function noti_edit($id){
        $item=noti::where('id',$id)->first();
        return view('backend.noti.edit',[
            'item'=>$item,
            'page'=>"noti",
            'list'=>"noti",
        ]);
    }
    public function noti_destroy($id){
        $item=noti::where('id',$id)->first();
        $item->delete();
        return redirect()->back()->with('success','Sucess!');
    }
    public function noti_add(){
        return view('backend.noti.add',[
            'page'=>"noti",
            'list'=>"noti",
        ]);
    }
    //noti//




    //banner//
    public function banner(){
        $item=banner ::orderby('id','desc')->get();
        return view('backend.banner.index',[
            'item'=>$item,
            'page'=>"home",
            'list'=>"banner",
        ]);
    }
    public function banner_store(Request $r){
        $item=new banner();
        $item->titleth=$r->titleth;
        $item->titleen=$r->titleen;
        $item->detailth=$r->detailth;
        $item->detailen=$r->detailen;

        if($r->picture){
              $check= 'file/upload/' . $item->picture;
                    Storage::disk('s3')->delete($check);
            $file = $r->file('picture');
            $fileName = $_FILES['picture']['name'];
             $fileName = date('YmdHis').'_'.$fileName;
            $filePath = 'file/upload/' . $fileName;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $item->picture = $fileName;
            }

        $item->save();
        return redirect()->to('/backend/banner')->with('success','Sucess!');

    }
    public function banner_update(Request $r,$id){
        $item=banner::where('id',$id)->first();
        $item->titleth=$r->titleth;
        $item->titleen=$r->titleen;
        $item->detailth=$r->detailth;
        $item->detailen=$r->detailen;

        if($r->picture){
              $check= 'file/upload/' . $item->picture;
                    Storage::disk('s3')->delete($check);
            $file = $r->file('picture');
            $fileName = $_FILES['picture']['name'];
             $fileName = date('YmdHis').'_'.$fileName;
            $filePath = 'file/upload/' . $fileName;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $item->picture = $fileName;
            }

        $item->save();
        return redirect()->to('/backend/banner')->with('success','Sucess!');
    }
    public function banner_edit($id){
        $item=banner::where('id',$id)->first();
        return view('backend.banner.edit',[
            'item'=>$item,
            'page'=>"home",
            'list'=>"banner",
        ]);
    }
    public function banner_destroy($id){
        $item=banner::where('id',$id)->first();
          $check= 'file/upload/' . $item->picture;
                    Storage::disk('s3')->delete($check);
        $item->delete();
        return redirect()->back()->with('success','Sucess!');
    }
    public function banner_add(){
        return view('backend.banner.add',[
            'page'=>"home",
            'list'=>"banner",
        ]);
    }
    //banner//




     // OPEN/CLOSE-------USER
     public function open_close(Request $r){
        $item=User::where('id',$r->id)->first();
        if($item->id!=1){
            if($r->hidden==1){
                $item->open=0;
                $item->save();}
                else{
                $item->open=1;
                $item->save();}
        }
        return redirect()->back();
    }


     //admin_user//
     public function admin_user(){
        if(Auth::user()->type != 0){
            return redirect()->to('/backend')->with('success','You NOT Super Admin!');
        }
        $item=User ::where('type','<',5)->orderby('id','asc')->get();
        return view('backend.admin_user.index',[
            'item'=>$item,
            'page'=>"admin_user",
            'list'=>"admin_user",
        ]);
    }
    public function admin_user_store(Request $r){
        if(Auth::user()->type != 0){
            return redirect()->to('/backend')->with('success','You NOT Super Admin!');
        }
        $item=new User();
        $ch=User ::where('email',$r->email)->orderby('id','desc')->first();

        if($ch!=null){
            return redirect()->back()->with('success','Email Same in Data!');
            }
        $item->email=$r->email;

        if($r->password!=null){
            $item->password=Hash::make($r->password);
        }

        $item->type=$r->type;
        $item->name=$r->name;
        $item->email=$r->email;

        $item->save();

        return redirect()->to('/backend/admin_user')->with('success','Sucess!');

    }
    public function admin_user_update(Request $r,$id){
        if(Auth::user()->type != 0){
            return redirect()->to('/backend')->with('success','You NOT Super Admin!');
        }
        $item=User::where('id',$id)->first();
        $ch=User ::where('id','!=',$id)->where('email',$r->email)->orderby('id','desc')->first();

        if($ch!=null){
            return redirect()->back()->with('success','Email Same in Data!');
            }
        $item->email=$r->email;

        if($r->password!=null){
            $item->password=Hash::make($r->password);
        }

        $item->type=$r->type;
        $item->name=$r->name;
        $item->code=$r->code;
        $item->email=$r->email;

        $item->save();
        return redirect()->to('/backend/admin_user')->with('success','Sucess!');
    }
    public function admin_user_edit($id){
        if(Auth::user()->type != 0){
            return redirect()->to('/backend')->with('success','You NOT Super Admin!');
        }
        $item=User::where('id',$id)->first();
        return view('backend.admin_user.edit',[
            'item'=>$item,
            'page'=>"admin_user",
            'list'=>"admin_user",
        ]);
    }
    public function admin_user_destroy($id){
        if(Auth::user()->type != 0){
            return redirect()->to('/backend')->with('success','You NOT Super Admin!');
        }
        $item=User::where('id',$id)->first();
        $name='(delete)'.$item->id;
        $phone=000000;
        $item->name=$item->name.$name;
        $item->lastname=$item->lastname.$name;
        $item->email=$name.$item->email;
        $item->phone=$item->phone.$name;
        $item->save();
        $sss=User::where('id',$id)->first();
        $sss->delete();
        return redirect()->back()->with('success','Sucess!');
    }
    public function admin_user_add(){
        if(Auth::user()->type != 0){
            return redirect()->to('/backend')->with('success','You NOT Super Admin!');
        }
        return view('backend.admin_user.add',[
            'page'=>"admin_user",
            'list'=>"admin_user",
        ]);
    }
    //admin_user//





    public function user_gen(Request $r){
        $num='12345';
        $item=new User();

        $item->name=$r->name;
        $item->lastname=$r->lastname;
        $item->password = Hash::make($num);
        $item->type=5;
        // $item->save();

        return redirect()->to('/backend/user')->with('success','Sucess!');

    }

    public function user_excel(Request $request){
        if($request->file!=null){
            try {     
                Excel::import(new UserImport, $request->file);
                return redirect()->back()->with('success', 'Data Imported Successfully');
                } catch(Exception $e) {
                return redirect()->back()->with('success', 'Data Imported Fail.');
                }
        
        }else{
            return redirect()->back()->with('success', 'Data Imported Fail Please Choose File!');
        }
    }



// SERVICE
public function user_item($id){
    return view('backend.user.index_item',[
        'page'=>"user",
        'list'=>"user",
        'id'=>$id,
    ]);
}

    public function user_service($id){
        return view('backend.user.index_service',[
            'page'=>"user",
            'list'=>"user",
            'id'=>$id,
        ]);
    }
    public function gal_service($type,$id,$user){
        return view('backend.user.index_service_gal',[
            'page'=>"user",
            'list'=>"user",
            'id'=>$id,
            'type'=>$type,
            'user'=>$user,
        ]);
    }
    public function service_gal_destroy($type,$id){
        if($type==1){
            $item=CarPicture::where('id',$id)->first();
        }else{
            $item=ToolPicture::where('id',$id)->first();;
        }
        $check= 'file/upload/' . $item->picture;
        Storage::disk('s3')->delete($check);
       
        $item->delete();
        return redirect()->back()->with('success','Sucess!');
    }
    
    public function car_destroy($id){
        $item=CarService::where('id',$id)->first();

        $gal=CarPicture::where('car_service_id',$id)->get();
  

		foreach($gal as $gals){
			$gg=CarPicture::where('id',$gals->id)->first();
            $check= 'file/upload/' . $gg->picture;
            Storage::disk('s3')->delete($check);
			$gg->delete();
		}


        $item->delete();
        return redirect()->back()->with('success','Sucess!');
    }
    public function tool_destroy($id){
        $item=ToolService::where('id',$id)->first();

        $gal=ToolPicture::where('tool_service_id',$id)->get();
  

		foreach($gal as $gals){
			$gg=ToolPicture::where('id',$gals->id)->first();
            $check= 'file/upload/' . $gg->picture;
            Storage::disk('s3')->delete($check);
			$gg->delete();
		}

        $item->delete();
        return redirect()->back()->with('success','Sucess!');
    }
    public function tec_destroy($id){
        $item=TechnicianService::where('id',$id)->first();
        $item->delete();
        return redirect()->back()->with('success','Sucess!');
    }
    // SERVICE

       //user//
       public function user(Request $r){
        $search=$r->search;
        if($search!=null){
        $item=User::where(function($query) use($search){
            $query->orWhere('name', 'LIKE', '%'.$search.'%');
            $query->orWhere('code', 'LIKE', '%'.$search.'%');
            $query->orWhere('email', 'LIKE', '%'.$search.'%');
            $query->orWhere('phone', 'LIKE', '%'.$search.'%');
        })->where('type','>',2)->where('status',1)->orderby('id','desc')->paginate(20);
        }else{
            $item=User ::where('type','>',2)->where('status',1)->orderby('id','desc')->paginate(20);
        }

        
        return view('backend.user.index',[
            'item'=>$item,
            'page'=>"user",
            'list'=>"user",
        ]);
    }
    public function user_store(Request $r){
        $item=new User();
        $ch=User::where('email',$r->email)->where('type','>',2)->first();

        if($ch!=null){
            return redirect()->back()->with('success','Email Same in Data!');
            }

            if($r->password!=null){
                $item->password=Hash::make($r->password);
            }
    
                    $item->market = $r->market;
                    $item->nickname = $r->nickname;
                    $item->name = $r->name;
                    $item->lastname = $r->lastname;
                    $item->email = $r->email;
                    $item->phone = $r->phone;
                    $item->line = $r->line;
    
                  
                    $item->house = $r->house;
                    $item->moo = $r->moo;
                    $item->condo = $r->condo;
                    $item->road = $r->road;


                    $item->work_province = $r->work_province;
                    $item->work_amupur = $r->work_amupur;
                    $item->work_district = $r->work_district;

                        if($r->bank_number!=null){
                            $item->bank_number=$r->bank_number;
                        }
                        
                        if($r->bank_title!=null){
                        $item->bank_title=$r->bank_title;
                        }
            
                        if($r->bank_name!=null){
                        $item->bank_name=$r->bank_name;
                        }
    
                    $item->zipcode = $r->zipcode;
                    $p = province::where('name_th',"LIKE","%{$r->province}%",)->first();
                    if ($p != null) {
                        $item->id_p = $p->id;
                        $item->province = $r->province;
                    }
                    $d = district::where('name_th',"LIKE","%{$r->district}%",)->first();
                    if ($d != null) {
                        $item->id_d = $d->id;
                        $item->district = $r->district;
                    }
                    $a = amphur::where('name_th',"LIKE","%{$r->amphur}%",)->first();
                    if ($a != null) {
                        $item->id_a = $a->id;
                        $item->amphur = $r->amphur;
                    }
    

        $item->status=1;
        $item->type=5;
        $item->save();

        return redirect()->to('/backend/user')->with('success','Sucess!');

    }
    public function user_update(Request $r,$id){
        $item=User::where('id',$id)->first();
        // $ch=User::where('id','!=',$id)->where('email',$r->email)->first();

        // if($ch!=null){
        //     return redirect()->back()->with('success','Email Same in Data!');
        // }


        // if($r->password!=null){
        //     $item->password=Hash::make($r->password);
        // }

            // MARKET
            // $item->id_market = $r->market;
            // $mm = market::where('id', $r->market)->first();
            // if($mm){
            //     $item->market = $mm->titleen;
            // }
            // MARKET

                $item->nickname = $r->nickname;
                $item->name = $r->name;
                $item->lastname = $r->lastname;
                $item->email = $r->email;
                $item->phone = $r->phone;
                $item->code = $r->code;

                $item->work_province = $r->work_province;
                $item->work_amupur = $r->work_amupur;
                $item->work_district = $r->work_district;
                

                if($r->bank_number!=null){
                    $item->bank_number=$r->bank_number;
                }
                
                if($r->bank_title!=null){
                $item->bank_title=$r->bank_title;
                }
    
                if($r->bank_name!=null){
                $item->bank_name=$r->bank_name;
                }


                // $item->line = $r->line;
                // $item->house = $r->house;
                // $item->moo = $r->moo;
                // $item->condo = $r->condo;
                // $item->road = $r->road;

                // $item->zipcode = $r->zipcode;
                // $p = province::where('name_th',"LIKE","%{$r->province}%",)->first();
                // if ($p != null) {
                //     $item->id_p = $p->id;
                //     $item->province = $r->province;
                // }
                // $d = district::where('name_th',"LIKE","%{$r->district}%",)->first();
                // if ($d != null) {
                //     $item->id_d = $d->id;
                //     $item->district = $r->district;
                // }
                // $a = amphur::where('name_th',"LIKE","%{$r->amphur}%",)->first();
                // if ($a != null) {
                //     $item->id_a = $a->id;
                //     $item->amphur = $r->amphur;
                // }


        $item->save();
        return redirect()->back()->with('success','Sucess!');
    }
    public function user_edit($id){
        $item=User::where('id',$id)->first();
        return view('backend.user.edit',[
            'item'=>$item,
            'id'=>$id,
            'page'=>"user",
            'list'=>"user",
        ]);
    }
    public function user_destroy($id){
        $item=User::where('id',$id)->first();

        $name='(delete)'.$item->id;
        $phone=000000;
        $item->name=$item->name.$name;
        $item->lastname=$item->lastname.$name;
        $item->email=$name.$item->email;
        $item->phone=$item->phone.$name;
        $item->save();
        $sss=User::where('id',$id)->first();
        $sss->delete();

        // $de=product::where('id_user',$id)->delete();
        // $de2=history_point::where('id_user',$id)->delete();
        // $item->delete();
        return redirect()->back()->with('success','Sucess!');
    }
    public function user_add(){
        return view('backend.user.add',[
            'page'=>"user",
            'list'=>"user",
        ]);
    }
    //user//




    

        //wait_user//
        public function wait_user_not(Request $r,$id){
            $item=User::where('id',$id)->first();

            $admin_email=Auth::user()->email;
            $phone=$item->phone;
            $item->delete();

              // ส่ง sms รหัส--------------
              if($phone!=null){
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
                "message": "การสมัครสมาชิกของท่านถูกผู้ดูแล' . $admin_email . 'ปฎิเสธกรุณาติดต่อแอดมินหรือผู้ดูแลระบบ Heavy One Clickอีกครั้ง"
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

            
            return redirect()->to('/backend/wait_user')->with('success','Sucess!');
        }

        public function wait_user(){
            $item=User ::where('type','>',2)->where('status',0)->orderby('id','desc')->get();
            return view('backend.wait_user.index',[
                'item'=>$item,
                'page'=>"user",
                'list'=>"wait_user",
            ]);
        }
        public function wait_user_store(Request $r){
            $item=new User();
            $ch=User::where('email',$r->email)->where('type','>',2)->first();
            $item->status=1;

            $item->save();

            return redirect()->to('/backend/wait_user')->with('success','Sucess!');

        }
        public function wait_user_update(Request $r,$id){
            $item=User::where('id',$id)->first();

            $item->status=1;

            $item->save();

            $admin_email=Auth::user()->email;
            $phone=$item->phone;

              // ส่ง sms รหัส--------------
              if($phone!=null){
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
                "message": "การสมัครสมาชิกเสร็จสมบูรณ์ โดยยืนยันผ่านผู้ดูแล' . $admin_email . 'ท่านสามารถล็อคอินเข้าใช้งานระบบ Heavy One Click ได้แล้ว"
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
                 
            return redirect()->to('/backend/wait_user')->with('success','Sucess!');
        }
        public function wait_user_edit($id){
            $item=User::where('id',$id)->first();
            return view('backend.wait_user.edit',[
                'item'=>$item,
                'page'=>"user",
                'list'=>"wait_user",
            ]);
        }
        public function wait_user_destroy($id){
            $item=User::where('id',$id)->first();
            $item->delete();
            return redirect()->back()->with('success','Sucess!');
        }
        public function wait_user_add(){
            return view('backend.wait_user.add',[
                'page'=>"user",
                'list'=>"wait_user",
            ]);
        }
        //wait_user//





         //tech_service//
         public function tech_service_not(Request $r,$id){
            $item=TechnicianService::where('id',$id)->first();
            $item->delete();
            
            return redirect()->to('/backend/tech_service')->with('success','Sucess!');
        }

        public function tech_service(){
            $item=TechnicianService ::where('status',0)->orderby('id','desc')->get();
            return view('backend.tech_service.index',[
                'item'=>$item,
                'page'=>"tech_service",
                'list'=>"tech_service",
            ]);
        }
        public function tech_service_store(Request $r){
            $item=new TechnicianService();
            $ch=TechnicianService::where('email',$r->email)->first();
            $item->status=1;

            $item->save();

            return redirect()->to('/backend/tech_service')->with('success','Sucess!');

        }
        public function tech_service_update(Request $r,$id){
            $item=TechnicianService::where('id',$id)->first();

            $item->status=1;

            $item->save();

            $admin_email=Auth::user()->email;
            $phone=$item->phone;

              // ส่ง sms รหัส--------------
              if($phone!=null){
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
                "message": "การสมัครเป็นช่างบริการเครือข่าย โดยยืนยันผ่านผู้ดูแล' . $admin_email . '"
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
                 
            return redirect()->to('/backend/tech_service')->with('success','Sucess!');
        }
        public function tech_service_edit($id){
            $item=TechnicianService::where('id',$id)->first();
            return view('backend.tech_service.edit',[
                'item'=>$item,
                'page'=>"tech_service",
                'list'=>"tech_service",
            ]);
        }
        public function tech_service_destroy($id){
            $item=TechnicianService::where('id',$id)->first();
            $item->delete();
            return redirect()->back()->with('success','Sucess!');
        }
        public function tech_service_add(){
            return view('backend.tech_service.add',[
                'page'=>"tech_service",
                'list'=>"tech_service",
            ]);
        }
        //tech_service//






        //product//
    public function product(){
        $item=product ::orderby('id','desc')->get();
        return view('backend.product.index',[
            'item'=>$item,
            'page'=>"user",
            'list'=>"user",
        ]);
    }
    public function product_store(Request $r){
        $item=new product();
        $code=rand(11111111,99999999);
        $ii=product::where('code',$code)->first();
        if($ii!=null){
           return redirect()->back()->with('success','Code Same in data Please Try Again!');
        }

        $date=date('Y-m-d H:i:s');

        $item->titleth=$r->titleth;
        $item->detailth=$r->detailth;
        $item->desth=$r->desth;
        $item->price=$r->price;
        $item->code=$code;
        $item->date=$date;

        $item->id_user=$r->id_user;

        if($r->picture){
              $check= 'file/upload/' . $item->picture;
                    Storage::disk('s3')->delete($check);
            $file = $r->file('picture');
            $fileName = $_FILES['picture']['name'];
             $fileName = date('YmdHis').'_'.$fileName;
            $filePath = 'file/upload/' . $fileName;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $item->picture = $fileName;
            }

        $item->save();
        return redirect()->to('/backend/user_edit/'.$item->id_user)->with('success','Sucess!');
        // return redirect()->back()->with('success','Sucess!');

    }
    public function product_update(Request $r,$id){
        $item=product::where('id',$id)->first();
        $item->titleth=$r->titleth;
        $item->detailth=$r->detailth;
        $item->desth=$r->desth;
        $item->price=$r->price;

        if($r->picture){
              $check= 'file/upload/' . $item->picture;
                    Storage::disk('s3')->delete($check);
            $file = $r->file('picture');
            $fileName = $_FILES['picture']['name'];
             $fileName = date('YmdHis').'_'.$fileName;
            $filePath = 'file/upload/' . $fileName;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $item->picture = $fileName;
            }

        $item->save();
        return redirect()->to('/backend/user_edit/'.$item->id_user)->with('success','Sucess!');
        // return redirect()->back()->with('success','Sucess!');
    }
    public function product_edit($id){
        $item=product::where('id',$id)->first();
        return view('backend.product.edit',[
            'item'=>$item,
            'id'=>$id,
            'page'=>"user",
            'list'=>"user",
        ]);
    }
    public function product_destroy($id){
        $item=product::where('id',$id)->first();
          $check= 'file/upload/' . $item->picture;
                    Storage::disk('s3')->delete($check);
        $item->delete();
        return redirect()->back()->with('success','Sucess!');
    }
    public function product_add($id){
        return view('backend.product.add',[
            'id'=>$id,
            'page'=>"user",
            'list'=>"user",
        ]);
    }
    //product//




    // History Point//

    public function history_point_store(Request $r){
        $item=new history_point();
        $item->title='เพิ่มแต้มโดย ADMIN ('.Auth::user()->email.')';
        $item->point=$r->point;
        $item->id_user=$r->id_user;
        $item->date=date('Y-m-d H:i:s');
        $item->save();

        $user=User::where('id',$r->id_user)->first();
        $point=$user->point;
        $user->point=$point+$r->point;
        $user->save();

        return redirect()->back()->with('success','Sucess!');
    }

    public function history_point_destroy($id){
        $item=history_point::where('id',$id)->first();

        // $user=User::where('id',$item->id_user)->first();
        // if($user!=null){
        // $point=$user->point;
        // $user->point=$point-$item->point;
        // $user->save();
        // }

        $item->delete();
        return redirect()->back()->with('success','Sucess!');
    }

     // History Point//






        // เรียงลำดับ News
    public function numupdate(Request $request){
        if(isset($request->num)) {
            $num  = $request->num;
            for($i=0; $i < count($num);$i++) {
                $sql = news::where("id",$num[$i])->update([
                    'num'=>$i
                ]);
            }
        }
     return response()->json($sql);
    }
    // เรียงลำดับ


    // Choose
      public function news_choose(Request $r){
        if($r->ajax()){
        $item=news::where('id',$r->id)->first();
            if($item->choose==1){
                $item->choose=0;
                $item->save();}
                else{
                $item->choose=1;
                $item->save();}
        $status='success';
        }else{
            $status='not';
        }
        return response()->json($status);
    }
    // Choose




          //news//


           public function news(){
            $item=news ::orderby('num','asc')->get();
            return view('backend.news.index',[
                'item'=>$item,
                'page'=>"news",
                'list'=>"news",
            ]);
        }
        public function news_store(Request $r){
            $item=new news();
            $item->titleth=$r->titleth;
            $item->titleen=$r->titleen;
            $item->detailth=$r->detailth;
            $item->detailen=$r->detailen;

            $item->desth=$r->desth;
            $item->desen=$r->desen;
            $item->link=$r->link;



            if($r->picture){
                   $check= 'file/upload/' . $item->picture;
                    Storage::disk('s3')->delete($check);
                $file = $r->file('picture');
                $fileName = $_FILES['picture']['name'];
                 $fileName = date('YmdHis').'_'.$fileName;
                $filePath = 'file/upload/' . $fileName;
                Storage::disk('s3')->put($filePath, file_get_contents($file));
                $item->picture = $fileName;
                }


            $item->save();
            return redirect()->to('/backend/news')->with('success','Sucess!');

        }
        public function news_update(Request $r,$id){
            $item=news::where('id',$id)->first();
            $item->titleth=$r->titleth;
            $item->titleen=$r->titleen;
            $item->detailth=$r->detailth;
            $item->detailen=$r->detailen;

            $item->desth=$r->desth;
            $item->desen=$r->desen;
            $item->link=$r->link;

            if($r->picture){
                   $check= 'file/upload/' . $item->picture;
                    Storage::disk('s3')->delete($check);
                $file = $r->file('picture');
                $fileName = $_FILES['picture']['name'];
                 $fileName = date('YmdHis').'_'.$fileName;
                $filePath = 'file/upload/' . $fileName;
                Storage::disk('s3')->put($filePath, file_get_contents($file));
            $item->picture = $fileName;
                }

            $item->save();
            return redirect()->to('/backend/news')->with('success','Sucess!');
        }
        public function news_edit($id){
            $item=news::where('id',$id)->first();
            return view('backend.news.edit',[
                'item'=>$item,
                'page'=>"news",
                'list'=>"news",
            ]);
        }
        public function news_destroy($id){
            $item=news::where('id',$id)->first();
            $check= 'file/upload/' . $item->picture;
                    Storage::disk('s3')->delete($check);
            $item->delete();
            return redirect()->back()->with('success','Sucess!');
        }
        public function news_add(){
            return view('backend.news.add',[
                'page'=>"news",
                'list'=>"news",
            ]);
        }
        //news//






            //market//


            public function market(){
                $item=market ::orderby('id','desc')->get();
                return view('backend.market.index',[
                    'item'=>$item,
                    'page'=>"market",
                    'list'=>"market",
                ]);
            }
            public function market_store(Request $r){
                $item=new market();
                $item->titleth=$r->titleth;
                $item->titleen=$r->titleen;
    
                $item->save();
                return redirect()->to('/backend/market')->with('success','Sucess!');
    
            }
            public function market_update(Request $r,$id){
                $item=market::where('id',$id)->first();
                $jj=$item->titleen;
                $item->titleth=$r->titleth;
                $item->titleen=$r->titleen;
                
                if($jj!=$r->titleen){
                    $user=DB::table('users')->where('id_market',$id)->update(['market' => $r->titleen]);
                }

    
                $item->save();
                return redirect()->to('/backend/market')->with('success','Sucess!');
            }
            public function market_edit($id){
                $item=market::where('id',$id)->first();
                return view('backend.market.edit',[
                    'item'=>$item,
                    'page'=>"market",
                    'list'=>"market",
                ]);
            }
            public function market_destroy($id){
                $item=market::where('id',$id)->first();
                $item->delete();
                return redirect()->back()->with('success','Sucess!');
            }
            public function market_add(){
                return view('backend.market.add',[
                    'page'=>"market",
                    'list'=>"market",
                ]);
            }
            //market//


        //================ AJAX ===================

        public function get_amphure($id){
            // $province_code = province::where('id',$id)->first();
            $amphure = amphur::where('province_id',$id)->get();

            return $amphure;
        }

        public function get_district($id){
            $district = district::where('amphure_id',$id)->get();

            return $district;
        }

        public function get_postcode($id){
            $district = district::where('id',$id)->first();
            $postcode = $district->zip_code;

            return $postcode;
        }





          // Choose item_point
      public function item_point_choose(Request $r){
        if($r->ajax()){
        $item=item_point::where('id',$r->id)->first();
            if($item->choose==1){
                $item->choose=0;
                $item->save();}
                else{
                $item->choose=1;
                $item->save();}
        $status='success';
        }else{
            $status='not';
        }
        return response()->json($status);
    }
    // Choose item_point


    public function wait_point(){
        return view('backend.item_point.index_wait',[
            'page'=>"item_point",
            'list'=>"wait_point",
        ]);
    }
    public function wait_destroy($id){
        $item=buy_point::where('id',$id)->first();
        $item->delete();
        return redirect()->back()->with('success','Sucess!');
    }
    public function wait_con($id){
        $item=buy_point::where('id',$id)->first();
        $item->status=1;
        $item->save();

        $aaa = new noti();
           $aaa->id_user = $item->id_user;
           $aaa->id_item = $item->id_item;
        
           $aaa->titleth = 'การแลกเปลี่ยนสินค้าของคุณได้รับการยืนยันแล้ว ชื่อสินค้า/'.$item->title;
           $aaa->detailth = 'กรุณารอสินค้าส่งไปถึง';

        $aaa->id_admin = Auth::user()->id;
   
        $aaa->save();
        
        return redirect()->back()->with('success','Sucess!');
    }
    public function wait_not($id){
        $item=buy_point::where('id',$id)->first();
        $user=User::where('id',$item->id_user)->first();
        if($user!=null){
        $point=$user->point;
        $user->point=$point+$item->buy_point;
        $user->save();
        }
        
        $item->status=2;
        $item->save();

        $aaa = new noti();
        $aaa->id_user = $item->id_user;
        $aaa->id_item = $item->id_item;
     
        $aaa->titleth = 'การแลกเปลี่ยนสินค้าของคุณถูกยกเลิก ชื่อสินค้า/'.$item->title;
        $aaa->detailth = 'กรุณาติดต่อเจ้าหน้าที่';

        $aaa->id_admin = Auth::user()->id;

        $aaa->save();

        
        return redirect()->back()->with('success','Sucess!');
    }

            //item_point//


            public function item_point(){
                $item=item_point ::orderby('id','desc')->get();
                return view('backend.item_point.index',[
                    'item'=>$item,
                    'page'=>"item_point",
                    'list'=>"item_point",
                ]);
            }
            public function item_point_store(Request $r){
                $item=new item_point();
                $item->titleth=$r->titleth;
                $item->titleen=$r->titleen;
                $item->detailth=$r->detailth;
                $item->detailen=$r->detailen;
    
                $item->desth=$r->desth;
                $item->desen=$r->desen;
                $item->point=$r->point;

                $item->date_start=$r->date_start;
                $item->date_end=$r->date_end;
                $item->locationth=$r->locationth;
                $item->locationen=$r->locationen;

                if($r->picture){
                    $check= 'file/upload/' . $item->picture;
                    Storage::disk('s3')->delete($check);
                    $file = $r->file('picture');
                    $fileName = $_FILES['picture']['name'];
                     $fileName = date('YmdHis').'_'.$fileName;
                    $filePath = 'file/upload/' . $fileName;
                    Storage::disk('s3')->put($filePath, file_get_contents($file));
            $item->picture = $fileName;
                    }
    
                $item->save();
                return redirect()->to('/backend/item_point')->with('success','Sucess!');
    
            }
            public function item_point_update(Request $r,$id){
                $item=item_point::where('id',$id)->first();
                $item->titleth=$r->titleth;
                $item->titleen=$r->titleen;
                $item->detailth=$r->detailth;
                $item->detailen=$r->detailen;
    
                $item->desth=$r->desth;
                $item->desen=$r->desen;
                $item->point=$r->point;

                $item->date_start=$r->date_start;
                $item->date_end=$r->date_end;
                $item->locationth=$r->locationth;
                $item->locationen=$r->locationen;
    
                if($r->picture){
                    $check= 'file/upload/' . $item->picture;
                    Storage::disk('s3')->delete($check);
                    $file = $r->file('picture');
                    $fileName = $_FILES['picture']['name'];
                     $fileName = date('YmdHis').'_'.$fileName;
                    $filePath = 'file/upload/' . $fileName;
                    Storage::disk('s3')->put($filePath, file_get_contents($file));
            $item->picture = $fileName;
                    }
    
                $item->save();
                return redirect()->to('/backend/item_point')->with('success','Sucess!');
            }
            public function item_point_edit($id){
                $item=item_point::where('id',$id)->first();
                return view('backend.item_point.edit',[
                    'item'=>$item,
                    'page'=>"item_point",
                    'list'=>"item_point",
                ]);
            }
            public function item_point_destroy($id){
                $item=item_point::where('id',$id)->first();
                // $check= 'file/upload/' . $item->picture;
                //     Storage::disk('s3')->delete($check);
                $item->delete();
                return redirect()->back()->with('success','Sucess!');
            }
            public function item_point_add(){
                return view('backend.item_point.add',[
                    'page'=>"item_point",
                    'list'=>"item_point",
                ]);
            }
            //item_point//










                //all_point//

                public function all_point_export(Request $r){
                    $date_time=date('Y-m-d_h:i:s');
                    // dd($date_time);
                    $name="All_pointExport".$date_time;
                    return Excel::download(new all_pointExport,"$name.xlsx");
                }


                public function all_point(Request $r){
                    // $item=buy_point::orderby('id','desc')->get();
                    return view('backend.all_point.index',[
                        // 'item'=>$item,
                        'page'=>"item_point",
                        'list'=>"all_point",
                        'date_s'=>$r->date_s,
			            'date_e'=>$r->date_e,
                    ]);
                }
                public function all_point_store(Request $r){
                    $item=new buy_point();
        
                    $item->save();
                    return redirect()->to('/backend/all_point')->with('success','Sucess!');
        
                }
                public function all_point_update(Request $r,$id){
                    $item=buy_point::where('id',$id)->first();
                    $item->save();
                    return redirect()->to('/backend/all_point')->with('success','Sucess!');
                }
                public function all_point_edit($id){
                    $item=buy_point::where('id',$id)->first();
                    return view('backend.all_point.edit',[
                        'item'=>$item,
                        'page'=>"item_point",
                        'list'=>"all_point",
                    ]);
                }
                public function all_point_destroy($id){
                    $item=buy_point::where('id',$id)->first();
                    $item->delete();
                    return redirect()->back()->with('success','Sucess!');
                }
                public function all_point_add(){
                    return view('backend.all_point.add',[
                        'page'=>"item_point",
                        'list'=>"all_point",
                    ]);
                }
                //all_point//
    



}
