<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class item_point extends Model
{
    use SoftDeletes;
    protected $table="item_point";
    protected $primarykey="id";
}
