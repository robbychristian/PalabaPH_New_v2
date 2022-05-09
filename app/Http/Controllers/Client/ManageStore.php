<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Services;
use DataTables;
use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;

class ManageStore extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $storeOwned = DB::table('laundries')
            ->join('laundry_addresses', 'laundries.id', '=', 'laundry_addresses.laundry_id')
            ->join('laundry_infos', 'laundries.id', '=', 'laundry_infos.laundry_id')
            ->where('user_id', Auth::user()->id)
            ->get();
        return view('features.Client.managestores')->with('storeOwned', $storeOwned);
    }

    public function store(Request $request)
    {
        $ss = '';
        $fs = '';
        $pu = '';
        $res = '';
        $cash = '';
        $cl = '';
        if ($request->self_service == 'true') {
            $ss = true;
        } else {
            $ss = false;
        }
        if ($request->full_service == 'true') {
            $fs = true;
        } else {
            $fs = false;
        }
        if ($request->pickup == 'true') {
            $pu = true;
        } else {
            $pu = false;
        }
        if ($request->reservation == 'true') {
            $res = true;
        } else {
            $res = false;
        }
        if ($request->cash == 'true') {
            $cash = true;
        } else {
            $cash = false;
        }
        if ($request->cashless == 'true') {
            $cl = true;
        } else {
            $cl = false;
        }
        $services = Services::create([
            'laundry_id' => $request->laundry_id,
            'self_service' => $ss,
            'full_service' => $fs,
            'pick_up' => $pu,
            'reservations' => $res,
            'cash' => $cash,
            'cashless' => $cl,
            'gcash_qr_code' => $request->gcash,
        ]);
        return $services;
    }
}