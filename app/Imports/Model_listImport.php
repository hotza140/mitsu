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

            "min1"=>$row[1],
            "stan1"=>$row[2],
            "max1"=>$row[3],
            
            "min2"=>$row[4],
            "stan2"=>$row[5],
            "max2"=>$row[6],

            "min3"=>$row[7],
            "stan3"=>$row[8],
            "max3"=>$row[9],

            "min4"=>$row[10],
            "stan4"=>$row[11],
            "max4"=>$row[12],

            "min5"=>$row[13],
            "stan5"=>$row[14],
            "max5"=>$row[15],

            "min6"=>$row[16],
            "stan6"=>$row[17],
            "max6"=>$row[18],
            ]);

        }
        }

    }
        public function startRow(): int
        {
        return 6;
        }
        
}