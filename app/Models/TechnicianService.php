<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechnicianService extends Model
{
    protected $table = "technician_services";
    protected $fillable = [
        'machanic_id', 'fname', 'lname', 'nick_name', 'phone', 'line',
    ];
}
