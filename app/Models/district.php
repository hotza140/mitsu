<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class district extends Model
{
    protected $table="tb_districts";
    protected $primarykey="id";

    public function amphur()
    {
        return $this->belongsTo('App\Models\amphur', 'id');
    }
}
