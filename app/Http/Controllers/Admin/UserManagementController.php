<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\UserVerification;

class UserManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $customers = DB::table('mobile_users')
            ->where('user_role', '3')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('features.usermanagement', [
            'customers' => $customers
        ]);
    }

    public function blockCustomer(Request $request)
    {
        DB::table('mobile_users')
            ->where('id', $request->id)
            ->update([
                'is_blocked' => 1
            ]);
    }

    public function unblockCustomer(Request $request)
    {
        DB::table('mobile_users')
            ->where('id', $request->id)
            ->update([
                'is_blocked' => 0
            ]);
    }

    public function deleteCustomer(Request $request)
    {
        DB::table('mobile_users')
            ->where('id', $request->id)
            ->delete();
    }
}
