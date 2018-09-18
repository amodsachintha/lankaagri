<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderline extends Model
{
    protected $fillable = [
        'order_id', 'item_id', 'quantity', 'unit_price', 'total', 'delivered'
    ];
}
