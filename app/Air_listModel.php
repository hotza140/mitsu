<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Air_listModel extends Model
{
    // use SoftDeletes;
    protected $table = "air_models_list";
    protected $primarykey = "id";

}
