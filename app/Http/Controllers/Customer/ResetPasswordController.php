<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Mail;

class ResetPasswordController extends Controller
{
    public function index()
    {
        return view('features.Customer.customerreset');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:mobile_users'
        ]);
        $token = Str::random(64);

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );
        //NEEDS EMAIL TEMPLATE

        return back()->with('message', 'wow');
    }

    public function getPassword($token)
    {
        return view('features.Customer.customerresetpassword', ['token' => $token]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:mobile_users',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where(['email' => $request->email, 'token' => $request->token])
            ->latest();
        if (!$updatePassword) {
            return back()->withInput()->with('error', 'no');
        }

        $mobile_user = DB::table('mobile_users')
            ->where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
        
        DB::table('password_resets')->where(['email' => $request->email])->delete();
        return redirect('/customer/login')->with('password_reset', 'nice');
    }
}
