<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaints;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class ManageComplaints extends Controller
{
    public function index()
    {
        $laundry = DB::table('laundries')
            ->where('user_id', Auth::user()->id)
            ->get();
        $complaints = DB::table('complaints')
            ->join('mobile_users', 'mobile_users.id', 'complaints.user_id')
            ->select('complaints.*', 'mobile_users.first_name', 'mobile_users.middle_name', 'mobile_users.last_name', 'mobile_users.notif_token')
            ->where('complaints.laundry_id', $laundry[0]->id)
            ->get();
        return view('features.Client.Complaints.viewcomplaints', [
            'complaints' => $complaints
        ]);
    }

    public function replyToComplaints(Request $request)
    {
        $messaging = app('firebase.messaging');
        $deviceToken = $request->notif_token;
        $title = 'Laundry Shop Complaint Reply';
        $body = $request->reply;

        $message = CloudMessage::withTarget('token', $deviceToken)
            ->withNotification(Notification::create('Laundry shop replied to complaint!', $request->reply))
            ->withData(['key' => 'value']);
        $messaging->send($message);

        DB::table('complaints')
            ->where('id', $request->id)
            ->update([
                'reply' => $request->reply,
                'status' => 'Resolved'
            ]);
    }

    public function toReview(Request $request)
    {
        DB::table("complaints")
            ->where('id', $request->id)
            ->update([
                'status' => "Review"
            ]);
    }
}
