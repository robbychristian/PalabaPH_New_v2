<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DataTables;

class ManageService extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $laundries = DB::table('main_services')
                ->join('laundries', 'main_services.laundry_id', '=', 'laundries.id')
                ->where('laundries.user_id', Auth::user()->id)
                ->get();
            dd($laundries);
        }

        return view('features.Client.manageservices');
    }
}
