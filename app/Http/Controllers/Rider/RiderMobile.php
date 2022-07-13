<?php

namespace App\Http\Controllers\Rider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RiderMobile extends Controller
{
    public function getLaundryOrders(Request $request)
    {
        $all_laundry_orders = DB::table('mobile_orders')
            ->where('laundry_id', $request->laundry_id)
            ->where('status', 'Pending')
            ->get();
        return $all_laundry_orders;
    }

    public function getSpecificOrder(Request $request)
    {
        $order_details = DB::table('mobile_orders')
            ->where('id', $request->id)
            ->get();

        $order = DB::table('customer_addresses')
            ->join('mobile_orders', 'mobile_orders.user_id', '=', 'customer_addresses.customer_id')
            ->where('mobile_orders.id', $request->id)
            ->get();
        return $order;
    }

    public function acceptOrder(Request $request)
    {
        DB::table('mobile_orders')
            ->where('id', $request->id)
            ->update([
                'status' => 'Accepted'
            ]);
    }

    public function getGcashUrl(Request $request)
    {
        return DB::table('services')
            ->where('laundry_id', $request->laundry_id)
            ->get();
    }
}
