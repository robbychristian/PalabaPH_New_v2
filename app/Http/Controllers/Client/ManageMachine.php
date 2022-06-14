<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Machines;
use App\Models\MachineMaintenance;

class ManageMachine extends Controller
{
    public function index()
    {
        $laundries = DB::table('laundries')
            ->join('laundry_addresses', 'laundry_addresses.laundry_id', '=', 'laundries.id')
            ->join('laundry_infos', 'laundry_infos.laundry_id', '=', 'laundries.id')
            ->where('laundries.user_id', Auth::user()->id)
            ->select('laundries.id', 'laundries.type_of_laundry', 'laundry_infos.*', 'laundry_addresses.*')
            ->get();
        return view('features.Client.managemachines')->with('laundries', $laundries);
    }

    public function individualMachine($id)
    {
        $laundry = DB::table('laundries')
            ->where('id', $id)
            ->get();
        $machines = DB::table('machines')
            ->where('laundry_id', $id)
            ->get();
        return view('features.Client.managemachineindividual')->with('laundry', $laundry)->with('machines', $machines);
    }

    public function addMachine(Request $request)
    {
        Machines::create([
            'laundry_id' => $request->laundry_id,
            'machine_name' => $request->machine_name,
            'machine_service' => $request->machine_service,
            'max_kg' => (int)$request->max_kg,
            'timer' => (int)$request->timer,
            'price' => (int)$request->price,
            'status' => 0,
            'is_reserved' => 0
        ]);
        return redirect('/managemachine' . '/' . $request->id);
    }

    public function editMachine(Request $request)
    {
        DB::table('machines')
            ->where('id', (int)$request->machine_id)
            ->update([
                'machine_name' => $request->machine_name,
                'machine_service' => $request->machine_service,
                'max_kg' => (int)$request->machine_kg,
                'timer' => (int)$request->machine_timer,
                'price' => (int)$request->machine_price,
            ]);
        return redirect('/managemachine/1');
    }

    public function deleteMachine(Request $request)
    {
        DB::table('machines')
            ->where('id', (int)$request->id)
            ->delete();
    }

    public function addMaintenance(Request $request)
    {
        MachineMaintenance::create([
            'machine_id' => (int)$request->machine_id,
            'description' => $request->description,
            'maintenance_date' => $request->maintenance_date
        ]);

        DB::table("machines")
            ->where('id', (int)$request->machine_id)
            ->update(['maintenance_date' => $request->maintenance_date]);

        return response('success');
    }
}
