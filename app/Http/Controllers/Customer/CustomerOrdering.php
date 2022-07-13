<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Illuminate\Support\Facades\DB;
use App\Models\MobileOrders;
use App\Models\MobileOrderItems;
use App\Models\MobileOrdersInfo;

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

        $messaging->send($message);
    }

    public function orderMobile(Request $request)
    {
        $order = MobileOrders::create([
            'laundry_id' => $request->laundry_id,
            'user_id' => $request->user_id,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'total_price' => $request->total_price,
            'mode_of_payment' => $request->mode_of_payment,
            'commodity_type' => $request->commodity_type,
            'segregation_type' => $request->segregation_type,
            'status' => $request->status,
        ]);

        return $order->id;
    }

    public function orderedItems(Request $request)
    {
        $orderedItems = MobileOrderItems::create([
            'mobile_order_id' => $request->order_id,
            'item_name' => $request->item_name,
            'item_price' => $request->item_price,
        ]);

        return response('success');
    }

    public function showCustomerOrder($id)
    {
        $pendingOrders = DB::table('mobile_orders')
            ->where('user_id', $id)
            ->get();
        return $pendingOrders;
    }
    public function updatePaymentStatus(Request $request)
    {
        if ($request->hasFile('imageFile')) {
            $fileName = $request->file('imageFile')->getClientOriginalName();
            $request->file('imageFile')->storeAs('cashless_receipts', $request->user_id . '/' . $fileName, '');
            MobileOrdersInfo::create([
                'mobile_order_id' => $request->mobile_order_id,
                'payment_status' => "Paid",
                'payment_image_uri' => $fileName
            ]);
        }
    }
}
