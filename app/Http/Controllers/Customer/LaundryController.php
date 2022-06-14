<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaundryController extends Controller
{
    public function getLaundries()
    {
        $laundries = DB::table('laundries')
            ->join('laundry_infos', 'laundries.id', '=', 'laundry_infos.laundry_id')
            ->get();
        return response(['response' => true, 'data' => $laundries]);
    }

    public function getIndividualLaundry($id)
    {
        $laundry = DB::table('laundries')
            ->join('laundry_addresses', 'laundry_addresses.laundry_id', '=', 'laundries.id')
            ->join('laundry_infos', 'laundry_infos.laundry_id', '=', 'laundries.id')
            ->where('laundries.id', $id)
            ->get();
        return response($laundry);
    }

    public function getMainServices($id)
    {
        $main_services = DB::table("main_services")
            ->where("laundry_id", $id)
            ->get();

        return $main_services;
    }

    public function getAdditionalProducts($id)
    {
        $additionalProducts = DB::table('additional_products')
            ->where('laundry_id', $id)
            ->get();
        return $additionalProducts;
    }

    public function getAdditionalServices($id)
    {
        $additionalServices = DB::table("additional_services")
            ->where('laundry_id', $id)
            ->get();

        return $additionalServices;
    }

    public function getMachines($id)
    {
        $machines = DB::table('machines')
            ->where('laundry_id', $id)
            ->get();
        return $machines;
    }
}
