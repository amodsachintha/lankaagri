<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            $items = Item::orderBy(DB::raw('RAND()'))
                ->where('active', true)
                ->where('deleted',false)
                ->where('user_id','!=',Auth::user()->id)
                ->limit(6)
                ->get();
        }
        else{
            $items = Item::orderBy(DB::raw('RAND()'))
                ->where('active', true)
                ->where('deleted',false)
                ->limit(6)
                ->get();
        }

        $categories = Category::orderBy('name', 'DESC')->get();
        return view('home')->with(['items' => $items, 'categories' => $categories]);
    }
}
