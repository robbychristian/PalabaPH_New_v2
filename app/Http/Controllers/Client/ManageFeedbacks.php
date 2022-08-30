<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class ManageFeedbacks extends Controller
{
    public function index()
    {
        $laundry = DB::table("laundries")
            ->where('user_id', Auth::user()->id)
            ->get();
        $feedbacks = DB::table('feedback')
            ->join('mobile_users', 'mobile_users.id', 'feedback.user_id')
            ->select('feedback.*', 'mobile_users.first_name', 'mobile_users.middle_name', 'mobile_users.last_name', 'mobile_users.notif_token')
            ->where('feedback.laundry_id', $laundry[0]->id)
            ->get();
        return view('features.Client.Feedbacks.viewfeedbacks', [
            'feedbacks' => $feedbacks
        ]);
    }

    public function replyToFeedback(Request $request)
    {
        $messaging = app('firebase.messaging');
        $deviceToken = $request->notif_token;
        $title = "Laundry shop replied to feedback!";
        $body = $request->reply;

        $message = CloudMessage::withTarget('token', $deviceToken)
            ->withNotification(Notification::create($title, $body))
            ->withData(['key' => 'value']);
        $messaging->send($message);

        DB::table('feedback')
            ->where("id", $request->id)
            ->update([
                'reply' => $request->reply,
                'status' => "Reviewed"
            ]);
    }
}
