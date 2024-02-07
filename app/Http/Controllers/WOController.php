<?php

namespace App\Http\Controllers;

use App\WO;
use App\WO_item;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\WOCreateRequest;

use App\Models\TechnicianService;

use App\Models\noti;

use App\AirModel;
use App\Wo_air_checkModel;
use App\Air_listModel;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\support\carbon;
use DB;
use Auth;

use PDF;

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
    // $pdf=PDF::loadview('pdf_work',['id'=>$id]);
    ///pdf---------------
    public function pdf_work($id)
    {
        $papersize = array(0, 0, 1000, 205);
        $pdf = PDF::loadview('pdf_work', ['id' => $id], [], [
            'orientation' => 'P',
            'format' => [58, 1000]
        ]);
        return @$pdf->stream();
    }


    public function wo()
    {
        $item = WO::where('d_status', 0)->orderby('id', 'desc')->get();
        return view('backend.wo.index', [
            'item' => $item,
            'page' => "wo",
            'list' => "wo",
        ]);
    }
    public function wo_store(Request $r)
    {
        $item = new WO();

        $year_4 = date("Y");
        $year_2 = date("y");
        $month_2 = date("m");

        // $number_id = WO::whereRaw('YEAR(created_at)=' . $year_4)->whereRaw('MONTH(created_at)=' . $month_2)->count() + 1;
        // $format = "WO" . $year_2 . $month_2 . "%'.07d";

        // $ans = sprintf($format, $number_id);

        $item->wo_number = $r->wo_number;
        $item->wo_date = $r->wo_date;
        $item->wo_time = $r->wo_time;
        $item->wo_type = $r->wo_type;
        $item->wo_breakdown = $r->wo_breakdown;
        $item->error_code = $r->error_code;
        $item->wo_price = $r->wo_price;

        $item->wo_remark = $r->wo_remark;

        $item->technician_id = $r->technician_id;

        $item->work_province = $r->work_province;
        $item->work_amupur = $r->work_amupur;
        $item->work_district = $r->work_district;


        if ($r->pic_before) {
            $check = 'file/upload/' . $item->pic_before;
            Storage::disk('s3')->delete($check);
            $file = $r->file('pic_before');
            $fileName = $_FILES['pic_before']['name'];
            $fileName = date('YmdHis') . '_' . $fileName;
            $filePath = 'file/upload/' . $fileName;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $item->pic_before = $fileName;
        }

        if ($r->pic_after) {
            $check = 'file/upload/' . $item->pic_after;
            Storage::disk('s3')->delete($check);
            $file = $r->file('pic_after');
            $fileName = $_FILES['pic_after']['name'];
            $fileName = date('YmdHis') . '_' . $fileName;
            $filePath = 'file/upload/' . $fileName;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $item->pic_after = $fileName;
        }

        if ($r->pic_before2) {
            $check = 'file/upload/' . $item->pic_before2;
            Storage::disk('s3')->delete($check);
            $file = $r->file('pic_before2');
            $fileName = $_FILES['pic_before2']['name'];
            $fileName = date('YmdHis') . '_' . $fileName;
            $filePath = 'file/upload/' . $fileName;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $item->pic_before2 = $fileName;
        }

        if ($r->pic_after2) {
            $check = 'file/upload/' . $item->pic_after2;
            Storage::disk('s3')->delete($check);
            $file = $r->file('pic_after2');
            $fileName = $_FILES['pic_after2']['name'];
            $fileName = date('YmdHis') . '_' . $fileName;
            $filePath = 'file/upload/' . $fileName;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $item->pic_after2 = $fileName;
        }


        $air = AirModel::where('des', $r->model_name)->first();
        if ($air != null) {
            $item->air_model = $air->id;
        } else {
            $air = new AirModel();
            $air->des = $r->model_name;
            $air->model_name = 'no_name';
            $air->point = 0;
            $air->save();

            $item->air_model = $air->id;
        }

        $customer = Customer::where('first_name', $r->first_name)
            ->where('last_name', $r->last_name)->first();

        if ($customer == null) {
            $customer = new Customer();
            $customer->first_name = $r->first_name;
            $customer->last_name = $r->last_name;
            $customer->full_name = $r->first_name . ' ' . $r->last_name;
            $customer->phone = $r->phone;
            $customer->address = $r->address;

            $customer->mechanic_id = null;
            $customer->line = null;
            $customer->more_address = null;
            $customer->latitude = 0;
            $customer->longitude = 0;

            $customer->save();
        } else {
            $customer->first_name = $r->first_name;
            $customer->last_name = $r->last_name;
            $customer->full_name = $r->first_name . ' ' . $r->last_name;
            $customer->phone = $r->phone;
            $customer->address = $r->address;
            $customer->save();
        }

        $item->customer_id = $customer->id;


        $item->save();

        $curl = curl_init();

        $postData = [
            'province' => $r->work_province
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://heavyoneclick.com:3000/updateRealtime',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($postData),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;

        $curl = curl_init();

        $postData = [
            'province' =>  "all"
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://heavyoneclick.com:3000/updateRealtime',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($postData),
        ));

        $response = curl_exec($curl);

        curl_close($curl);


        $aaa = new noti();
        $aaa->id_work = $item->id;

        $aaa->titleth = 'มีงานใหม่ หมายเลขงาน/' . $item->wo_number;
        $aaa->detailth = 'มีงานใหม่';

        $aaa->id_admin = Auth::user()->id;

        $aaa->save();


        return redirect()->to('/backend/wo')->with('success', 'Sucess!');
    }
    public function wo_update(Request $r, $id)
    {
        $item = WO::where('id', $id)->first();


        $item->wo_number = $r->wo_number;
        $item->wo_date = $r->wo_date;
        $item->wo_time = $r->wo_time;
        $item->wo_type = $r->wo_type;
        $item->wo_breakdown = $r->wo_breakdown;
        $item->error_code = $r->error_code;
        $item->wo_price = $r->wo_price;
        $item->wo_status = $r->wo_status;

        $item->work_province = $r->work_province;
        $item->work_amupur = $r->work_amupur;
        $item->work_district = $r->work_district;

        $item->wo_remark = $r->wo_remark;

        $item->technician_id = $r->technician_id;

        if ($r->pic_before) {
            $check = 'file/upload/' . $item->pic_before;
            Storage::disk('s3')->delete($check);
            $file = $r->file('pic_before');
            $fileName = $_FILES['pic_before']['name'];
            $fileName = date('YmdHis') . '_' . $fileName;
            $filePath = 'file/upload/' . $fileName;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $item->pic_before = $fileName;
        }

        if ($r->pic_before2) {
            $check = 'file/upload/' . $item->pic_before2;
            Storage::disk('s3')->delete($check);
            $file = $r->file('pic_before2');
            $fileName = $_FILES['pic_before2']['name'];
            $fileName = date('YmdHis') . '_' . $fileName;
            $filePath = 'file/upload/' . $fileName;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $item->pic_before2 = $fileName;
        }

        if ($r->pic_after2) {
            $check = 'file/upload/' . $item->pic_after2;
            Storage::disk('s3')->delete($check);
            $file = $r->file('pic_after2');
            $fileName = $_FILES['pic_after2']['name'];
            $fileName = date('YmdHis') . '_' . $fileName;
            $filePath = 'file/upload/' . $fileName;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            $item->pic_after2 = $fileName;
        }

        $air = AirModel::where('des', $r->model_name)->first();
        if ($air != null) {
            $item->air_model = $air->id;
        } else {
            $air = new AirModel();
            $air->des = $r->model_name;
            $air->model_name = 'no_name';
            $air->point = 0;
            $air->save();

            $item->air_model = $air->id;
        }


        $customer = Customer::where('first_name', $r->first_name)
            ->where('last_name', $r->last_name)->first();

        if ($customer == null) {
            $customer = new Customer();
            $customer->first_name = $r->first_name;
            $customer->last_name = $r->last_name;
            $customer->full_name = $r->first_name . ' ' . $r->last_name;
            $customer->phone = $r->phone;
            $customer->address = $r->address;

            $customer->mechanic_id = null;
            $customer->line = null;
            $customer->more_address = null;
            $customer->latitude = 0;
            $customer->longitude = 0;

            $customer->save();
        } else {
            $customer->first_name = $r->first_name;
            $customer->last_name = $r->last_name;
            $customer->full_name = $r->first_name . ' ' . $r->last_name;
            $customer->phone = $r->phone;
            $customer->address = $r->address;
            $customer->save();
        }

        $item->customer_id = $customer->id;
        $item->save();

        // return redirect()->to('/backend/wo')->with('success', 'Sucess!');
        return redirect()->to('/backend/wo_edit/' . $id)->with('success', 'Sucess!');
    }
    public function wo_edit($id)
    {
        $item = WO::where('id', $id)->first();
        return view('backend.wo.edit', [
            'item' => $item,
            'page' => "wo",
            'list' => "wo",
        ]);
    }
    public function wo_destroy($id)
    {
        $item = WO::where('id', $id)->first();
        // $check= 'file/upload/' . $item->wo_picture;
        //         Storage::disk('s3')->delete($check);
        // $item->delete();
        $item->d_status = 1;
        $item->save();

        $wo_item = DB::table('wo_item')->where('id_wo', $id)->update(['d_status' => 1]);

        $curl = curl_init();

        $postData = [
            'province' => $item->work_province
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://heavyoneclick.com:3000/updateRealtime',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($postData),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;

        $curl = curl_init();

        $postData = [
            'province' =>  "all"
        ];

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://heavyoneclick.com:3000/updateRealtime',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($postData),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // echo $response;

        return redirect()->back()->with('success', 'Sucess!');
    }
    public function wo_add()
    {
        return view('backend.wo.add', [
            'page' => "wo",
            'list' => "wo",
        ]);
    }
    //wo//







    //wo_item//

    public function wo_item($id)
    {
        $item = WO_item::where('id_wo', $id)->where('d_status', 0)->orderby('id', 'desc')->get();
        return view('backend.wo_item.index', [
            'item' => $item,
            'id' => $id,
            'page' => "wo",
            'list' => "wo",
        ]);
    }
    public function wo_item_store(Request $r)
    {
        $item = new WO_item();
        $item->id_wo = $r->id;
        $item->title = $r->title;
        $item->number = $r->number;
        $item->value = $r->value;

        $item->status = $r->status;

        $item->save();
        return redirect()->to('/backend/wo_item/' . $r->id)->with('success', 'Sucess!');
    }
    public function wo_item_update(Request $r, $id)
    {
        $item = WO_item::where('id', $id)->first();
        $item->title = $r->title;
        $item->number = $r->number;
        $item->value = $r->value;

        $item->status = $r->status;
        $item->save();
        return redirect()->to('/backend/wo_item/' . $item->id_wo)->with('success', 'Sucess!');
    }
    public function wo_item_edit($id)
    {
        $item = WO_item::where('id', $id)->first();
        return view('backend.wo_item.edit', [
            'item' => $item,
            'page' => "wo",
            'list' => "wo",
        ]);
    }
    public function wo_item_destroy($id)
    {
        $item = WO_item::where('id', $id)->first();
        // $item->delete();
        $item->d_status = 1;
        $item->save();
        return redirect()->back()->with('success', 'Sucess!');
    }
    public function wo_item_add($id)
    {
        return view('backend.wo_item.add', [
            'id' => $id,
            'page' => "wo",
            'list' => "wo",
        ]);
    }
    //wo//







}
