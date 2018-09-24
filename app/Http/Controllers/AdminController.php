<?php

namespace App\Http\Controllers;

use App\AdminItem;
use App\Category;
use App\Http\Middleware\IsAdmin;
use App\Item;
use App\Orderline;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(IsAdmin::class);
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $tab = $request->get('tab');
        if ($tab == 'summary' || is_null($tab)) {

            $orderlines = Orderline::with('item')
                ->where('delivered', true)
                ->where('created_at', '>=', date('Y-m-1'))
                ->where('created_at', '<=', date('Y-m-31'))
                ->select(['item_id', DB::raw('SUM(quantity) as sQuantity')])
                ->groupBy(['item_id'])
                ->get();

            $orderlinesY = Orderline::with('item')
                ->where('delivered', true)
                ->where('created_at', '>=', date('Y-1-1'))
                ->where('created_at', '<=', date('Y-12-31'))
                ->select(['item_id', DB::raw('SUM(quantity) as sQuantity')])
                ->groupBy(['item_id'])
                ->get();

            return view('admin_dash')->with([
                'orderlines' => $orderlines,
                'orderlinesY' => $orderlinesY,
            ]);
        }

        if ($tab == 'users') {
            $users = User::all();
            return view('admin_dash')->with([
                'users' => $users,
            ]);
        }


        if ($tab == 'categories') {
            $categories = Category::all();
            return view('admin_dash')->with([
                'categories' => $categories,
            ]);
        }

        if ($tab == 'add_item') {

            if (!is_null($request->get('showAll'))) {
                if ($request->get('showAll') == 'true') {
                    $adminItems = AdminItem::all();
                    return view('admin_dash')->with([
                        'adminItems' => $adminItems,
                    ]);
                }
            }


            $categories = Category::all();
            return view('admin_dash')->with([
                'categories' => $categories,
            ]);
        }

        return view('admin_dash');
    }

    public function addNewCategory(Request $request)
    {
        $catName = $request->get('name');
        if (strlen($catName) <= 2) {
            return response()->json(['msg' => 'fail']);
        }

        $cat = new Category;
        $cat->name = $catName;
        $cat->save();
        return response()->json(['msg' => 'ok']);
    }

    public function addItemAsAdmin(Request $request)
    {
        $data = $request->except(['_token']);

        $rules = [
            'name' => 'required|min:5|max:191',
            'category_id' => 'required',
            'unit_price' => 'required',
            'image' => 'required|mimes:jpeg,bmp,png'
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return back()->with(['errors' => $validator->errors()]);
        }

        $path = "storage/" . $request->file('image')->store('items');
        $data['image'] = $path;

        AdminItem::create($data);

        return back()->with(['success' => 1]);

    }


    public function showUser($id)
    {
        try {
            $user = User::findOrFail(intval($id));
            if ($user->isadmin) {
                if (Auth::id() != $user->id) {
                    return response()->json(['err' => '401 : Unauthorized'], 401);
                }
            }

            $items = Item::where('user_id', $user->id)->where('deleted', false)->orderBy('created_at', 'DESC')->get();

            return view('pages.user')->with(['user' => $user, 'items' => $items]);
        } catch (\Throwable $throwable) {
            return response()->json(['err' => $throwable->getMessage()], 500);
        }
    }


}
