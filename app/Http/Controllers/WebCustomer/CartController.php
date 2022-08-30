<?php

namespace App\Http\Controllers\WebCustomer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\MobileOrderItems;
use App\Models\MobileOrders;
use Illuminate\Support\Facades\Auth;
use App\Models\MobileOrdersInfo;

class CartController extends Controller
{
    public function index($id)
    {
        $items = DB::table('carts')
            ->where('user_id', Auth::guard('customer')->user()->id)
            ->where('laundry_id', $id)
            ->get();
        $address = DB::table("customer_addresses")
            ->where('customer_id', Auth::guard('customer')->user()->id)
            ->first();
        $time_slots = DB::table('time_slots')
            ->where('laundry_id', $id)
            ->get();
        // dd($address);
        $machines = DB::table('machines')
            ->where('laundry_id', $id)
            ->get();
        return view('features.Customer.customercart', [
            'items' => $items,
            'address' => $address,
            'time_slots' => $time_slots,
            'laundry_id' => $id,
            'machines' => $machines,
        ]);
    }

    public function addToCart(Request $request)
    {
        Cart::create([
            'laundry_id' => $request->laundry_id,
            'user_id' => $request->user_id,
            'item_name' => $request->item_name,
            'item_price' => $request->item_price
        ]);
    }

    public function deleteItem(Request $request)
    {
        DB::table('carts')
            ->where('id', $request->id)
            ->delete();
    }

    public function submitPickUp(Request $request)
    {
        $order = MobileOrders::create([
            'laundry_id' => $request->laundry_id,
            'user_id' => $request->user_id,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'total_price' => $request->total_price,
            'mode_of_payment' => $request->mode_of_payment,
            'commodity_type' => $request->commodity_type,
            'segregation_type' => $request->segregation_type,
            'status' => $request->status,
        ]);

        $order_info = MobileOrdersInfo::create([
            'mobile_order_id' => $order->id,
            'payment_status' => "Pending",
            'payment_image_uri' => "none"
        ]);

        return $order->id;
    }

    public function orderedItems(Request $request)
    {
        $orderedItems = MobileOrderItems::create([
            'mobile_order_id' => $request->mobile_order_id,
            'item_name' => $request->item_name,
            'item_price' => $request->item_price,
        ]);
    }
}
