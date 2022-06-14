<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Illuminate\Support\Facades\DB;

class CustomerOrdering extends Controller
{
    public function __construct(Messaging $messaging)
    {
        $this->messaging = $messaging;
    }

    public function updateToken(Request $request)
    {
        DB::table('mobile_users')
            ->where('id', $request->id)
            ->update(['notif_token' => $request->token]);
        return response('token updated!');
    }

    public function sendNotification()
    {
        $messaging = app('firebase.messaging');
        $deviceToken = 'e9_UwPTVTwKKfq2s0BSITO:APA91bHmMSSobQ71EaFxNqlPmk5VQeLvXB7Ba2ZsQC95np7aGKJK5gymSiaTl430F-Aobql9HhMAtDWx9eOgfub8G0YqWifVvwMkpZ-9o-TtzwuAoSFp3PA-7csv3nIhtFCZ8M5v-cza';
        $title = 'My Notification Title';
        $body = 'My Notification Body';
        $imageUrl = 'http://lorempixel.com/400/200/';
        $notification = Notification::fromArray([
            'title' => $title,
            'body' => $body,
            'image' => $imageUrl,
        ]);

        $message = CloudMessage::withTarget('token', $deviceToken)
            ->withNotification(Notification::create('Your order is completed!', 'The laundry shop is now finalizing your order!'))
            ->withData(['key' => 'value']);


        // $message = CloudMessage::fromArray([
        //     'token' => $deviceToken,
        //     'notification' => [/* Notification data as array */], // optional
        //     'data' => [/* data array */], // optional
        // ]);

        $messaging->send($message);
    }
}
