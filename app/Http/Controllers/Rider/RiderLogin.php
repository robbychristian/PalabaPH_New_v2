<?php

namespace App\Http\Controllers\Rider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RiderLogin extends Controller
{
    public function loginRider(Request $request)
    {
        $exist = DB::table('mobile_users')
            ->where('email', $request->email)
            ->count();
        $rider_creds = DB::table('mobile_users')
            ->where('email', $request->email)
            ->get();
        if ($exist === 1) {
            if ($request->password === $rider_creds[0]->pass) {
                return response([
                    'response' => true,
                    'data' => $rider_creds[0]
                ]);
            } else {
                return response('password incorrect');
            }
        } else {
            return response("wrong credentials");
        }
    }
}
