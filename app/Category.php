<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=[
        'name',
    ];


    public function items(){
        return $this->hasMany('App\Item');
    }

    public function adminItems(){
        return $this->hasMany('App\AdminItem');
    }

}
