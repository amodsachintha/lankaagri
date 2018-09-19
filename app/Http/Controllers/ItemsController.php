<?php

namespace App\Http\Controllers;

use App\Item;

class ItemsController extends Controller
{
    public function show(){
        $item = Item::all()->first();
        $user = $item->user();
        return response()->json($user);
    }



}
