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

use App\Air_listModel;

class Model_listImport implements ToModel,  WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $check=Air_listModel::where('model',$row[0])->first();

        if($row[0]!=null and $row[1]!=null and $row[11]!=null){

        if($check==null){
            return new Air_listModel([
            "model"=>$row[0],

            "min1"=>24,
            "stan1"=>25,
            "max1"=>26,
            
            "min2"=>10,
            "stan2"=>11,
            "max2"=>12,

            "min3"=>30,
            "stan3"=>35,
            "max3"=>40,

            "min4"=>120,
            "stan4"=>130,
            "max4"=>140,

            "min5"=>0,
            "stan5"=>$row[14],
            "max5"=>0,

            "min6"=>198,
            "stan6"=>220,
            "max6"=>242,
            ]);

        }
        }

    }
        public function startRow(): int
        {
        return 6;
        }
        
}