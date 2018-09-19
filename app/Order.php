<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
      'user_id',
      'total'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }


    public function orderlines(){
        return $this->hasMany('App\Orderline');
    }
}
