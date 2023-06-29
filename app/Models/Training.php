<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $table="trainings";
    protected $primarykey="id";

    public function province()
    {
        return $this->belongsTo('App\Models\province', 'province');
    }

    public function amphure()
    {
        return $this->belongsTo('App\Models\amphur', 'amphure');
    }

    public function district()
    {
        return $this->belongsTo('App\Models\amphur', 'district');
    }

    public function traininglist()
    {
        return $this->hasMany('App\Models\TrainingList', 'training_id');
    }

    public function trainingturn()
    {
        return $this->hasMany('App\Models\TrainingTurn', 'training_id');
    }
}
