<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ManageInventory extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $laundry_list = DB::table('laundries')
            ->where('user_id', Auth::user()->id)
            ->get();
        return view('features.Client.manageinventory')->with('laundries', $laundry_list);
    }

    public function addItem(Request $request)
    {
        dd($request);
    }
}
