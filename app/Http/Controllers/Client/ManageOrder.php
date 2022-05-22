<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
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
            ->join('services', 'services.laundry_id', '=', 'laundries.id')
            ->where('laundries.id', $id)
            ->get();
        return view('features.Client.manageorderindividual')->with('laundry', $laundry);
    }
}
