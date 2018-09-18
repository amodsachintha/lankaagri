<?php

namespace App\Http\Controllers;

use App\Item;

class ItemsController extends Controller
{
    public function show(){
        return response()->json(Item::where('user_id',1)->get());
    }
}
