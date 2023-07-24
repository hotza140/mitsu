<?php

namespace App\Http\Controllers;

// use App\Http\Requests\AirModelCreateRequest;
use Illuminate\Http\Request;
use App\Air_listModel;
use DB;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

use Maatwebsite\Excel\Facades\Excel;

use App\Imports\Model_listImport;

class Air_listController extends Controller
{
    //air_model_list//


    public function air_model_list(){
        $item=Air_listModel ::orderby('id','desc')->get();
        return view('backend.air_model_list.index',[
            'item'=>$item,
            'page'=>"air_conditioner",
            'list'=>"air_model_list",
        ]);
    }


    public function air_model_list_excel(Request $request){
        if($request->file!=null){
            try {     
                Excel::import(new Model_listImport, $request->file);
                return redirect()->back()->with('success', 'Data Imported Successfully');
                } catch(Exception $e) {
                return redirect()->back()->with('success', 'Data Imported Fail.');
                }
        
        }else{
            return redirect()->back()->with('success', 'Data Imported Fail Please Choose File!');
        }
    }


    public function air_model_list_store(Request $r){
        $item=new Air_listModel();
        
        $item->model=$r->model;

        $item->min1=$r->min1;
        $item->stan1=$r->stan1;
        $item->max1=$r->max1;

        $item->min2=$r->min2;
        $item->stan2=$r->stan2;
        $item->max2=$r->max2;

        $item->min3=$r->min3;
        $item->stan3=$r->stan3;
        $item->max3=$r->max3;

        $item->min4=$r->min4;
        $item->stan4=$r->stan4;
        $item->max4=$r->max4;

        $item->min5=$r->min5;
        $item->stan5=$r->stan5;
        $item->max5=$r->max5;

        $item->min6=$r->min6;
        $item->stan6=$r->stan6;
        $item->max6=$r->max6;

        $item->sum=$r->sum;


        $item->save();
        return redirect()->to('/backend/air_model_list')->with('success','Sucess!');

    }
    public function air_model_list_update(Request $r,$id){
        $item=Air_listModel::where('id',$id)->first();

        $item->model=$r->model;

        $item->min1=$r->min1;
        $item->stan1=$r->stan1;
        $item->max1=$r->max1;

        $item->min2=$r->min2;
        $item->stan2=$r->stan2;
        $item->max2=$r->max2;

        $item->min3=$r->min3;
        $item->stan3=$r->stan3;
        $item->max3=$r->max3;

        $item->min4=$r->min4;
        $item->stan4=$r->stan4;
        $item->max4=$r->max4;

        $item->min5=$r->min5;
        $item->stan5=$r->stan5;
        $item->max5=$r->max5;

        $item->min6=$r->min6;
        $item->stan6=$r->stan6;
        $item->max6=$r->max6;

        $item->sum=$r->sum;

        $item->save();
        return redirect()->to('/backend/air_model_list')->with('success','Sucess!');
    }
    public function air_model_list_edit($id){
        $item=Air_listModel::where('id',$id)->first();
        return view('backend.air_model_list.edit',[
            'item'=>$item,
            'page'=>"air_conditioner",
            'list'=>"air_model_list",
        ]);
    }
    public function air_model_list_destroy($id){
        $item=Air_listModel::where('id',$id)->first();
        $item->delete();
        return redirect()->back()->with('success','Sucess!');
    }
    public function air_model_list_add(){
        return view('backend.air_model_list.add',[
            'page'=>"air_conditioner",
            'list'=>"air_model_list",
        ]);
    }
    //air_model_list//

}
