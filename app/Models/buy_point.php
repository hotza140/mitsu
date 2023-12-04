<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class buy_point extends Model
{
    use SoftDeletes;
    protected $table="buy_point";
    protected $primarykey="id";

    public function item()
    {
        return $this->belongsTo('App\Models\item_point', 'id_item');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
}
