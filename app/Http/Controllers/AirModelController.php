<?php

namespace App\Http\Controllers;

use App\Http\Requests\AirModelCreateRequest;
use Illuminate\Http\Request;
use App\AirModel;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

use Maatwebsite\Excel\Facades\Excel;

use App\Imports\ModelImport;

class AirModelController extends Controller
{
    //air_model//


    public function air_model(){
        $item=AirModel ::orderby('id','desc')->get();
        return view('backend.air_model.index',[
            'item'=>$item,
            'page'=>"air_conditioner",
            'list'=>"air_model",
        ]);
    }

    

    public function air_model_excel(Request $request){
        if($request->file!=null){
            try {     
                Excel::import(new ModelImport, $request->file);
                return redirect()->back()->with('success', 'Data Imported Successfully');
                } catch(Exception $e) {
                return redirect()->back()->with('success', 'Data Imported Fail.');
                }
        
        }else{
            return redirect()->back()->with('success', 'Data Imported Fail Please Choose File!');
        }
    }

    public function air_model_store(Request $r){
        $item=new AirModel();
        $item->model_name=$r->model_name;
        // $item->model_type=$r->model_type;

        $item->des=$r->des;
        $item->point=$r->point;


        $item->save();
        return redirect()->to('/backend/air_model')->with('success','Sucess!');

    }
    public function air_model_update(Request $r,$id){
        $item=AirModel::where('id',$id)->first();
        $item->model_name=$r->model_name;
        // $item->model_type=$r->model_type;

        $item->des=$r->des;
        $item->point=$r->point;

        $item->save();
        return redirect()->to('/backend/air_model')->with('success','Sucess!');
    }
    public function air_model_edit($id){
        $item=AirModel::where('id',$id)->first();
        return view('backend.air_model.edit',[
            'item'=>$item,
            'page'=>"air_conditioner",
            'list'=>"air_model",
        ]);
    }
    public function air_model_destroy($id){
        $item=AirModel::where('id',$id)->first();
        $item->delete();
        return redirect()->back()->with('success','Sucess!');
    }
    public function air_model_add(){
        return view('backend.air_model.add',[
            'page'=>"air_conditioner",
            'list'=>"air_model",
        ]);
    }
    //air_model//

}
