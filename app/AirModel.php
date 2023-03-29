<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AirModel extends Model
{
    use SoftDeletes;
    protected $table = "wo";
    protected $primarykey = "id";
}
