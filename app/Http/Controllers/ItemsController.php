<?php

namespace App\Http\Controllers;

use App\Category;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        if ($request->get('param') == "") {
            return redirect('/');
        }
        if (Auth::check()) {
            $items = Item::where('active', true)
//                ->where('user_id', '!=', Auth::user()->id)
                ->where('deleted', false)
                ->where('name', 'like', '%' . $request->get('param') . '%')
                ->get();

            $count = Item::where('active', true)
//                ->where('user_id', '!=', Auth::user()->id)
                ->where('deleted', false)
                ->where('name', 'like', '%' . $request->get('param') . '%')
                ->count();
        } else {
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


    public function showItem($id)
    {
        $item = Item::find(intval($id));
        if (is_null($item)) {
            return back();
        }

        return view('item')->with(['item' => $item]);


    }

    public function showAdd()
    {
        return view('pages.n_item')->with(['categories' => Category::all()]);
    }

    public function storeItem(Request $request)
    {
        $data = $request->except(['_token']);
        $data['user_id'] = Auth::id();
        $data['active'] = false;
        $data['deleted'] = false;

        $rules = [
            'name' => 'required|min:5|max:191',
            'category_id' => 'required',
            'quantity' => 'required',
            'unit_price' => 'required',
            'description' => 'max:191',
            'image' => 'required|mimes:jpeg,bmp,png'
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return back()->with('errors', $validator->errors());
        }

        $path = "storage/" . $request->file('image')->store('items');
        $data['image'] = $path;

        $item = Item::create($data);

        return redirect('/item/' . $item->id);

    }


    public function showUpdate(Request $request)
    {
        try {
            $item = Item::findOrFail(intval($request->get('id')));
        } catch (\Throwable $throwable) {
            return response()->json(['err' => $throwable->getMessage()]);
        }

        return view('pages.n_item')->with([
            'categories' => Category::all(),
            'item' => $item,
        ]);
    }


    public function doUpdate(Request $request)
    {
        $id = $request->get('item_id');
        $data = $request->except(['_token', 'item_id']);

        $rules = [
            'name' => 'required|min:5|max:191',
            'category_id' => 'required',
            'quantity' => 'required',
            'unit_price' => 'required',
            'description' => 'max:191',
            'image' => 'mimes:jpeg,bmp,png'
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return back()->with('errors', $validator->errors());
        }

        if ($request->hasFile('image')) {
            $image = "storage/" . $request->file('image')->store('items');
            $data['image'] = $image;
        }

        try {
            $item = Item::findOrFail(intval($id));
            $item->update($data);
        } catch (\Throwable $throwable) {
            return response()->json(['err' => $throwable->getMessage()]);
        }

        return redirect('/item/' . $id);

    }

    public function doDelete(Request $request)
    {
        $id = intval($request->get('itemId'));
        try {
            $item = Item::findOrFail($id);
            $item->deleted = true;
            $item->save();
            return response()->json(['msg' => 'ok']);
        } catch (\Throwable $throwable) {
            return response()->json(['msg' => 'fail']);
        }
    }


    public function itemsByCategory($category)
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $cat = Category::where('name', 'like', '%' . $category . '%')->first();
        if (is_null($cat)) {
            return response()->json(['err' => '404 : Not Found'], 404);
        } else {
            $cat_id = $cat->id;
        }

        $items = Item::where('active', true)
            ->where('deleted', false)
            ->where('category_id', $cat_id)
            ->get();

        $count = Item::where('active', true)
            ->where('deleted', false)
            ->where('category_id', $cat_id)
            ->count();

        return view('category')->with([
            'items' => $items,
            'count' => $count,
            'category' => $cat->name,
            'categories' => $categories,
        ]);
    }


}
