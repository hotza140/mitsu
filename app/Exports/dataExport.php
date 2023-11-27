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
        ->orderBy('id', 'desc')
        ->get();
        }else{
        $air = AirConditioner::
        orderBy('id', 'desc')
        ->get();
        }

            
            return view('data_excel', [
                'data'=>$air,
                'date_s'=>$date_s,
                'date_e'=>$date_e,
            ]);

    }
}