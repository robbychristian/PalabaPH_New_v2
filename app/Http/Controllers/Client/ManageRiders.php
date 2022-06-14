<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\MobileUsers;

class ManageRiders extends Controller
{
    public function index()
    {
        $laundry = DB::table('laundries')
            ->where('user_id', Auth::user()->id)
            ->get();
        $laundry_id = $laundry[0]->user_id;
        $all_riders = DB::table('mobile_users')
            ->where('laundry_id', $laundry_id)
            ->where('user_role', 4)
            ->get();
        return view('features.Client.manageriders', [
            'laundry_id' => $laundry_id,
            'all_riders' => $all_riders
        ]);
    }

    public function addRiders(Request $request)
    {
        MobileUsers::create([
            'laundry_id' => $request->laundry_id,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'contact_no' => $request->contact_no,
            'email' => $request->email,
            'pass' => $request->password,
            'is_blocked' => 0,
            'user_role' => 4,
        ]);

        return response('success');
    }
}
