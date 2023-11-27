<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class noti extends Model
{
    use SoftDeletes;
    protected $table="noti";
    protected $primarykey="id";

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'id_customer');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
}
