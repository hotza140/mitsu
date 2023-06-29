<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ToolService extends Model
{
    // use SoftDeletes;

    protected $table = "tool_services";
    protected $fillable = [
        'machanic_id', 'tool',
    ];

    public function machanic()
    {
        return $this->belongsTo('App\User', 'machanic_id');
    }

    public function toolPictures()
    {
        return $this->hasMany('App\Models\ToolPicture', 'tool_service_id');
    }
}
