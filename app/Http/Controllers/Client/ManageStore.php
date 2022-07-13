<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Services;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

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
            ->join('services', 'laundries.id', '=', 'services.laundry_id')
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
        if ($request->hasFile('gcash')) {
            $fileName = $request->file('gcash')->getClientOriginalName();
            $services = DB::table('services')
                ->where('laundry_id', $request->laundry_id)
                ->update([
                    'self_service' => $ss,
                    'full_service' => $fs,
                    'pick_up' => $pu,
                    'reservations' => $res,
                    'cash' => $cash,
                    'cashless' => $cl,
                    'gcash_qr_code' => $fileName,
                    'is_published' => 1,
                ]);
            return redirect('/managestore');
        } else {
            $services = DB::table('services')
                ->where('laundry_id', $request->laundry_id)
                ->update([
                    'self_service' => $ss,
                    'full_service' => $fs,
                    'pick_up' => $pu,
                    'reservations' => $res,
                    'cash' => $cash,
                    'cashless' => $cl,
                    'gcash_qr_code' => null,
                    'is_published' => 1,
                ]);
            return redirect('/managestore');
        }
    }

    public function getLaundryInfo(Request $request)
    {
        return DB::table('laundries')
            ->join('laundry_infos', 'laundry_infos.laundry_id', '=', 'laundries.id')
            ->where('laundries.user_id', $request->user_id)
            ->get();
    }

    public function editLaundryInfo(Request $request)
    {
        DB::table('laundry_infos')
            ->where('laundry_id', $request->laundry_id)
            ->update([
                'description' => $request->description,
                'opening_time' => Carbon::parse('2018-06-15' . $request->opening_time),
                'closing_time' => Carbon::parse('2018-06-15' . $request->closing_time),
            ]);
        DB::table('laundries')
            ->where('id', $request->laundry_id)
            ->update([
                'landline' => $request->landline,
                'phone' => $request->contact_no
            ]);
    }

    public function getPassword(Request $request)
    {
        return DB::table('users')
            ->where('id', $request->id)
            ->get();
    }

    public function checkCurrentPassword(Request $request)
    {
        $user = DB::table('users')
            ->where('id', $request->id)
            ->get();
        if (Hash::check($request->password, $user[0]->password)) {
            return "nice";
        } else {
            return 'error';
        }
    }

    public function editPassword(Request $request)
    {
        DB::table('users')
            ->where('id', $request->id)
            ->update([
                'password' => Hash::make($request->password)
            ]);
    }
}
