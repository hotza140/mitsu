<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class item_point extends Model
{
    use SoftDeletes;
    protected $table="item_point";
    protected $primarykey="id";
}
