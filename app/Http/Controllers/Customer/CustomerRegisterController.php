<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MobileUsers;
use App\Models\CustomerAddress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                'pass' => Hash::make($request->pass),
                'is_blocked' => false,
                'user_role' => 3
            ]);

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
            if (Hash::check($request->password, $creds[0]->pass)) {
                return response(['response' => true, 'data' => $creds]);
            }
        } else {
            return response(['response' => false]);
        }
    }
}
