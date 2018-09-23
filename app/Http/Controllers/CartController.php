<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\Orderline;
use App\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

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

        if ($newQuantity > $cartItem->item->quantity)
            return response()->json(['msg' => 'fail']);
        if ($cartItem->user_id != Auth::user()->id)
            return response()->json(['msg' => 'fail']);

        if (is_null($cartItem)) {
            return response()->json(['msg' => 'fail']);
        } else {
            $cartItem->quantity = intval($newQuantity);
            $cartItem->save();
            return response()->json(['msg' => 'ok']);
        }

    }


    public function deleteItemFromCart(Request $request)
    {
        $id = intval($request->get('cartItemId'));

        $cartItem = Cart::find($id);

        if (is_null($cartItem)) {
            return response()->json(['msg' => 'fail']);
        }

        if ($cartItem->user_id != Auth::user()->id) {
            return response()->json(['msg' => 'fail']);
        }

        $cartItem->delete();

        return response()->json(['msg' => 'ok']);

    }

    public function addToCart(Request $request)
    {
        $id = intval($request->get('itemId'));

        $temp = Cart::where('user_id', Auth::user()->id)
            ->where('item_id', $id)
            ->first();

        if (is_null($temp)) {
            $cartItem = new Cart;
            $cartItem->user_id = Auth::user()->id;
            $cartItem->item_id = $id;
            $cartItem->quantity = 1;
            $cartItem->save();
            return response()->json(['msg' => 'ok']);
        } else {
            if (($temp->quantity + 1) <= $temp->item->quantity) {
                $temp->quantity = $temp->quantity + 1;
                $temp->save();
                return response()->json(['msg' => 'ok']);
            } else {
                return response()->json(['msg' => 'fail']);
            }
        }

    }


    public function checkout()
    {
        $user_id = Auth::user()->id;
        $count = Cart::where('user_id', $user_id)->count();
        if($count == 0){
            return redirect('/');
        }

        $cart = Cart::where('user_id', $user_id)->get();

        $total = 0;
        $totalWithDiscount = 0;
        foreach ($cart as $cartItem) {
            $total += $cartItem->quantity * $cartItem->item->unit_price;
            $totalWithDiscount += ($cartItem->item->unit_price - ($cartItem->item->unit_price * $cartItem->item->discount / 100.0)) * $cartItem->quantity;
        }
        $savings = $total - $totalWithDiscount;

        return view('checkout')->with([
            'cartItems' => $cart,
            'user' => Auth::user(),
            'totalWithDiscount' => $totalWithDiscount,
            'savings' => $savings,
        ]);
    }

    public function storeCheckout(Request $request)
    {
        $user_id = Auth::user()->id;
        $temp = $request->all(['shipping_address', 'billing_address', 'payment_method']);

        $cartItems = Cart::where('user_id', $user_id)->get();
        $totalWithDiscount = 0;
        foreach ($cartItems as $cartItem) {
            $totalWithDiscount += ($cartItem->item->unit_price - ($cartItem->item->unit_price * $cartItem->item->discount / 100.0)) * $cartItem->quantity;
        }

        // SAVE ORDER //
        $order = new Order;
        $order->user_id = $user_id;
        $order->total = $totalWithDiscount;
        $return_val = $order->save();
        if ($return_val) {
            $order_id = $order->id;
        } else {
            $order_id = null;
            return response()->json([
                'error' => 'Failed to save order!',
            ], 500);
        }

        // SAVE PURCHASE //
        $temp['order_id'] = $order_id;
        $purchase = Purchase::create($temp);
        if (is_null($purchase)) {
            return response()->json([
                'error' => 'Failed to save purchase!',
            ], 500);
        }

        // SAVE ORDERLINES //
        foreach ($cartItems as $cartItem) {
            $orderline = new Orderline;
            $orderline->order_id = $order_id;
            $orderline->item_id = $cartItem->item_id;
            $orderline->quantity = $cartItem->quantity;
            $orderline->unit_price = $cartItem->item->unit_price;
            $orderline->total = ($cartItem->item->unit_price - ($cartItem->item->unit_price * $cartItem->item->discount / 100.0)) * $cartItem->quantity;
            $orderline->delivered = false;
            try {
                $orderline->saveOrFail();
            } catch (\Throwable $throwable) {
                return response()->json([
                    'error' => $throwable->getTraceAsString(),
                ], 500);
            }

            $item = $cartItem->item;
            $item->quantity = $item->quantity - $cartItem->quantity;
            $item->save();

            $cartItem->delete();
        }

        return redirect('/order/show/'.$order_id);
    }

}
