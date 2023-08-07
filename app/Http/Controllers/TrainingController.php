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
use App\Models\TrainingTurn;
use App\Models\TrainingList;
use App\Models\province;
use App\Models\amphur;
use App\Models\district;

use App\Mail\Forget_email;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\support\carbon;

class TrainingController extends Controller
{
    public function index()
    {
        $data['page'] = 'training';
        $data['item'] = Training::orderby('id', 'desc')->get();
        $data['list'] = 'training';
        return view('backend.training.index', $data);
    }

    public function add()
    {
        $data['page'] = 'training';
        $data['list'] = 'training';
        $data['provinces'] = province::orderby('id', 'asc')->get();
        return view('backend.training.add', $data);
    }

    public function edit($id)
    {
        $data['detail'] = Training::where('id', $id)->with('trainingturn')->first();
        $data['list'] = 'training';
        $data['page'] = 'training';
        $data['provinces'] = province::orderby('id', 'asc')->get();
        $data['amphures'] = amphur::orderby('id', 'asc')->get();
        $data['districts'] = district::orderby('id', 'asc')->get();
        $data['zipcode'] = district::where('id', $data['detail']->district)->first();

        return view('backend.training.edit', $data);
    }

    public function add_turn(Request $request)
    {
        $check_turn = TrainingTurn::where('training_id', $request->id)->orderby('turn', 'desc')->first();

        $turn = new TrainingTurn;
        $turn->training_id = $request->id;
        $turn->turn = intval($check_turn->turn) + 1;
        $turn->save();

        $training_turn = TrainingTurn::where('training_id', $request->id)->get();

        return response()->json($training_turn);
    }

    public function destroy($id)
    {
        $item = Training::where('id', $id)->first();
        $item->delete();
        return redirect()->back()->with('success', 'Sucess!');
    }

    public function get_list($id, $turn)
    {
        $list_user = TrainingList::where('training_id', $id)->where('turn_id', $turn)->get();

        return response()->json($list_user);
    }

    // Function Insert และ Update
    public function insert(Request $request)
    {
        return $this->store($request, $id = null);
    }
    public function update(Request $request, $id = null)
    {
        return $this->store($request, $id);
    }

    public function store(Request $request, $id = null)
    {
        $province = province::where('id', $request->province)->first();
        $amphure = amphur::where('id', $request->amphure)->first();
        $district = district::where('id', $request->district)->first();

        if ($id == null) {
            $training = new Training;
            $training->name = $request->name;
            $training->status = $request->status;
            $training->detail = $request->detail;
            $training->date_time = $request->datetime;
            $training->address = $request->address;
            $training->province = $request->province;
            $training->amphure = $request->amphure;
            $training->district = $request->district;

            $training->save();

            $turn = new TrainingTurn;
            $turn->training_id = $training->id;
            $turn->turn = 1;
            $turn->save();
        } else {
            $training = Training::find($id);
            $training->name = $request->name;
            if ($request->status != null)
                $training->status = $request->status;
            else
                $training->status = "off";
            $training->detail = $request->detail;
            $training->date_time = $request->datetime;
            $training->address = $request->address;
            $training->province = $request->province;
            $training->amphure = $request->amphure;
            $training->district = $request->district;
        }

        if ($training->save()) {
            return redirect()->to('/backend/training')->with('success', 'Sucess!');
        }
    }
}
