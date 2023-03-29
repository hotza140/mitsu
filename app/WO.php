<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WO extends Model
{
    use SoftDeletes;
    protected $table = "wo";
    protected $fillable = [
        'wo_number',
        'wo_date',
        'wo_time',
        'wo_type',
        'wo_breakdown',
        'air_model',
        'error_code',
        'wo_price',
        'technician_id',
        'customer_id',
        'wo_status',
        'wo_remark',
        'wo_picture',
    ];
}
