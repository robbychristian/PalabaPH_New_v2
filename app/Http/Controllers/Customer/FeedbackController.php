<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function addFeedback(Request $request)
    {
        Feedback::create([
            'laundry_id' => $request->laundry_id,
            'user_id' => $request->user_id,
            'comment' => $request->comment,
            'reply' => 'none',
            'rating' => $request->rating
        ]);
    }

    public function getCustomerFeedback(Request $request)
    {
        return DB::table('feedback')
            ->where("laundry_id", $request->laundry_id)
            ->where("user_id", $request->user_id)
            ->get();
    }

    public function getIndividualFeedback(Request $request)
    {
        return DB::table('feedback')
            ->where('id', $request->id)
            ->get();
    }
}
