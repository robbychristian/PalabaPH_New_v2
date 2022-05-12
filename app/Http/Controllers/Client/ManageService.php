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
        if ($request->ajax()) {
            $laundries = DB::table('main_services')
                ->join('laundries', 'main_services.laundry_id', '=', 'laundries.id')
                ->where('laundries.user_id', Auth::user()->id)
                ->get();
        }

        $laundry_list = DB::table('laundries')
            ->where('user_id', Auth::user()->id)
            ->get();

        return view('features.Client.manageservices')->with('laundries', $laundry_list);
    }

    public function addService(Request $request)
    {
        MainServices::create([
            'laundry_id' => $request->laundryId,
            'name' => $request->service,
            'max_kg' => $request->weight,
            'price' => $request->priceMain
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
                'name' => $request->addService,
                'price' => $request->priceService,
                'image_service' => $file
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
                'name' => $request->addProducts,
                'price' => $request->priceProducts,
                'image_product' => $file,
            ]);
            return redirect('/manageservices')->with("success", "Successfully added an additional product");
        }
    }
}
