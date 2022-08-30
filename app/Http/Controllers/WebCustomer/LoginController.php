<?php

namespace App\Http\Controllers\WebCustomer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function index()
    {
        return view('features.Customer.login');
    }
    public function guard()
    {
        return Auth::guard('customer');
    }
    public function login(Request $request)
    {

        // if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        //     return redirect('/customer/home');
        // } else {
        //     $this->incrementLoginAttempts($request);
        //     return response()->json([
        //         'error' => 'This account is not activcustomated.'
        //     ], 401);
        // }
        // dd(Auth::guard('customer')->login(['email' => $request->email, 'pass' => $request->password]));
        if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' => $request->password])) {
            // if successful, redirect to intended location
            return redirect()->intended('customer/home');
        };
        return back()->withInput($request->only('email', 'remember'))->with('error', 'invalid');
        // if (Auth::guard('customer')->attempt(['email' => $request->email, 'pass' =>
        // $request->password], $request->remember)) {
        //     return redirect()->intended(route('home'));
        // // } else {
        // if (Auth::guard('customer')->attempt(['email' => $request->email, 'password' =>
        // $request->password], $request->remember)) {
        //     return redirect()->intended('/customer/home');
        //     // return redirect('customer/home');
        // }
        // return back()->withInput($request->only('email', 'remember'));
        // }
    }
    // $valid = DB::table('mobile_users')->where('email', $request->email)->first();
    // if ($valid->email_verified_at == '') {
    //     return redirect('/login')->with("Error", "Your Email is not yet verified!");
    // } else {
    //     if ($this->guard()->validate($this->credentials($request))) {
    //         if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    //             return redirect('/home');
    //         } else {
    //             $this->incrementLoginAttempts($request);
    //             return response()->json([
    //                 'error' => 'This account is not activated.'
    //             ], 401);
    //         }
    //     } else {
    //         // dd('ok');
    //         $this->incrementLoginAttempts($request);
    //         return redirect('/login')->with('error', 'test');
    //     }
    // }

}
