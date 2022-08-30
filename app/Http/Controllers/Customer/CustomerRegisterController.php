<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MobileUsers;
use App\Models\CustomerAddress;
use App\Models\UserVerification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mail;
use Illuminate\Support\Str;
use App\Mail\EmailVerification;

class CustomerRegisterController extends Controller
{
    public function registerUser(Request $request)
    {
        if ($request->customer == true) {
            $customer = MobileUsers::create([
                'first_name' => $request->fname,
                'middle_name' => $request->mname,
                'last_name' => $request->lname,
                'contact_no' => $request->cnum,
                'email' => $request->email,
                'password' => Hash::make($request->pass),
                'email_verified_at' => null,
                'is_blocked' => false,
                'user_role' => 3
            ]);

            $token = Str::random(64);
            UserVerification::create([
                'email' => $request->email,
                'token' => $token
            ]);

            Mail::to($request->email)->send(new EmailVerification($token, $request->email));

            CustomerAddress::create([
                'customer_id' => $customer->id,
                'street' => $request->street,
                'state' => $request->province,
                'barangay' => $request->barangay,
                'city' => $request->city,
                'region' => $request->region,
            ]);
            return response(['Success' => "Successfully added an account!"]);
        }
    }

    public function loginUser(Request $request)
    {
        $creds = DB::table('mobile_users')
            ->join('customer_addresses', 'mobile_users.id', '=', 'customer_addresses.customer_id')
            ->where('email', $request->email)
            ->get();
        if (!$creds->isEmpty()) {
            if (Hash::check($request->password, $creds[0]->password)) {
                return response(['response' => true, 'data' => $creds]);
            }
        } else {
            return response(['response' => false]);
        }
    }

    public function editProfile(Request $request)
    {
        $test = DB::table('mobile_users')
            ->where('email', $request->email)
            ->update([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'contact_no' => $request->contact_no,
                'pass' => Hash::make($request->pass)
            ]);
        return $test;
    }
}
