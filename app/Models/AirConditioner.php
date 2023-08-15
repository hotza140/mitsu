<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AirConditioner extends Model
{
    use SoftDeletes;
    protected $table="air_conditioners";
    protected $primarykey="id";

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }
}
