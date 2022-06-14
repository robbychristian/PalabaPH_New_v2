<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OwnerMobile extends Controller
{
    public function login(Request $request)
    {
        $count = DB::table('users')
            ->where('email', $request->email)
            ->count();
        $userDetails = DB::table('users')
            ->where('email', $request->email)
            ->get();
        if ($count === 1) {
            if (Hash::check($request->password, $userDetails[0]->password)) {
                return response('password correct');
            } else {
                return response('password incorrect');
            }
        } else {
            return response('wrong credentials');
        }
    }
}
