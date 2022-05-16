<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Laundries;
use App\Models\LaundryAddress;
use App\Models\LaundryInfo;
use App\Models\Services;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => ['required', 'string', 'max:255'],
            'mname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'bday' => ['required', 'string', 'max:255'],
            'cnum' => ['required', 'string', 'max:255'],
            'pnum' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'pwd' => 'required|min:8',
            'confpw' => 'required|min:8|same:pwd',
            'region' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'barangay' => ['required', 'string', 'max:255'],
            'houseNo' => ['required', 'string', 'max:255'],
            'laundryName' => ['required', 'string', 'max:255'],
            'typeLaundry' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'openingtime' => ['required'],
            'closingtime' => ['required'],
            'bir' => 'mimes:jpeg,png,jpg',
            'business' => 'mimes:jpeg,png,jpg',
            'dti' => 'mimes:jpeg,png,jpg',
            'valid_id' => 'mimes:jpeg,png,jpg',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $client = User::create([
            'first_name' => $data['fname'],
            'middle_name' => $data['mname'],
            'last_name' => $data['lname'],
            'birth_day' => $data['bday'],
            'user_role' => 2,
            'email' => $data['email'],
            'password' => Hash::make($data['pwd']),
        ]);

        $laundry = Laundries::create([
            'user_id' => $client->id,
            'address_id' => null,
            'name' => $data['laundryName'],
            'landline' => $data['pnum'],
            'type_of_laundry' => $data['typeLaundry'],
            'phone' => $data['cnum'],
            'valid_id' => null,
            'bir_permit' => null,
            'dti_permit' => null,
            'brgy_permit' => null,
            'is_approved' => false,
        ]);

        $laundryAddress = LaundryAddress::create([
            'laundry_id' => $laundry->id,
            'street' => $data['houseNo'],
            'state' => $data['province'],
            'barangay' => $data['barangay'],
            'city' => $data['city'],
            'region' => $data['region'],
        ]);

        $laundryInfo = LaundryInfo::create([
            'laundry_id' => $laundry->id,
            'description' => $data['description'],
            'opening_time' => Carbon::parse('2018-06-15' . $data['openingtime'], 'UTC'),
            'closing_time' => Carbon::parse('2018-06-15' . $data['closingtime'], 'UTC'),
            'laundry_img' => null,
        ]);

        $services = Services::create([
            'laundry_id' => $laundry->id,
            'self_service' => false,
            'full_service' => false,
            'pick_up' => false,
            'reservations' => false,
            'cash' => false,
            'cashless' => false,
            'gcash_qr_code' => null,
            'gcash_qr_code' => false,
            'is_published' => false,
        ]);

        if (request()->hasFile('laundry_img')) {
            $file = request()->file('laundry_img')->getClientOriginalName();
            request()->file('laundry_img')->storeAs('laundry_img_pics', $client->id . '/' . $file, '');
            $laundryInfo->update(['laundry_img' => $file]);
        }
        if (request()->hasFile('bir')) {
            $file = request()->file('bir')->getClientOriginalName();
            request()->file('bir')->storeAs('bir_pics', $client->id . '/' . $file, '');
            $laundry->update(['bir_permit' => $file]);
        }
        if (request()->hasFile('dti')) {
            $file = request()->file('dti')->getClientOriginalName();
            request()->file('dti')->storeAs('dti_pics', $client->id . '/' . $file, '');
            $laundry->update(['dti_permit' => $file]);
        }
        if (request()->hasFile('business')) {
            $file = request()->file('business')->getClientOriginalName();
            request()->file('business')->storeAs('business_pics', $client->id . '/' . $file, '');
            $laundry->update(['business_permit' => $file]);
        }
        if (request()->hasFile('valid_id')) {
            $file = request()->file('valid_id')->getClientOriginalName();
            request()->file('valid_id')->storeAs('valid_id_pics', $client->id . '/' . $file, '');
            $laundry->update(['valid_id' => $file]);
            $laundry->update(['address_id' => $laundryAddress->id]);
        }


        return $client;
    }
}
