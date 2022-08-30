<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ManageStatistics extends Controller
{
    public function index()
    {
        $laundry_id = DB::table('laundries')
            ->where('user_id', Auth::guard('web')->user()->id)
            ->first();
        //get reservation counts
        $date = Carbon::now()->format('m-d-Y');
        $reservation_today = DB::table('mobile_reservations')
            ->where('laundry_id', $laundry_id->id)
            ->where('status', "Success")
            ->where('reservation_date', Carbon::now()->format('m-d-Y'))
            ->count();
        $machine_cycles = DB::table('machines')
            ->join('machine_occupancies', 'machines.id', '=', 'machine_occupancies.machine_id')
            ->where('machines.laundry_id', $laundry_id->id)
            ->whereDate('machine_occupancies.created_at', Carbon::today())
            ->count();


        //get total sales
        $orders = DB::table('orders')
            ->join('order_infos', 'orders.id', '=', 'order_infos.order_id')
            ->where('orders.laundry_id', $laundry_id->id)
            ->where('order_infos.payment_status', "Paid")
            ->where('order_infos.status', "Completed")
            ->whereDate("orders.created_at", Carbon::today())
            ->get();
        $total_sales = 0;
        foreach($orders as $order) {
            $total_sales += (int) $order->total_price;
        }

        //orders count
        $orders_count = DB::table('orders')
            ->where('laundry_id', $laundry_id->id)
            ->whereDate('created_at', Carbon::today())
            ->count();
        
        //get total mobile profits
        $mobile_orders = DB::table('mobile_orders')
            ->join('mobile_orders_infos', 'mobile_orders_infos.mobile_order_id', '=', 'mobile_orders.id')
            ->where('mobile_orders_infos.payment_status', "Paid")
            ->whereDate('mobile_orders.created_at', Carbon::today())
            ->get();
        $total_mobile = 0;
        foreach($mobile_orders as $mobile_order) {
            $total_mobile += (int) $mobile_order->total_price;
        }

        //get Three recent orders
        $recent_orders = DB::table('orders')
            ->join('order_infos', 'order_infos.order_id', '=', 'orders.id')
            ->where('orders.laundry_id', $laundry_id->id)
            ->orderBy('orders.created_at', 'desc')
            ->paginate(3);

        //TOTAL PROFIT
        $total_profit = $total_sales + $total_mobile;

        //get weekly mobile earnings
        $weekly_mobile = DB::table('mobile_orders')
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get();
        $total_mobile_weekly = 0;
        foreach($weekly_mobile as $weekly) {
            $total_mobile_weekly += (int) $weekly->total_price;
        }

        //get weekly store earnings
        $weekly_store = DB::table('orders')
            ->whereBetween("created_at", [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get();
        $total_store_weekly = 0;
        foreach($weekly_store as $weekly) {
            $total_store_weekly += (int) $weekly->total_price;
        }

        //get monthly mobile earnings
        $monthly_mobile = DB::table('mobile_orders')
            ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->get();
        $total_mobile_monthly = 0;
        foreach($monthly_mobile as $monthly) {
            $total_mobile_monthly += $monthly->total_price;
        }

        //get montly store earnings
        $monthly_store = DB::table('orders')
            ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->get();
        $total_store_monthly = 0;
        foreach ($monthly_store as $monthly) {
            $total_store_monthly += $monthly->total_price;
        }

        //get yearly mobile earnings
        $yearly_mobile = DB::table('mobile_orders')
            ->whereYear('created_at', date('Y'))
            ->get();
        $total_mobile_yearly = 0;
        foreach($yearly_mobile as $yearly) {
            $total_mobile_yearly += $yearly->total_price;
        }

        //get yearly store earnings
        $yearly_store = DB::table('orders')
            ->whereYear('created_at', date('Y'))
            ->get();
        $total_store_yearly = 0;
        foreach($yearly_store as $yearly) {
            $total_store_yearly += $yearly->total_price;
        }

        //weekly orders for line graph
        $weekly_orders = DB::table('orders')
            ->select(DB::raw("(COUNT(*)) as count"), DB::raw("DAYNAME(created_at) as dayname"))
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->whereYear('created_at', date('Y'))
            ->groupBy('dayname')
            ->orderBy('created_at', 'asc')
            ->get();
        
        //monthly orders for line graph
        $monthly_orders = DB::table('orders')
            ->select(DB::raw("(COUNT(*)) as count"), DB::raw("MONTHNAME(created_at) as monthname"))
            ->whereYear('created_at', date("Y"))
            ->groupBy('monthname')
            ->get();

        return view('features.Client.Statistics.managestatistics', [
            'machine_cycles' => $machine_cycles,
            'total_profit' => $total_profit,
            'orders_count' => $orders_count,
            'recent_orders' => $recent_orders,
            'total_mobile_weekly' => $total_mobile_weekly,
            'total_store_weekly' => $total_store_weekly,
            'total_mobile_monthly' => $total_mobile_monthly,
            'total_store_monthly' => $total_store_monthly,
            'total_mobile_yearly' => $total_mobile_yearly,
            'total_store_yearly' => $total_store_yearly,
            'weekly_orders' => $weekly_orders,
            'monthly_orders' => $monthly_orders,
        ]);
    }
}
