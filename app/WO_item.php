<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WO_item extends Model
{
    // use SoftDeletes;
    protected $table = "wo_item";
    protected $primarykey = "id";

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'id_customer');
    }

    public function tech()
    {
        return $this->belongsTo('App\Models\TechnicianService', 'id_tech');
    }

    

}
