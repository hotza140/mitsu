<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingList extends Model
{
    protected $table="training_lists";
    protected $primarykey="id";

    public function training()
    {
        return $this->belongsTo('App\Models\Training', 'training_id');
    }
}
