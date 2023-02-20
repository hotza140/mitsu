<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ToolPicture extends Model
{
    use SoftDeletes;

    protected $table = "tool_pictures";
    protected $fillable = [
        'tool_service_id', 'picture',
    ];
}
