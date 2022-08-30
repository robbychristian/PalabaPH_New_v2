<?php

namespace App\Http\Controllers\WebCustomer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaints;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ComplaintsController extends Controller
{
    public function index($id)
    {
        return view('features.Customer.customercomplaints', [
            'laundry_id' => $id
        ]);
    }

    public function addComplaints(Request $request)
    {
        if ($request->hasFile('complaint_image')) {
            $fileName = $request->file('complaint_image')->getClientOriginalName();
            $request->file('complaint_image')->storeAs('complaints_image', $request->user_id . '/' . $fileName, 'public');

            Complaints::create([
                'laundry_id' => $request->laundry_id,
                'user_id' => $request->user_id,
                'comment' => $request->comment,
                'category' => $request->category,
                'status' => $request->status,
                'complaint_image' => $fileName
            ]);
        }
    }

    public function viewComplaints()
    {
        $complaints = DB::table('laundries')
            ->join('complaints', 'laundries.id', '=', 'complaints.laundry_id')
            ->where('complaints.user_id', Auth::guard('customer')->user()->id)
            ->get();
        return view('features.Customer.Complaints.customerviewcomplaints', [
            'complaints' => $complaints
        ]);
    }
}
