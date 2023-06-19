<?php

namespace App\Http\Controllers;

use App\WO;
use App\WO_item;
use Illuminate\Http\Request;
use App\Http\Requests\WOCreateRequest;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class WOController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WOCreateRequest $request)
    {
        try {
            $request->validate();
            $year_4 = date("Y");
            $year_2 = date("y");
            $month_2 = date("m");

            $number_id = WO::whereRaw('YEAR(created_at)=' . $year_4)->whereRaw('MONTH(created_at)=' . $month_2)->count() + 1;
            $format = "WO" . $year_2 . $month_2 . "%'.07d";
            $wo = WO::create([
                'wo_number' => sprintf($format, $number_id),
                'wo_date' => $request->wo_date,
                'wo_time' => $request->wo_time,
                'wo_type' => $request->wo_type,
                'wo_breakdown' => $request->wo_breakdown,
                'air_model' => $request->air_model,
                'error_code' => $request->error_code,
                'wo_price' => $request->wo_price,
                'customer_id' => $request->customer_id,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Data has been saved',
                'data' => $wo
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }









    //wo//


    public function wo(){
        $item=WO ::orderby('id','desc')->get();
        return view('backend.wo.index',[
            'item'=>$item,
            'page'=>"wo",
            'list'=>"wo",
        ]);
    }
    public function wo_store(Request $r){
        $item=new WO();

        $year_4 = date("Y");
        $year_2 = date("y");
        $month_2 = date("m");

        $number_id = WO::whereRaw('YEAR(created_at)=' . $year_4)->whereRaw('MONTH(created_at)=' . $month_2)->count() + 1;
        $format = "WO" . $year_2 . $month_2 . "%'.07d";

        $ans=sprintf($format, $number_id);

        $item->wo_number=$ans;
        $item->wo_date=$r->wo_date;
        $item->wo_time= $r->wo_time;
        $item->wo_type= $r->wo_type;
        $item->wo_breakdown= $r->wo_breakdown;
        $item->air_model= $r->air_model;
        $item->error_code= $r->error_code;
        $item->wo_price= $r->wo_price;
        $item->customer_id= $r->customer_id;


        $item->save();
        return redirect()->to('/backend/wo')->with('success','Sucess!');

    }
    public function wo_update(Request $r,$id){
        $item=WO::where('id',$id)->first();
      
        $item->wo_date=$r->wo_date;
        $item->wo_time= $r->wo_time;
        $item->wo_type= $r->wo_type;
        $item->wo_breakdown= $r->wo_breakdown;
        $item->air_model= $r->air_model;
        $item->error_code= $r->error_code;
        $item->wo_price= $r->wo_price;
        $item->wo_status= $r->wo_status;
        $item->customer_id= $r->customer_id;

        $item->save();
        return redirect()->to('/backend/wo')->with('success','Sucess!');
    }
    public function wo_edit($id){
        $item=WO::where('id',$id)->first();
        return view('backend.wo.edit',[
            'item'=>$item,
            'page'=>"wo",
            'list'=>"wo",
        ]);
    }
    public function wo_destroy($id){
        $item=WO::where('id',$id)->first();
        $check= 'file/upload/' . $item->wo_picture;
                Storage::disk('s3')->delete($check);
        $item->delete();
        return redirect()->back()->with('success','Sucess!');
    }
    public function wo_add(){
        return view('backend.wo.add',[
            'page'=>"wo",
            'list'=>"wo",
        ]);
    }
    //wo//







      //wo_item//

      public function wo_item($id){
        $item=WO_item ::where('id_wo',$id)->orderby('id','desc')->get();
        return view('backend.wo_item.index',[
            'item'=>$item,
            'id'=>$id,
            'page'=>"wo",
            'list'=>"wo_item",
        ]);
    }
    public function wo_item_store(Request $r){
        $item=new WO_item();
        $item->id_wo=$r->id;
        $item->title=$r->title;
        $item->number=$r->number;
        $item->value=$r->value;

        $item->save();
        return redirect()->to('/backend/wo_item')->with('success','Sucess!');

    }
    public function wo_item_update(Request $r,$id){
        $item=WO_item::where('id',$id)->first();
        $item->title=$r->title;
        $item->number=$r->number;
        $item->value=$r->value;

        $item->save();
        return redirect()->to('/backend/wo_item')->with('success','Sucess!');
    }
    public function wo_item_edit($id){
        $item=WO_item::where('id',$id)->first();
        return view('backend.wo_item.edit',[
            'item'=>$item,
            'page'=>"wo",
            'list'=>"wo_item",
        ]);
    }
    public function wo_item_destroy($id){
        $item=WO_item::where('id',$id)->first();
        $item->delete();
        return redirect()->back()->with('success','Sucess!');
    }
    public function wo_item_add($id){
        return view('backend.wo_item.add',[
            'id'=>$id,
            'page'=>"wo",
            'list'=>"wo_item",
        ]);
    }
    //wo//







}
