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

use App\User;

class UserImport implements ToModel,  WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $check=User::where('email',$row[9])->first();
        if($check==null){
            $check=User::where('phone',$row[8])->first();
        }

        if($row[0]!=null and $row[1]!=null and $row[2]!=null){
            $pass=Hash::make($row[5]);

        if($check==null){
            return new User([
            "us_id"=>$row[1],
            "name"=>$row[2],
            "lastname"=>$row[3],
            "password"=>$pass,

            "birth"=>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[6]),
            "phone"=>$row[7],
            "email"=>$row[8],
            "location"=>$row[9],

            "amphur"=>$row[7],
            "province"=>$row[7],
            "point"=>$row[12],

            "type"=>5,
            "status"=>1,
            ]);

        }
        }

    }
        public function startRow(): int
        {
        return 2;
        }
        
}