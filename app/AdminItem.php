<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminItem extends Model
{
    protected $fillable = [
        'name', 'category_id', 'unit_price', 'image'
    ];


    public function category(){
        return $this->belongsTo('App\Category');
    }
}
