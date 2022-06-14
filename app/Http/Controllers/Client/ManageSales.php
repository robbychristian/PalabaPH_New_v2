<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class ManageSales extends Controller
{
    public function index(Request $request)
    {
        //admin datatables
        if ($request->ajax()) {
            $sales = DB::table('orders')
                ->join('order_infos', 'order_infos.order_id', '=', 'orders.id')
                ->where('order_infos.status', 'Completed')
                ->get();
            //dd($laundries);

            return DataTables::of($sales)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $link = '<a href="#" data-id="' . $row->id . '"><button class="btn btn-circle btn-primary btn-sm mr-2">
                    <i class="fas fa-search"></i></button></a>';
                    $link = $link . '<a href="#" data-id="' . $row->id . '"><button class="btn btn-circle btn-primary btn-sm">
                    <i class="fas fa-download"></i></button></a>';
                    return $link;
                })

                ->addColumn('name', function ($row) {
                    return $row->first_name . ' ' . $row->last_name;
                })


                ->rawColumns(['name', 'action'])
                ->make(true);
        }
        $sales = DB::table('orders')
            ->join('order_infos', 'order_infos.order_id', '=', 'orders.id')
            ->where('order_infos.status', 'Completed')
            ->get();
        return view('features.Client.managesales', [
            'sales' => $sales
        ]);
    }
}
