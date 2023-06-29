<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class amphur extends Model
{
    protected $table="tb_amupur";
    protected $primarykey="id";

    public function province()
    {
        return $this->belongsTo('App\Models\province', 'code');
    }

    public function district()
    {
        return $this->hasMany('App\Models\district', 'amphure_id');
    }
}
