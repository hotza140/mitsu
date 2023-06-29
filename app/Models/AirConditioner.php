<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AirConditioner extends Model
{
    protected $table="air_conditioners";
    protected $primarykey="id";

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }
}
