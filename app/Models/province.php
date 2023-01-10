<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class province extends Model
{
    protected $table="tb_province";
    protected $primarykey="id";

    public function amphur()
    {
        return $this->hasMany('App\Models\amphur', 'province_code');
    }
}
