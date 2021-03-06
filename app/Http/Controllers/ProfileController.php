<?php

namespace App\Http\Controllers;

use App\Item;
use App\Order;
use App\Orderline;
use App\Purchase;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $tab = $request->get('tab');

        if ($tab == 'overview' || $tab == null) {

            $activeItemCount = Item::where('user_id', Auth::user()->id)
                ->where('active', true)
                ->where('deleted', false)
                ->count();

            $pendingItemCount = Item::where('user_id', Auth::user()->id)
                ->where('active', false)
                ->where('deleted', false)
                ->count();

            $temp = $this->getOrderDetailsForOverview();
            if ($temp['total'] == 0) {
                $deliveredPercent = 0;
                $unDeliveredPercent = 0;
            } else {
                $deliveredPercent = $temp['deliveredCount'] / $temp['total'] * 100.00;
                $unDeliveredPercent = $temp['undeliveredCount'] / $temp['total'] * 100.00;
            }

            return view('profile')->with([
                'activeItemCount' => $activeItemCount,
                'pendingItemCount' => $pendingItemCount,
                'deliveredPercent' => $deliveredPercent,
                'undeliveredPercent' => $unDeliveredPercent,
                'undeliveredCount' => $temp['undeliveredCount'],
            ]);
        }

        if ($tab == 'my_items') {
            $items = Item::where('user_id', Auth::user()->id)
                ->where('active', true)
                ->where('deleted', false)
                ->get();
            return view('profile')->with([
                'items' => $items,
            ]);
        }

        if ($tab == 'pending') {
            $pendingItems = Item::where('user_id', Auth::user()->id)
                ->where('active', false)
                ->where('deleted', false)
                ->get();
            return view('profile')->with([
                'pending' => $pendingItems,
            ]);
        }

        if ($tab == 'cust_orders') {
            $orders = Orderline::with('item')
                ->where('delivered', false)
                ->orderBy('order_id', 'DESC')
                ->get();
            $orderlines = [];
            $fulfilledItemsArray = [];

            $fulfilledItems = Orderline::with('item')
                ->where('delivered', true)
                ->orderBy('updated_at', 'DESC')
                ->get();

            foreach ($fulfilledItems as $fulfilledItem) {
                if ($fulfilledItem->item->user_id == Auth::user()->id) {
                    array_push($fulfilledItemsArray, [
                        'orderline_id' => $fulfilledItem->id,
                        'order_id' => $fulfilledItem->order->id,
                        'cust_id' => $fulfilledItem->order->user->id,
                        'cust_name' => $fulfilledItem->order->user->name,
                        'item_id' => $fulfilledItem->item_id,
                        'item_name' => $fulfilledItem->item->name,
                        'quantity' => $fulfilledItem->quantity,
                        'unit_price' => $fulfilledItem->unit_price,
                        'total' => $fulfilledItem->total,
                        'updated_at' => $fulfilledItem->updated_at
                    ]);
                }
            }

            foreach ($orders as $order) {
                if ($order->item->user_id == Auth::user()->id) {
                    array_push($orderlines, [
                        'orderline_id' => $order->id,
                        'order_id' => $order->order->id,
                        'cust_id' => $order->order->user->id,
                        'cust_name' => $order->order->user->name,
                        'item_id' => $order->item_id,
                        'item_name' => $order->item->name,
                        'quantity' => $order->quantity,
                        'unit_price' => $order->unit_price,
                        'total' => $order->total,
                        'shipping_address' => $order->order->purchase == null ? "undefined" : $order->order->purchase->shipping_address,
                        'created_at' => $order->created_at
                    ]);
                }
            }
            return view('profile')->with([
                'orderlines' => $orderlines,
                'fullfilledItems' => $fulfilledItemsArray,
                'i' => 1]);
        }

        if ($tab == 'summary') {
            $purchases = Order::where('user_id', Auth::user()->id)
                ->where('created_at', '>=', date('Y-m-1'))
                ->where('created_at', '<=', date('Y-m-31'))
                ->orderBy('created_at', 'DESC')
                ->get();

            $purchaseTotal = 0;
            foreach ($purchases as $purchase) {
                $purchaseTotal += $purchase->total;
            }

            $cust_orders = Orderline::with('item')
                ->select([
                    'item_id',
                    DB::raw('SUM(quantity) as quantity'),
                    DB::raw('SUM(total) as total'),
                ])
                ->where('delivered', true)
                ->where('created_at', '>=', date('Y-m-1'))
                ->where('created_at', '<=', date('Y-m-31'))
                ->groupBy(['item_id'])
                ->get();


            $orderlines = [];
            $orderlineTotal = 0;
            foreach ($cust_orders as $order) {
                if ($order->item->user_id == Auth::user()->id) {
                    array_push($orderlines, [
                        'item_id' => $order->item_id,
                        'item_name' => $order->item->name,
                        'quantity' => $order->quantity,
                        'total' => $order->total,
                    ]);
                    $orderlineTotal += $order->total;
                }

            }
            return view('profile')->with([
                'purchases' => $purchases,
                'orderlines' => $orderlines,
                'orderlineTotal' => $orderlineTotal,
                'purchaseTotal' => $purchaseTotal,
            ]);

        }

        if ($tab == 'settings') {
            return view('profile')->with(['user' => Auth::user()]);
        }

        if ($tab == 'help') {
            return view('profile');
        }

        return view('profile');
    }


    public function update(Request $request)
    {

        $rules = [
            'name' => 'required|string|max:255',
            'mobile' => 'required|digits:10',
            'province' => 'required',
            'district' => 'required',
            'city' => 'required|max:100',
            'st_address' => 'required|max:190',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect($request->server('HTTP_REFERER'))->with(['errors' => $validator->errors()]);
        } else {
            $user = User::find(Auth::user()->id);
            $user->name = $request->get('name');
            $user->mobile = $request->get('mobile');
            $user->province = $request->get('province');
            $user->district = $request->get('district');
            $user->city = $request->get('city');
            $user->st_address = $request->get('st_address');
            $user->save();

            return redirect($request->server('HTTP_REFERER'));
        }

    }

    private function getOrderDetailsForOverview()
    {
        $undeliveredorderlines = Orderline::with('item')
            ->where('delivered', false)
            ->where('created_at', '>=', date('Y-m-1'))
            ->where('created_at', '<=', date('Y-m-31'))
            ->orderBy('order_id', 'ASC')
            ->get();

        $deliveredOrderlines = Orderline::with('item')
            ->where('delivered', true)
            ->where('created_at', '>=', date('Y-m-1'))
            ->where('created_at', '<=', date('Y-m-31'))
            ->orderBy('order_id', 'ASC')
            ->get();

        $undeliveredCount = 0;
        $deliveredCount = 0;

        foreach ($deliveredOrderlines as $orderline) {
            if ($orderline->item->user_id == Auth::user()->id) {
                $deliveredCount++;
            }
        }

        foreach ($undeliveredorderlines as $orderline) {
            if ($orderline->item->user_id == Auth::user()->id) {
                $undeliveredCount++;
            }
        }

        return [
            'deliveredCount' => $deliveredCount,
            'undeliveredCount' => $undeliveredCount,
            'total' => $deliveredCount + $undeliveredCount,
        ];


    }

    public function updateAvatar(Request $request)
    {
        $data = $request->except(['_token']);
        $user = User::find(Auth::id());


        $rules = [
            'avatar' => 'required|mimes:jpeg,bmp,png'
        ];

        $validator = Validator::make($request->except(['_token']), $rules);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'prev' => $_SERVER['HTTP_REFERER']
            ]);
        }

        $path = "storage/" . $request->file('avatar')->store('avatars');
        $data['avatar'] = $path;

        $user->update($data);

        return redirect('/profile?tab=settings');
    }


    public function updatePassword(Request $request)
    {
        $data = $request->except(['_token']);
        $rules = [
            'password_old' => 'required',
            'password' => 'required|min:4|confirmed',
            'password_confirmation' => 'required'
        ];


        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return back()->with(['passwordUpdate' => false, 'errors' => $validator->errors()]);
        }

        $user = User::find(Auth::id());

        if (Hash::check($data['password_old'], $user->password)) {
            $request->user()->fill([
                'password' => Hash::make($request->get('password'))
            ])->save();
            return back()->with(['passwordUpdate' => true]);
        } else {
            return back()->with(['passwordUpdate' => false, 'err' => 'Current password does not match!']);
        }

    }


    public function showSummary(Request $request)
    {
        $req_purchases = $request->get('purchases');
        $req_sales = $request->get('sales');

        if (!is_null($req_purchases)) {
            $orders = Order::with('purchase')
                ->where('user_id', Auth::id())
                ->orderBy('created_at', 'DESC')
                ->get();

            return view('pages.summary')->with(['orders' => $orders]);
        }

        if (!is_null($req_sales)) {
            $cust_orders = Orderline::with('item')
                ->select([
                    'item_id',
                    DB::raw('SUM(quantity) as quantity'),
                    DB::raw('SUM(total) as total'),
                ])
                ->where('delivered', true)
                ->groupBy(['item_id'])
                ->get();

            $orderlines = [];
            $orderlineTotal = 0;
            foreach ($cust_orders as $order) {
                if ($order->item->user_id == Auth::user()->id) {
                    array_push($orderlines, [
                        'item_id' => $order->item_id,
                        'item_name' => $order->item->name,
                        'quantity' => $order->quantity,
                        'total' => $order->total,
                    ]);
                    $orderlineTotal += $order->total;
                }
            }
            return view('pages.summary')->with([
                'orderlines'=> $orderlines,
                'orderlinesTotal' => $orderlineTotal
            ]);
        }

        return response()->json(['err' => '404 : Not Found'], 404);
    }

    public function enableUserItem(Request $request)
    {
        $itemId = intval($request->get('itemId'));
        try {
            $item = Item::findOrFail($itemId);
            $item->active = true;
            $item->save();
            return response()->json(['msg' => 'ok']);
        } catch (\Throwable $throwable) {
            return response()->json([
                'msg' => 'fail',
                'info' => $throwable->getMessage()
            ],500);
        }
    }

    public function disableUserItem(Request $request)
    {
        $itemId = intval($request->get('itemId'));
        try {
            $item = Item::findOrFail($itemId);
            $item->active = false;
            $item->save();
            return response()->json(['msg' => 'ok']);
        } catch (\Throwable $throwable) {
            return response()->json([
                'msg' => 'fail',
                'info' => $throwable->getMessage()
            ],500);
        }
    }




}
