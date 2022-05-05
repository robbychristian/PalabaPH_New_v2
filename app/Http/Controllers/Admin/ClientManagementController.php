<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laundries;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

class ClientManagementController extends Controller
{
    public function index(Request $request)
    {


        //admin datatables
        if ($request->ajax()) {
            $laundries = DB::table('laundries')
                ->join('users', 'laundries.user_id', '=', 'users.id')
                ->select('laundries.*', 'users.first_name', 'users.last_name')
                ->where('users.user_role', 2)
                ->get();

            //dd($laundries);

            return DataTables::of($laundries)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $link = '<a href="' . \URL::route('admin.clientmanagement.show', $row->id) . '" data-id="' . $row->id . '" class="text-success">View</a>';
                    return $link;
                })

                ->addColumn('laundry_owner', function ($row) {
                    return $row->first_name . ' ' . $row->last_name;
                })

                ->addColumn('status', function ($row) {
                    if ($row->is_approved == 0) {
                        return '<span class="badge badge-warning">Pending</span>';
                    } else {
                        return '<span class="badge badge-success">Approved</span>';
                    }
                })

                ->rawColumns(['laundry_owner', 'status', 'action'])
                ->make(true);
        }


        return view('features.clientmanagement');
    }

    public function show($id)
    {
        $laundries = DB::table('laundries')
            ->join('users', 'laundries.user_id', '=', 'users.id')
            ->select('users.*', 'laundries.*')
            ->where('laundries.id', $id)
            ->get();

        return view('features.clientmanagementview', [
            'laundries' => $laundries
        ]);
    }
}
