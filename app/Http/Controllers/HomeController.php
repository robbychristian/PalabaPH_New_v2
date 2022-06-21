<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $client_count = DB::table('users')
            ->where('user_role', '2')
            ->count();
        $customer_count = DB::table("mobile_users")
            ->where('user_role', '3')
            ->count();
        $rider_count = DB::table('mobile_users')
            ->where('user_role', '4')
            ->count();
        return view('home', [
            'client_count' => $client_count,
            'customer_count' => $customer_count,
            'rider_count' => $rider_count,
        ]);
    }
}
