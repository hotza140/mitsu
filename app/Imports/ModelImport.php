<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

use Illuminate\Support\Facades\Date;
use Illuminate\Support\Carbon;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

use App\AirModel;

class ModelImport implements ToModel,  WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $check=AirModel::groupby('model_name')->where('model_name',$row[0])->first();

        if($row[0]!=null and $row[1]!=null and $row[11]!=null){

        if($check==null){
            return new AirModel([
            "model_name"=>$row[0],
            "des"=>$row[1],
            "point"=>$row[11],
            ]);

        }
        }

    }
        public function startRow(): int
        {
        return 2;
        }
        
}