<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingTurn extends Model
{
    protected $table="training_turns";
    protected $primarykey="id";

    public function training()
    {
        return $this->belongsTo('App\Models\Training', 'training_id');
    }

}
