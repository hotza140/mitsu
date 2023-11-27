<?php

namespace App\Exports;

use App\Models\AirConditioner;
use App\Models\Customer;
use App\Models\market;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;
use Illuminate\Support\Collection;
use Yajra\DataTables\Facades\DataTables;

// class customerExport implements FromCollection, WithHeadings

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class dataExport implements FromView
{
    // public function collection()
    public function view(): View
    {
        $this->date_s = request()->input('date_s');
        $this->date_e = request()->input('date_e');
        
        if($this->date_s==null){
            $date_s =null;
        }else{
            $date_s = $this->date_s;
        }

        if($this->date_e==null){
            $date_e =null;
        }else{
            $date_e = $this->date_e;
        }

        if($date_s!=null and $date_e!=null){
        $air = AirConditioner::
        whereDate('created_at', '>=', $date_s)
        ->whereDate('created_at', '<=', $date_e)
        ->orderBy('id', 'desc');
        }else{
        $air = AirConditioner::orderBy('id', 'desc');
        }

        $data = DataTables::of($air)
            ->addIndexColumn()
            ->addColumn('name', function ($row) {
                $pp = Customer::where('id', $row->customer_id)->first();
                return $pp ? $pp->full_name : null;
            })
            ->addColumn('phone', function ($row) {
                $pp = Customer::where('id', $row->customer_id)->first();
                return $pp ? $pp->phone : null;
            })
            ->addColumn('market', function ($row) {
                $mm = Customer::where('id', $row->customer_id)->first();
                $pp = market::where('id', @$mm->id_market)->first();
                return $pp ? $pp->titleth : null;
            })
            ->addColumn('date_s', function ($row) use($date_s) {
                return $date_s ? $date_s : null;
            })
            ->addColumn('date_e', function ($row) use($date_e) {
                return $date_e ? $date_e : null;
            })
            ->rawColumns(['number_s','name','date_s','date_e','phone'])
            ->make(true);

           


            $datatableData = $data->getData();
            
            return view('date_excel', [
                'data'=>$datatableData,
            ]);

    }
}