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

use App\Models\Customer;
use App\Models\AirConditioner;

use App\Mail\Forget_email;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\support\carbon;

class AirConditionerController extends Controller
{
    public function index(){
        $data['page'] = 'air_conditioner';

        $data['item'] = AirConditioner::orderby('id','asc')->with('customer')->get();
        // return $data['item'];
        $data['list'] = 'air_conditioner';
        return view('backend.conditioner.index',$data);
    }

    public function details($id){
        $data['detail'] = AirConditioner::where('id',$id)->with('customer')->first();
        $data['list'] = 'air_conditioner';

        return view('backend.conditioner.detail',$data);
    }

    public function details_user($id,$item){
        $data['detail'] = AirConditioner::where('id',$id)->with('customer')->first();
        $data['list'] = 'air_conditioner';

        return view('backend.conditioner.detail',$data,$item);
    }

    public function destroy($id){
        $item = Customer::where('id',$id)->first();
        $item->delete();
        return redirect()->back()->with('success','Sucess!');
    }

}
