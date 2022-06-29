<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\TimeSlots;
use App\Models\MobileReservations;

class ManageReservation extends Controller
{
    public function index()
    {
        $laundry = DB::table('laundries')
            ->where('user_id', Auth::user()->id)
            ->get();
        $laundry_id = $laundry[0]->id;

        $laundry_info = DB::table("laundry_infos")
            ->where('laundry_id', $laundry_id)
            ->get();

        $time_slots = DB::table('time_slots')
            ->where("laundry_id", $laundry_id)
            ->get();

        $reservations = DB::table('mobile_reservations')
            ->join('machines', 'machines.id', '=', 'mobile_reservations.machine_id')
            ->join('mobile_users', 'mobile_users.id', '=', 'mobile_reservations.user_id')
            ->where('mobile_reservations.laundry_id', $laundry_id)
            ->where('mobile_reservations.status', 'Pending')
            ->select('mobile_reservations.*', 'machines.machine_name', 'mobile_users.first_name', 'mobile_users.last_name')
            ->get();
        return view('features.Client.Reservation.viewreservation', [
            'laundry_id' => $laundry_id,
            'laundry_info' => $laundry_info,
            'time_slots' => $time_slots,
            'reservations' => $reservations
        ]);
    }

    public function cancelReservation(Request $request)
    {
        DB::table('mobile_reservations')
            ->where('id', $request->id)
            ->update([
                'status' => 'Cancelled'
            ]);
    }

    public function addTimeSlot(Request $request)
    {
        TimeSlots::create([
            'laundry_id' => $request->laundry_id,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
        ]);
    }

    public function deleteTimeSlot(Request $request)
    {
        DB::table("time_slots")
            ->where('id', $request->id)
            ->delete();
    }

    public function getTimeSlot(Request $request)
    {
        $time_slots = DB::table('time_slots')
            ->where('laundry_id', $request->id)
            ->get();

        return $time_slots;
    }

    public function createReservation(Request $request)
    {
        MobileReservations::create([
            'laundry_id' => $request->laundry_id,
            'user_id' => $request->user_id,
            'machine_id' => $request->machine_id,
            'reservation_date' => $request->reservation_date,
            'time_start' => $request->time_start,
            'time_end' => $request->time_end,
            'status' => $request->status,
        ]);
    }

    public function getAllReservation(Request $request)
    {
        return DB::table('mobile_reservations')
            ->where('laundry_id', $request->laundry_id)
            ->get();
    }
}
