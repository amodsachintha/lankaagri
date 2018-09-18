<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'image',
        'user_id',
        'id_category',
        'quantity',
        'unit_price',
        'discount',
        'ppq'
    ];
}
