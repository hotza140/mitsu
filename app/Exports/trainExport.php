<?php

namespace App\Exports;

use App\Models\AirConditioner;
use App\Models\Customer;
use App\Models\market;

use App\Models\TrainingList;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;
use Illuminate\Support\Collection;
use Yajra\DataTables\Facades\DataTables;

// class customerExport implements FromCollection, WithHeadings

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class trainExport implements FromView
{
    // public function collection()
    public function view(): View
    {
        $this->id = request()->input('id');
        $this->title = request()->input('title');
        $this->turn = request()->input('turn');
        
        if($this->id==null){
            $id =null;
        }else{
            $id = $this->id;
        }

        if($this->turn==null){
            $turn =null;
        }else{
            $turn = $this->turn;
        }

        if($this->title==null){
            $title =null;
        }else{
            $title = $this->title;
        }

        $train = TrainingList::where('turn_id', $id)->orderBy('id', 'asc')->get();

            
            return view('train_excel', [
                'data'=>$train,
                'title'=>$title,
                'turn'=>$turn,
            ]);

    }
}