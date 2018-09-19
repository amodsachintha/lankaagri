<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'item_id', 'quantity','created_at','updated_at'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function item()
    {
        return $this->belongsTo('App\Item');
    }


}
