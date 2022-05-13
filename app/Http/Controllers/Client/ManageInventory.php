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

        $inventories = DB::table('inventories')
            ->join('laundries', 'inventories.laundry_id', '=', 'laundries.id')
            ->where('laundries.user_id', Auth::user()->id)
            ->get();

        return view('features.Client.manageinventory', [
            'laundries' => $laundry_list,
            'inventories' => $inventories
        ]);
    }

    public function addItem(Request $request)
    {
        //dd($request->laundry_id);
        Inventory::create([
            'laundry_id' => $request->laundry_id,
            'item_name' => $request->item_name,
            'item_quantity' => $request->item_quantity,
            'item_threshold' => $request->item_threshold,
        ]);

        return redirect('/manageinventory')->with('success', 'Item added in inventory!');
    }
}
