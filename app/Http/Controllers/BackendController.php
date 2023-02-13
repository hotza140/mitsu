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
use App\Models\item_point;
use App\Models\buy_point;

use App\Models\province;
use App\Models\district;
use App\Models\amphur;


use App\Mail\Forget_email;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\support\carbon;


class BackendController extends Controller

{

       ///Welcome---------------
       public function welcome(){
        return view('backend.welcome');
    }


     ///Forget Password---------------

     public function forget_pass($id){
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

        if($r->picture!=null){
            $picture = $_FILES['picture']['name'];
            $r->picture->move(public_path() . '/img/upload', $picture);
            $item->picture = $picture;}

        $item->save();
        return redirect()->to('/backend/banner')->with('success','Sucess!');

    }
    public function banner_update(Request $r,$id){
        $item=banner::where('id',$id)->first();
        $item->titleth=$r->titleth;
        $item->titleen=$r->titleen;
        $item->detailth=$r->detailth;
        $item->detailen=$r->detailen;

        if(isset($r->picture)){
            $path =public_path().'/img/upload/'.$item->picture;
            if(File::exists($path)){
            File::delete($path);
            }
            $picture = $_FILES['picture']['name'];
            $r->picture->move(public_path() . '/img/upload', $picture);
            $item->picture = $picture;}

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
        $path =public_path().'/img/upload/'.$item->picture;
        if(File::exists($path)){
        File::delete($path);
        }
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
        $item->delete();
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





       //user//
       public function user(){
        $item=User ::where('type','>',2)->where('status',1)->orderby('id','desc')->get();
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

        $item->name=$r->name;
        $item->email=$r->email;
        if($r->password!=null){
            $item->password=Hash::make($r->password);
        }

        $item->type=5;

        // if($r->picture!=null){
        //     $picture = $_FILES['picture']['name'];
        //     $r->picture->move(public_path() . '/img/upload', $picture);
        //     $item->picture = $picture;}
        $item->save();

        return redirect()->to('/backend/user')->with('success','Sucess!');

    }
    public function user_update(Request $r,$id){
        $item=User::where('id',$id)->first();
        $ch=User::where('id','!=',$id)->where('email',$r->email)->first();

        if($ch!=null){
            return redirect()->back()->with('success','Email Same in Data!');
        }

        $item->name=$r->name;
        $item->email=$r->email;
        if($r->password!=null){
            $item->password=Hash::make($r->password);
        }

        // if(isset($r->picture)){
        //     $path =public_path().'/img/upload/'.$item->picture;
        //     if(File::exists($path)){
        //     File::delete($path);
        //     }
        //     $picture = $_FILES['picture']['name'];
        //     $r->picture->move(public_path() . '/img/upload', $picture);
        //     $item->picture = $picture;}

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
        $de=product::where('id_user',$id)->delete();
        $de2=history_point::where('id_user',$id)->delete();
        // $path =public_path().'/img/upload/'.$item->picture;
        // if(File::exists($path)){
        // File::delete($path);
        // }
        $item->delete();
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

        if($r->picture!=null){
            $picture = $_FILES['picture']['name'];
            $r->picture->move(public_path() . '/img/upload', $picture);
            $item->picture = $picture;}

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

        if(isset($r->picture)){
            $path =public_path().'/img/upload/'.$item->picture;
            if(File::exists($path)){
            File::delete($path);
            }
            $picture = $_FILES['picture']['name'];
            $r->picture->move(public_path() . '/img/upload', $picture);
            $item->picture = $picture;}

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
        $path =public_path().'/img/upload/'.$item->picture;
        if(File::exists($path)){
        File::delete($path);
        }
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
        $item->title='เพิ่มแต้มโดย ADMIN';
        $item->point=$r->point;
        $item->id_user=$r->id_user;
        $item->date=date('Y-m-d H:i:s');
        $item->save();

        $user=User::where('id',$r->id_user)->first();
        if($user!=null){
        $point=$user->point;
        $user->point=$point+$r->point;
        $user->save();
        }

        return redirect()->back()->with('success','Sucess!');
    }

    public function history_point_destroy($id){
        $item=history_point::where('id',$id)->first();

        $user=User::where('id',$item->id_user)->first();
        if($user!=null){
        $point=$user->point;
        $user->point=$point-$item->point;
        $user->save();
        }

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

            if(isset($r->picture)){
                $path =public_path().'/img/upload/'.$item->picture;
                if(File::exists($path)){
                File::delete($path);
                }
                $picture = $_FILES['picture']['name'];
                $r->picture->move(public_path() . '/img/upload', $picture);
                $item->picture = $picture;}

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

            if(isset($r->picture)){
                $path =public_path().'/img/upload/'.$item->picture;
                if(File::exists($path)){
                File::delete($path);
                }
                $picture = $_FILES['picture']['name'];
                $r->picture->move(public_path() . '/img/upload', $picture);
                $item->picture = $picture;}

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
            $path =public_path().'/img/upload/'.$item->picture;
            if(File::exists($path)){
            File::delete($path);
            }
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


        //================ AJAX ===================

        public function get_amphure($id){
            $province_code = province::where('id',$id)->first();
            $amphure = amphur::where('province_code',$province_code->code)->get();

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
    
                if(isset($r->picture)){
                    $path =public_path().'/img/upload/'.$item->picture;
                    if(File::exists($path)){
                    File::delete($path);
                    }
                    $picture = $_FILES['picture']['name'];
                    $r->picture->move(public_path() . '/img/upload', $picture);
                    $item->picture = $picture;}
    
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
    
                if(isset($r->picture)){
                    $path =public_path().'/img/upload/'.$item->picture;
                    if(File::exists($path)){
                    File::delete($path);
                    }
                    $picture = $_FILES['picture']['name'];
                    $r->picture->move(public_path() . '/img/upload', $picture);
                    $item->picture = $picture;}
    
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
                $path =public_path().'/img/upload/'.$item->picture;
                if(File::exists($path)){
                File::delete($path);
                }
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



}
