<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'image',
        'user_id',
        'category_id',
        'quantity',
        'unit_price',
        'discount',
        'ppq'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
