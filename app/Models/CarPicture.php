<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarPicture extends Model
{
    // use SoftDeletes;

    protected $table = "car_pictures";
    protected $fillable = [
        'car_service_id', 'picture',
    ];
}
