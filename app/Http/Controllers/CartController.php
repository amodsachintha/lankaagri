<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public static function getCartCount()
    {
        $count = DB::table('carts')
            ->where('user_id', Auth::user()->id)
            ->count();

        return $count;
    }

    public function show()
    {
        $cartItems = Cart::where('user_id', Auth::user()->id)->get();

        $total = 0;
        $totalWithDiscount = 0;

        foreach ($cartItems as $cartItem) {
            $total += $cartItem->quantity * $cartItem->item->unit_price;
            $totalWithDiscount += ($cartItem->item->unit_price - ($cartItem->item->unit_price * $cartItem->item->discount / 100.0)) * $cartItem->quantity;
        }
        $savings = $total - $totalWithDiscount;

        return view('cart')->with([
            'cartItems' => $cartItems,
            'total' => $total,
            'totalWithDiscount' => $totalWithDiscount,
            'savings' => $savings,
        ]);
    }


    public function updateQuantity(Request $request)
    {
        $itemId = $request->get('itemId');
        $newQuantity = $request->get('quantity');
        $cartItem = Cart::find(intval($itemId));

        if($newQuantity > $cartItem->item->quantity)
            return response()->json(['msg' => 'fail']);
        if($cartItem->user_id != Auth::user()->id)
            return response()->json(['msg' => 'fail']);

        if (is_null($cartItem)) {
            return response()->json(['msg' => 'fail']);
        } else {
            $cartItem->quantity = intval($newQuantity);
            $cartItem->save();
            return response()->json(['msg' => 'ok']);
        }

    }


    public function deleteItemFromCart(Request $request){
        $id = intval($request->get('cartItemId'));

        $cartItem = Cart::find($id);

        if(is_null($cartItem)){
            return response()->json(['msg' => 'fail']);
        }

        if($cartItem->user_id != Auth::user()->id){
            return response()->json(['msg' => 'fail']);
        }

        $cartItem->delete();

        return response()->json(['msg' => 'ok']);

    }

}
