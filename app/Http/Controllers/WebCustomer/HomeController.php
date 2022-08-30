<?php

namespace App\Http\Controllers\WebCustomer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $laundries = DB::table('laundries')
            ->join('laundry_addresses', 'laundries.id', '=', 'laundry_addresses.laundry_id')
            ->join('laundry_infos', 'laundries.id', '=', 'laundry_infos.laundry_id')
            ->where('laundries.is_approved', 1)
            ->get();
        return view('features.Customer.customerhome', [
            'laundries' => $laundries
        ]);
    }
}
