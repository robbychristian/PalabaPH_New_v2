<?php

namespace App\Http\Controllers\WebCustomer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = DB::table('laundries')
            ->join('mobile_orders', 'laundries.id', '=', 'mobile_orders.laundry_id')
            ->where('mobile_orders.user_id', Auth::guard('customer')->user()->id)
            ->get();

        return view('features.Customer.customerorders', [
            'orders' => $orders
        ]);
    }

    public function individualOrder($id)
    {
        $order = DB::table('mobile_orders')
            ->where('id', $id)
            ->first();
        $order_items = DB::table('mobile_order_items')
            ->where('mobile_order_id', $id)
            ->get();
        $order_info = DB::table('mobile_orders_infos')
            ->where('mobile_order_id', $id)
            ->first();

        return view('features.Customer.customerindividualorder', [
            'order' => $order,
            'order_items' => $order_items,
            'order_info' => $order_info
        ]);
    }
}
