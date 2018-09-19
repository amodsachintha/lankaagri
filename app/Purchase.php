<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'order_id', 'payment_method', 'shipping_address', 'billing_address'
    ];


    public function order(){
        return $this->belongsTo('App\Order');
    }

}
