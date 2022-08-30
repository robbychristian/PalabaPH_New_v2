<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Laundries;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Machines;
use App\Models\MachineOccupancy;
use App\Models\OrderInfo;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

//FCM
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class ManageOrder extends Controller
{
    public function index()
    {
        $list_of_laundries = DB::table('laundries')
            ->where('user_id', Auth::user()->id)
            ->get();
        return view('features.Client.manageorder')->with('laundries', $list_of_laundries);
    }

    public function individualLaundry($id)
    {
        $laundry = DB::table('laundries')
            ->join('machines', 'machines.laundry_id', '=', 'laundries.id')
            ->where('laundries.id', $id)
            ->orderBy('machine_name', 'asc')
            ->get();
        $laundry_services = DB::table("laundries")
            ->join('services', 'services.laundry_id', '=', 'laundries.id')
            ->where('laundries.id', $id)
            ->get();
        $additionalProducts = DB::table('laundries')
            ->join('additional_products', 'additional_products.laundry_id', '=', 'laundries.id')
            ->where('laundries.id', $id)
            ->orderBy("add_prod_name", 'asc')
            ->get();
        $additionalServices = DB::table('laundries')
            ->join('additional_services', 'additional_services.laundry_id', '=', 'laundries.id')
            ->where('laundries.id', $id)
            ->get();
        $customers = DB::table('mobile_users')
            ->where('user_role', '3')
            ->where('is_blocked', 0)
            ->get();
        $laundryID = Laundries::find($id);
        $gcash_image = DB::table('services')
            ->where('laundry_id', $id)
            ->get();
        $reservations = DB::table('mobile_reservations')
            ->join('machines', 'machines.id', '=', 'mobile_reservations.machine_id')
            ->join('mobile_users', 'mobile_users.id', '=', 'mobile_reservations.user_id')
            ->where('mobile_reservations.laundry_id', $id)
            ->where('mobile_reservations.status', 'Pending')
            ->select('mobile_reservations.*', 'machines.machine_name', 'mobile_users.first_name', 'mobile_users.last_name')
            ->get();
        $date = Carbon::now()->format('m-d-Y');

        $reservation_today = [];

        foreach ($reservations as $reservation) {
            if ($date == $reservation->reservation_date) {
                array_push($reservation_today, $reservation);
            }
        }

        $cashlessReceipts = DB::table('mobile_orders_infos')
            ->join('mobile_orders', 'mobile_orders.id', '=', 'mobile_orders_infos.mobile_order_id')
            ->where('mobile_orders.laundry_id', $id)
            ->get();

        return view('features.Client.manageorderindividual', [
            'laundry' => $laundry,
            'additionalProducts' => $additionalProducts,
            'additionalServices' => $additionalServices,
            'laundryCommodities' => $laundry_services,
            'customers' => $customers,
            'laundryID' => $laundryID,
            'reservations' => $reservation_today,
            'cashlessReceipts' => $cashlessReceipts,
            'gcash_image' => $gcash_image
        ]);
    }

    public function submitOrder(Request $request)
    {
        $user_id = (int)$request->user_id;
        $laundry_id = (int)$request->laundry_id;
        $totalPrice = (string)$request->total_price;
        $totalTime = (string)$request->total_time;
        if ($user_id == 0) {
            $user_id = null;
        }
        $order = Orders::create([
            'user_id' => $user_id,
            'laundry_id' => $laundry_id,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'total_price' => $totalPrice,
            'total_time' => $totalTime,
            'mode_of_payment' => $request->mode_of_payment,
            'commodity_type' => $request->type_of_commodity
        ]);
        $orderInfos = OrderInfo::create([
            'order_id' => $order->id,
            'status' => "On Going",
            'payment_status' => "Pending",
            'segregation_type' => $request->segregation_type
        ]);
        $res = send_notification_FCM(61, 'test title', 'test message', 61, 'basic');

        if ($res == 1) {
            return response('SENT NOTIF');
        } else {

            return response('NO NOTIF');
            // fail code
        }

        return response('success');
    }

    public function viewOrder($id)
    {
        $laundry = Laundries::find($id);
        $machines = DB::table('machines')
            ->join('machine_occupancies', 'machine_occupancies.machine_id', 'machines.id')
            ->get();
        $walkIns = DB::table('orders')
            ->join('order_infos', 'order_infos.order_id', '=', 'orders.id')
            ->where('orders.laundry_id', $id)
            ->where('orders.commodity_type', 'Walk-In')
            ->where('order_infos.status', 'On Going')
            ->get();
        $pickUps = DB::table('orders')
            ->join('order_infos', 'order_infos.order_id', '=', 'orders.id')
            ->where('orders.laundry_id', $id)
            ->where('orders.commodity_type', 'Pick-up')
            ->where('order_infos.status', 'On Going')
            ->get();
        $dropOffs = DB::table('orders')
            ->join('order_infos', 'order_infos.order_id', '=', 'orders.id')
            ->where('orders.laundry_id', $id)
            ->where('orders.commodity_type', 'Drop-Off')
            ->where('order_infos.status', 'On Going')
            ->get();
        $reservation = DB::table('orders')
            ->join('order_infos', 'order_infos.order_id', '=', 'orders.id')
            ->where('orders.laundry_id', $id)
            ->where('orders.commodity_type', 'Reservation')
            ->where('order_infos.status', 'On Going')
            ->get();

        return view('features.Client.vieworder', [
            'laundry' => $laundry,
            'machines' => $machines,
            'walkIns' => $walkIns,
            'pickUps' => $pickUps,
            'dropOffs' => $dropOffs,
            'reservations' => $reservation
        ]);
    }

    public function updateMachineState(Request $request)
    {
        $machine = DB::table('machines')
            ->where("id", $request->id)
            ->get();
        DB::table('machines')
            ->where('id', $request->id)
            ->update(['status' => 1]);
        MachineOccupancy::create([
            'machine_id' => $machine[0]->id,
            'machine_timer' => $machine[0]->timer,
            'machine_status' => $request->machine_status,
            'machine_service' => $request->machine_service,
            'user_id' => $request->user_id,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'time_end' => $request->time_end,
        ]);
    }
    public function closeMachineState(Request $request)
    {
        DB::table('machine_occupancies')
            ->where('id', $request->machine_occupancy_id)
            ->update(['machine_status' => "Done"]);
        DB::table("machines")
            ->where('id', $request->machine_id)
            ->update(['status' => 0]);
        // return response($request);
    }

    public function updateDryMachineTime(Request $request)
    {
        DB::table("machine_occupancies")
            ->where('id', $request->id)
            ->update([
                'machine_service' => "Dry (Started)",
                'time_end' => $request->time_end
            ]);
    }

    public function updatePaymentStatus(Request $request)
    {
        DB::table('order_infos')
            ->where('id', $request->id)
            ->update([
                'payment_status' => "Paid"
            ]);
    }

    public function updateLaundryStatus(Request $request)
    {
        if ($request->user_id == '') {
            DB::table('order_infos')
                ->where('id', $request->id)
                ->update([
                    'status' => "Completed"
                ]);
        } else {
            $getToken = DB::table('mobile_users')
                ->where('id', $request->user_id)
                ->get();
            if($getToken[0]->notif_token == null) {
                DB::table('order_infos')
                    ->where('id', $request->id)
                    ->update([
                        'status' => "Completed"
                    ]);
            } else {
                $messaging = app('firebase.messaging');
                $deviceToken = $getToken[0]->notif_token;
                $title = "Order Completed!";
                $body =  "Your order has been completed!";
    
                $message = CloudMessage::withTarget('token', $deviceToken)
                    ->withNotification(Notification::create($title, $body))
                    ->withData(['key' => 'value']);
                $messaging->send($message);
                DB::table('order_infos')
                    ->where('id', $request->id)
                    ->update([
                        'status' => "Completed"
                    ]);
            }
        }
    }

    public function updateQueuedWashStatus(Request $request)
    {
        DB::table('machine_occupancies')
            ->where('id', $request->id)
            ->update([
                'machine_status' => "pending",
                'time_end' => $request->time_end
            ]);
        DB::table('machines')
            ->where('id', $request->machine_id)
            ->update([
                'status' => 1
            ]);
    }

    public function deleteOrder(Request $request)
    {
        DB::table('order_infos')
            ->where('id', $request->id)
            ->update([
                'status' => "Void",
                'payment_status' => "Voided"
            ]);
    }

    public function deleteMachine(Request $request)
    {
        DB::table('machine_occupancies')
            ->where('id', $request->id)
            ->delete();
    }
}
