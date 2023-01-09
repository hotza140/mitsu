<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table="customers";
    protected $primarykey="id";

    public function airconditioner()
    {
        return $this->hasMany('App\Models\AirConditioner', 'customer_id');
    }
}
