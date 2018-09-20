<?php

namespace App\Http\Controllers;

use App\Order;
use App\Orderline;
use App\Purchase;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function fulfillOrderline($orderlineId)
    {
        $orderlineId = intval($orderlineId);
        $orderline = Orderline::find($orderlineId);
        if (is_null($orderline)) {
            return response()->json(['msg' => 'fail']);
        }

        $orderline->delivered = true;
        $orderline->save();
        return response()->json(['msg' => 'ok']);
    }


    public function show($orderId)
    {

        try {
            $order = Order::findOrFail(intval($orderId));
            $orderlines = $order->orderlines;
            $purchase = Purchase::where('order_id',intval($orderId))->first();

            return view('pages.order')->with([
                'order' => $order,
                'purchase'=>$purchase,
                'orderlines' => $orderlines,
            ]);

        } catch (\Throwable $throwable) {
            return response()->json(['error' => $throwable->getMessage()]);
        }


    }


}
