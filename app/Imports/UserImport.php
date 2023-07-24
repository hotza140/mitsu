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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

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
        // $check=User::where('email',$row[9])->first();
        // if($check==null){
        //     $check=User::where('phone',$row[8])->first();
        // }

        $check=User::where('name',$row[2])->where('lastname',$row[3])->first();

        $year = date('Y');
        if($check!=null){
            $fff=User::where('email',$row[8])->first();
            if($fff==null){
                $aaa=User::where('name',$row[2])->where('lastname',$row[3])->first();
                $aaa->email=$row[8];

                 // CODE
            $nu = User::where('type', 5)->orderby('id', 'desc')->first();
            if ($nu != null) {
                $nm = $nu->num + 1;
            } else {
                $nm = 1;
            }
            $aaa->num = $nm;

            $num = str_pad($nm, 5, '0', STR_PAD_LEFT);
            $aaa->code = $year . 'H' . $num;
            // CODE

            $aaa->save();
            }
           
        }

        if($row[0]!=null and $row[1]!=null and $row[2]!=null){
            $pass=Hash::make($row[5]);

            if($row[12]==null){
            $point=0;
            }else{
                $point=$row[12];
            }

        if($check==null){
            return new User([
            "us_id"=>$row[1],
            "name"=>$row[2],
            "lastname"=>$row[3],
            "password"=>$pass,

            "birth"=>$row[6],
            "phone"=>$row[7],
            // "email"=>$row[8],
            "location"=>$row[9],

            "amphur"=>$row[7],
            "province"=>$row[7],
            "point"=>$point,

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