<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class ManageSales extends Controller
{
    public function index(Request $request)
    {
        $laundryInfo = DB::table('laundries')
            ->where('user_id', Auth::user()->id)
            ->get();
        $laundry_id = $laundryInfo[0]->id;
        //admin datatables
        if ($request->ajax()) {
            $sales = DB::table('orders')
                ->join('order_infos', 'order_infos.order_id', '=', 'orders.id')
                ->where('order_infos.status', 'Completed')
                ->where('orders.laundry_id', $laundry_id)
                ->orWhere('order_infos.status', 'Void')
                ->get();
            //dd($laundries);

            return DataTables::of($sales)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $link = '<a href="/viewsalesinformation/' . $row->id . '" id="' . $row->id . '" data-id="' . $row->id . '"><button class="btn btn-circle btn-primary btn-sm mr-2">
                    <i class="fas fa-search"></i></button></a>';
                    $link = $link . '<a href="/downloadreceipt/' . $row->id . '" " id="' . $row->id . '" data-id="' . $row->id . '"><button class="btn btn-circle btn-primary btn-sm">
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
            ->where('orders.laundry_id', $laundry_id)
            ->get();
        return view('features.Client.managesales', [
            'sales' => $sales
        ]);
    }

    public function downloadReceipt($id)
    {
        $order_info = DB::table('orders')
            ->join('order_infos', 'order_infos.order_id', '=', 'orders.id')
            ->where('order_infos.id', $id)
            ->get();
        $receipt_data = (json_encode($order_info[0]));
        $file_name = 'receiptNo' . $id . ".txt";
        Storage::disk('public')->put($file_name, $receipt_data);

        $path = public_path('storage/' . $file_name);

        return Response::download($path, $file_name);
    }

    public function viewSalesInformation($id)
    {
        $sales_info = DB::table('orders')
            ->join('order_infos', 'order_infos.order_id', '=', 'orders.id')
            ->where('order_infos.id', $id)
            ->get();

        return view('features.Client.viewsalesinformation', [
            'sales' => $sales_info
        ]);
    }
}
