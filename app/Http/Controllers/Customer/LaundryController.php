<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaundryController extends Controller
{
    public function getLaundries()
    {
        $laundries = DB::table('laundries')
            ->join('laundry_infos', 'laundries.id', '=', 'laundry_infos.laundry_id')
            ->get();
        return response(['response' => true, 'data' => $laundries]);
    }
}
