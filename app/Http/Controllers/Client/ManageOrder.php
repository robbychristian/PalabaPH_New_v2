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
            ->join('machines', 'machines.laundry_id', '=', 'laundries.id')
            ->where('laundries.id', $id)
            ->orderBy('machine_name', 'asc')
            ->get();
        return view('features.Client.manageorderindividual')->with('laundry', $laundry);
    }
}
