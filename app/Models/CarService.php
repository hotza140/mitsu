<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CarService extends Model
{
    use SoftDeletes;

    protected $table = "car_services";
    protected $fillable = [
        'machanic_id', 'brand', 'model', 'color', 'number_plate',
    ];

    public function machanic()
    {
        return $this->belongsTo('App\User', 'machanic_id');
    }

    public function carPictures()
    {
        return $this->hasMany('App\Models\CarPicture', 'car_service_id');
    }
}
