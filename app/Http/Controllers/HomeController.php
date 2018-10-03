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
        if (Auth::check()) {
            $items = Item::orderBy(DB::raw('RAND()'))
                ->where('active', true)
                ->where('deleted', false)
                ->where('user_id', '!=', Auth::user()->id)
                ->limit(6)
                ->get();
        } else {
            $items = Item::orderBy(DB::raw('RAND()'))
                ->where('active', true)
                ->where('deleted', false)
                ->limit(6)
                ->get();
        }

        $categories = Category::orderBy('name', 'ASC')->get();
        return view('home')->with(['items' => $items, 'categories' => $categories]);
    }


    public function help()
    {
        return view('help');
    }


    public function lk()
    {
        session(['applocale' => 'lk']);
        App::setLocale('lk');
        return back(302);
    }

    public function en()
    {
        session(['applocale' => 'en']);
        App::setLocale('en');
        return back(302);
    }


    public function showAllProducts()
    {
        $categories = Category::orderBy('name', 'ASC')->get();

        if (Auth::check()) {
            $items = Item::where('active', true)
                ->where('deleted', false)
                ->where('active', true)
                ->where('user_id', '!=', Auth::id())
                ->get();

            $count = Item::where('active', true)
                ->where('deleted', false)
                ->where('active', true)
                ->where('user_id', '!=', Auth::id())
                ->count();
        } else {
            $items = Item::where('active', true)
                ->where('deleted', false)
                ->where('active', true)
                ->get();

            $count = Item::where('active', true)
                ->where('deleted', false)
                ->where('active', true)
                ->count();
        }


        return view('allproducts')->with([
            'items' => $items,
            'count' => $count,
            'categories' => $categories,
        ]);
    }

    public static function showCities($activeCity)
    {
        $cities = DB::table('users')
            ->select(['city'])
            ->distinct()
            ->get();

        foreach ($cities as $city) {
            if ($city->city == $activeCity) {
                echo "<option selected>" . $city->city . "</option>";
            } else {
                echo "<option>" . $city->city . "</option>";
            }
        }

    }

}
