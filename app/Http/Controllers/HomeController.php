<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use Illuminate\Support\Facades\App;
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

        $categories = Category::orderBy('name', 'ASC')->get();
        return view('home')->with(['items' => $items, 'categories' => $categories]);
    }


    public function help(){
        return view('help');
    }


    public function lk(){
        session(['applocale'=>'lk']);
        App::setLocale('lk');
        return $this->index();
    }

    public function en(){
        session(['applocale'=>'en']);
        App::setLocale('en');
        return $this->index();
    }

}
