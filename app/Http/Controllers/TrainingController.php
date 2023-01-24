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
use App\Models\Training;

use App\Mail\Forget_email;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\support\carbon;

class TrainingController extends Controller
{
    public function index(){
        $data['page'] = 'training';

        $data['item'] = AirConditioner::orderby('id','asc')->with('customer')->get();
        // return $data['item'];
        $data['list'] = 'training';
        return view('backend.training.index',$data);
    }

    public function add(){
        $data['page'] = 'training';
        $data['list'] = 'training';
        return view('backend.training.add',$data);
    }

    public function edit($id){
        $data['detail'] = Training::where('id',$id)->first();
        $data['list'] = 'training';

        return view('backend.training.edit',$data);
    }

    public function destroy($id){
        $item = Customer::where('id',$id)->first();
        $item->delete();
        return redirect()->back()->with('success','Sucess!');
    }

}
