<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wo_air_checkModel extends Model
{
    use SoftDeletes;
    protected $table = "wo_air_check";
    protected $primarykey = "id";

    protected $fillable = ['model','min1','stan1','max1'
    ,'min2','stan2','max2'
    ,'min3','stan3','max3'
    ,'min4','stan4','max4'
    ,'min5','stan5','max5'
    ,'min6','stan6','max6'
    ,'sum','created_at','updated_at'];
}
