<?php

namespace App\Http\Controllers\WebCustomer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index($id)
    {
        return view('features.Customer.customerfeedback', [
            'laundry_id' => $id
        ]);
    }

    public function addFeedback(Request $request)
    {
        Feedback::create([
            'laundry_id' => $request->laundry_id,
            'user_id' => $request->user_id,
            'comment' => $request->comment,
            'category' => $request->category,
            'status' => $request->status,
            'rating' => $request->rating,
        ]);
    }

    public function viewFeedbacks()
    {
        $feedbacks = DB::table('laundries')
            ->join('feedback', 'laundries.id', '=', 'feedback.laundry_id')
            ->where('feedback.user_id', Auth::guard('customer')->user()->id)
            ->get();
        return view('features.Customer.Feedbacks.customerviewfeedback', [
            'feedbacks' => $feedbacks
        ]);
    }
}
