<?php

namespace App\Http\Controllers\WebCustomer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaundryController extends Controller
{
    public function index($id)
    {
        $laundry = DB::table("laundries")
            ->join('laundry_infos', 'laundries.id', '=', 'laundry_infos.laundry_id')
            ->join('laundry_addresses', 'laundries.id', '=', 'laundry_infos.laundry_id')
            ->where('laundry_infos.laundry_id', $id)
            ->where('laundries.id', $id)
            ->where('laundry_addresses.id', $id)
            ->first();

        $main_services = DB::table('main_services')
            ->where('laundry_id', $id)
            ->get();

        $additional_services = DB::table('additional_services')
            ->where('laundry_id', $id)
            ->get();

        $additional_products = DB::table('additional_products')
            ->where('laundry_id', $id)
            ->get();
        $machines = DB::table('machines')
            ->where('laundry_id', $id)
            ->get();
        // dd($laundry);
        return view('features.Customer.customerindividuallaundry', [
            'laundry' => $laundry,
            'main_services' => $main_services,
            'additional_services' => $additional_services,
            'additional_products' => $additional_products,
            'machines' => $machines,
        ]);
    }
}
