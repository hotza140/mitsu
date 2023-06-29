<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TechnicianService extends Model
{
    // use SoftDeletes;

    protected $table = "technician_services";
    protected $fillable = [
        'machanic_id', 'fname', 'lname', 'nick_name', 'phone', 'line',
    ];
}
