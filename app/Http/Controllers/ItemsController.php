<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemsController extends Controller
{
    public function show()
    {
        $item = Item::all()->first();
        $user = $item->user();
        return response()->json($user);
    }


    public function search(Request $request)
    {
        if(Auth::check()){
            $items = Item::where('active', true)
                ->where('user_id', '!=', Auth::user()->id)
                ->where('deleted', false)
                ->where('name', 'like', '%' . $request->get('param') . '%')
                ->get();

            $count = Item::where('active', true)
                ->where('user_id', '!=', Auth::user()->id)
                ->where('deleted', false)
                ->where('name', 'like', '%' . $request->get('param') . '%')
                ->count();
        }else{
            $items = Item::where('active', true)
                ->where('deleted', false)
                ->where('name', 'like', '%' . $request->get('param') . '%')
                ->get();

            $count = Item::where('active', true)
                ->where('deleted', false)
                ->where('name', 'like', '%' . $request->get('param') . '%')
                ->count();
        }



        return view('search')->with(['items' => $items, 'count' => $count]);
    }


}
