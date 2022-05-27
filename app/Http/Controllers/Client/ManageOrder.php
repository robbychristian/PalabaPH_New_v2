<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManageOrder extends Controller
{
    public function index()
    {
        $list_of_laundries = DB::table('laundries')
            ->get();
        return view('features.Client.manageorder')->with('laundries', $list_of_laundries);
    }

    public function individualLaundry($id)
    {
        $laundry = DB::table('laundries')
            ->join('machines', 'machines.laundry_id', '=', 'laundries.id')
            ->where('laundries.id', $id)
            ->orderBy('machine_name', 'asc')
            ->get();
        $laundry_services = DB::table("laundries")
            ->join('services', 'services.laundry_id', '=', 'laundries.id')
            ->where('laundries.id', $id)
            ->get();
        $additionalProducts = DB::table('laundries')
            ->join('additional_products', 'additional_products.laundry_id', '=', 'laundries.id')
            ->where('laundries.id', $id)
            ->orderBy("add_prod_name", 'asc')
            ->get();
        $additionalServices = DB::table('laundries')
            ->join('additional_services', 'additional_services.laundry_id', '=', 'laundries.id')
            ->where('laundries.id', $id)
            ->get();
        $customers = DB::table('mobile_users')
            ->where('user_role', '3')
            ->where('is_blocked', 0)
            ->get();
        return view('features.Client.manageorderindividual', [
            'laundry' => $laundry,
            'additionalProducts' => $additionalProducts,
            'additionalServices' => $additionalServices,
            'laundryCommodities' => $laundry_services,
            'customers' => $customers,
        ]);
    }

    public function submitOrder(Request $request)
    {
        $user_id = (int)$request->user_id;
        $totalPrice = (string)$request->total_price;
        $totalTime = (string)$request->title_time;
        if ($user_id == 0) {
            $user_id = null;
        }
        $order = Orders::create([
            'user_id' => $user_id,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'total_price' => $totalPrice,
            'total_time' => $totalTime,
            'mode_of_payment' => $request->mode_of_payment,
            'commodity_type' => $request->type_of_commodity
        ]);
        return response('success');
    }
}
