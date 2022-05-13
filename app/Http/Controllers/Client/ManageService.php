<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\MainServices;
use App\Models\AdditionalServices;
use App\Models\AdditionalProducts;
use DataTables;

class ManageService extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        //$laundries = DB::table('main_services')
        //    ->join('laundries', 'main_services.laundry_id', '=', 'laundries.id')
        //    ->join('additional_services', 'main_services.laundry_id', '=', 'additional_services.laundry_id')
        //    ->join('additional_products', 'main_services.laundry_id', '=', 'additional_products.laundry_id')
        //    ->select('laundries.id', 'laundries.user_id', 'main_services.*', 'additional_services.*')
        //    ->where('laundries.user_id', Auth::user()->id)
        //    ->get();
        //return $laundries;
        if ($request->ajax()) {
            $laundries = DB::table('main_services')
                ->join('laundries', 'main_services.laundry_id', '=', 'laundries.id')
                ->where('laundries.user_id', Auth::user()->id)
                ->get();

            return DataTables::of($laundries)
                ->addIndexColumn()

                ->addColumn('main_serv_action', function ($row) {
                    $link = '<a href="#" data-id="' . $row->id . '" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-search"></i></a>';
                    $link = $link . '<a href="#" data-id="' . $row->id . '" class="btn btn-primary btn-circle btn-sm ml-2"><i class="fas fa-search"></i></a>';
                    return $link;
                })

                ->rawColumns(['main_serv_action'])
                ->make(true);
        }

        $laundry_list = DB::table('laundries')
            ->where('user_id', Auth::user()->id)
            ->get();

        return view('features.Client.manageservices')->with('laundries', $laundry_list);
    }

    // function for retrieving data on add serv table
    public function addServTable(Request $request)
    {
        if ($request->ajax()) {
            $laundries = DB::table('additional_services')
                ->join('laundries', 'additional_services.laundry_id', '=', 'laundries.id')
                ->where('laundries.user_id', Auth::user()->id)
                ->get();

            return DataTables::of($laundries)
                ->addIndexColumn()

                ->addColumn('add_serv_action', function ($row) {
                    $link = '<a href="#" data-id="' . $row->id . '" class="btn btn-success btn-circle btn-sm"><i class="fas fa-search"></i></a>';
                    $link = $link . '<a href="#" data-id="' . $row->id . '" class="btn btn-success btn-circle btn-sm ml-2"><i class="fas fa-search"></i></a>';
                    return $link;
                })

                ->rawColumns(['add_serv_action'])
                ->make(true);
        }
    }

    // function for retrieving data on add prod table
    public function addProdTable(Request $request)
    {
        if ($request->ajax()) {
            $laundries = DB::table('additional_products')
                ->join('laundries', 'additional_products.laundry_id', '=', 'laundries.id')
                ->where('laundries.user_id', Auth::user()->id)
                ->get();

            return DataTables::of($laundries)
                ->addIndexColumn()

                ->addColumn('add_prod_action', function ($row) {
                    $link = '<a href="#" data-id="' . $row->id . '" class="btn btn-info btn-circle btn-sm"><i class="fas fa-search"></i></a>';
                    $link = $link . '<a href="#" data-id="' . $row->id . '" class="btn btn-info btn-circle btn-sm ml-2"><i class="fas fa-search"></i></a>';
                    return $link;
                })

                ->rawColumns(['add_prod_action'])
                ->make(true);
        }
    }

    public function addService(Request $request)
    {
        MainServices::create([
            'laundry_id' => $request->laundryId,
            'main_serv_name' => $request->service,
            'main_serv_max_kg' => $request->weight,
            'main_serv_price' => $request->priceMain
        ]);

        return redirect('/manageservices')->with('success', 'Successfully submitted the form!');
    }

    public function addAdditionalService(Request $request)
    {
        if ($request->hasFile('imgService')) {
            $file = $request->file('imgService')->getClientOriginalName();
            $request->file('imgService')->storeAs('img_service', Auth::user()->id . '/' . $file, '');
            AdditionalServices::create([
                'laundry_id' => $request->laundryId,
                'add_serv_name' => $request->addService,
                'add_serv_price' => $request->priceService,
                'add_serv_image_service' => $file
            ]);
            return redirect('/manageservices')->with("success", "Successfully added an additional service");
        } else {
            dd('flase');
        }
    }

    public function addAdditionalProduct(Request $request)
    {
        if ($request->hasFile('imgProduct')) {
            $file = $request->file('imgProduct')->getClientOriginalName();
            $request->file('imgProduct')->storeAs('img_product', Auth::user()->id . '/' . $file, '');
            AdditionalProducts::create([
                'laundry_id' => $request->laundryId,
                'add_prod_name' => $request->addProducts,
                'add_prod_price' => $request->priceProducts,
                'add_prod_image_product' => $file,
            ]);
            return redirect('/manageservices')->with("success", "Successfully added an additional product");
        }
    }
}
