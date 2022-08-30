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
        // $laundries = DB::table('laundries')
        // ->join('main_services', 'main_services.laundry_id', '=', 'laundries.id')
        // ->where('laundries.user_id', Auth::user()->id)
        // ->get();
        // dd($laundries);
        if ($request->ajax()) {
            $laundries = DB::table('laundries')
                ->join('main_services', 'main_services.laundry_id', '=', 'laundries.id')
                ->where('laundries.user_id', Auth::user()->id)
                ->get();

            return DataTables::of($laundries)
                ->addIndexColumn()

                ->addColumn('main_serv_action', function ($row) {
                    $link = '<a href="/editmainservice/' . $row->id . '" id="editService' . $row->id . '" class="btn btn-primary btn-circle btn-sm"><i class="fas fa-pen"></i></a>';
                    $link = $link . '<a href="/deletemainservice/' . $row->id . '" id="deleteService' . $row->id . '" class="btn btn-danger btn-circle btn-sm ml-2"><input class="d-none" type="text" name="id' . $row->id . '" value="' . $row->id . '"></input><i class="fas fa-trash"></i></form>';
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
            $laundries = DB::table('laundries')
                ->join('additional_services', 'additional_services.laundry_id', '=', 'laundries.id')
                ->where('laundries.user_id', Auth::user()->id)
                ->get();

            return DataTables::of($laundries)
                ->addIndexColumn()

                ->addColumn('add_serv_action', function ($row) {
                    $link = '<a href="/editadditionalservice/' . $row->id . '" id="additionalServiceEdit' . $row->id . '" class="btn btn-success btn-circle btn-sm"><i class="fas fa-pen"></i></a>';
                    $link = $link . '<a href="/deleteadditionalservice/' . $row->id . '" id="additionalServiceDelete' . $row->id . '" class="btn btn-danger btn-circle btn-sm ml-2"><i class="fas fa-trash"></i></a>';
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
            $laundries = DB::table('laundries')
                ->join('additional_products', 'additional_products.laundry_id', '=', 'laundries.id')
                ->where('laundries.user_id', Auth::user()->id)
                ->get();

            return DataTables::of($laundries)
                ->addIndexColumn()

                ->addColumn('add_prod_action', function ($row) {
                    $link = '<a href="/editadditionalproduct/' . $row->id . '" id="additionalProductEdit' . $row->id . '" class="btn btn-info btn-circle btn-sm"><i class="fas fa-pen"></i></a>';
                    $link = $link . '<a href="/deleteadditionalproduct/' . $row->id . '" id="additionalProductDelete' . $row->id . '" class="btn btn-circle btn-danger btn-sm ml-2"><i class="fas fa-trash"></i></a>';
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
            $request->file('imgService')->storeAs('img_service', Auth::user()->id . '/' . $file, 'public');
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
            $request->file('imgProduct')->storeAs('img_product', Auth::user()->id . '/' . $file, 'public');
            AdditionalProducts::create([
                'laundry_id' => $request->laundryId,
                'add_prod_name' => $request->addProducts,
                'add_prod_price' => $request->priceProducts,
                'add_prod_image_product' => $file,
            ]);
            return redirect('/manageservices')->with("success", "Successfully added an additional product");
        }
    }

    public function editMainService($id)
    {
        $laundry_info = DB::table('main_services')
            ->where('id', $id)
            ->get();
        return view('features.Client.Services.editmainservices')->with('service_id', $id)->with('laundry_info', $laundry_info);
    }

    //FUNCTIONS FOR MAIN SERVICES
    public function submitEditMainService(Request $request)
    {
        DB::table('main_services')
            ->where('id', $request->id)
            ->update([
                'main_serv_name' => $request->name,
                'main_serv_max_kg' => $request->kg,
                'main_serv_price' => $request->price,
            ]);
        return redirect('/editmainservice/' . $request->id);
    }

    public function deleteMainService($id)
    {
        DB::table('main_services')
            ->where('id', $id)
            ->delete();
        return redirect('/manageservices');
    }
    //FUNCTIONS FOR ADDITIONAL SERVICES
    public function editAdditionalService($id)
    {
        $additional_service = DB::table('additional_services')
            ->where('id', $id)
            ->get();
        return view('features.Client.Services.editadditionalservice')->with('service_id', $id)->with('laundry_info', $additional_service);
    }

    public function submitEditAdditionalService(Request $request)
    {
        DB::table('additional_services')
            ->where('id', $request->id)
            ->update([
                'add_serv_name' => $request->name,
                'add_serv_price' => $request->price
            ]);
        return redirect('/editadditionalservice/' . $request->id);
    }

    public function deleteAdditionalService($id)
    {
        DB::table('additional_services')
            ->where('id', $id)
            ->delete();
        return redirect('/manageservices');
    }

    //FUNCTIONS FOR ADDITIONAL PRODUCTS

    public function editAdditionalProduct($id)
    {
        $additional_product = DB::table('additional_products')
            ->where('id', $id)
            ->get();
        return view('features.Client.Services.editadditionalproducts')->with('service_id', $id)->with('laundry_info', $additional_product);
    }

    public function submitEditAdditionalProduct(Request $request)
    {
        DB::table('additional_products')
            ->where('id', $request->id)
            ->update([
                'add_prod_name' => $request->name,
                'add_prod_price' => $request->price
            ]);
        return redirect('/editadditionalproduct/' . $request->id);
    }

    public function deleteAdditionalProduct($id)
    {
        DB::table('additional_products')
            ->where('id', $id)
            ->delete();
        return redirect('/manageservices');
    }
}
