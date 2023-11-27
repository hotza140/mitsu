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
use App\Exports\dataExport;

class AirConditionerController extends Controller
{
    public function data_export(Request $r){
        $date_time=date('Y-m-d_h:i:s');
        // dd($date_time);
        $name="DataExport".$date_time;
        return Excel::download(new dataExport,"$name.xlsx");
    }
	
    public function index(Request $r){
        $data['page'] = 'air_conditioner';

		$date=date('Y-m-d');
		
		if($r->date_s!=null and $r->date_e!=null){
			$data['item'] = AirConditioner::orderby('id','desc')->with('customer')
				->whereDate('created_at', '>=', $r->date_s)
        		->whereDate('created_at', '<=', $r->date_e)
				->get();
		}else{
			$data['item'] = AirConditioner::orderby('id','desc')
				->whereDate('created_at',$date)
				->with('customer')->get();
		}
        
        // return $data['item'];
        $data['list'] = 'air_conditioner';
        return view('backend.conditioner.index',$data,[
			'date_s'=>$r->date_s,
			'date_e'=>$r->date_e,
		]);
    }

    public function details($id){
        $data['detail'] = AirConditioner::where('id',$id)->with('customer')->first();
        $data['list'] = 'air_conditioner';
        $data['page'] = 'air_conditioner';
        return view('backend.conditioner.detail',$data);
    }

    public function details_user($id,$item){
        $data['detail'] = AirConditioner::where('id',$id)->with('customer')->first();
        $data['list'] = 'air_conditioner';
        $data['item'] = $item;
        $data['page'] = 'air_conditioner';
        return view('backend.conditioner.detail',$data);
    }

    public function destroy($id){
        $item = AirConditioner::where('id',$id)->first();
        $item->delete();
        return redirect()->back()->with('success','Sucess!');
    }

    public function air_conditioner_edit(Request $r){
        $item = AirConditioner::where('id',$r->id)->first();
        $item->in_name=$r->in_name;
        $item->out_name=$r->out_name;

        $item->indoor_number=$r->indoor;
        $item->outdoor_number=$r->outdoor;
        $item->save();
        return redirect()->back()->with('success','Sucess!');
    }

}
