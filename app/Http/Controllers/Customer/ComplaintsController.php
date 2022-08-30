<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaints;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ComplaintsController extends Controller
{
    public function addComplaints(Request $request)
    {
        // return $request;
        if ($request->hasFile('image_file')) {
            // return $request->image_file;
            $fileName = $request->file('image_file')->getClientOriginalName();
            $request->file('image_file')->storeAs('complaints_image', $request->user_id . '/' . $fileName, '');
            Complaints::create([
                'laundry_id' => $request->laundry_id,
                'user_id' => $request->user_id,
                'comment' => $request->comment,
                'category' => $request->category,
                'status' => "Pending",
                'reply' => 'none',
                'complaint_image' => $fileName
            ]);
        } else {
            return 'error';
        }
    }

    public function getCustomerComplaints(Request $request)
    {
        return DB::table('complaints')
            ->where('laundry_id', $request->laundry_id)
            ->where('user_id', $request->user_id)
            ->get();
    }

    public function getIndividualComplaint(Request $request)
    {
        return DB::table('complaints')
            ->where('id', $request->id)
            ->get();
    }
}
