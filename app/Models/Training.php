<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $table="training";
    protected $primarykey="id";

    public function province()
    {
        return $this->belongsTo('App\Models\province', 'province');
    }

    public function amphur()
    {
        return $this->belongsTo('App\Models\amphur', 'amphur');
    }

    public function district()
    {
        return $this->belongsTo('App\Models\amphur', 'district');
    }
}
