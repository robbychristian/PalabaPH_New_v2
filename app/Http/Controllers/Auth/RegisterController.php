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
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use PDF;

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
            'pwd' => 'required|min:8|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x]).*$/',
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
            'bir' => ['mimes:pdf', 'required'],
            'business' => ['mimes:pdf', 'required'],
            'dti' => ['mimes:pdf', 'required'],
            'valid_id' => ['mimes:pdf', 'required'],
            'laundry_img' => ['required'],
        ], $messages = [
            'fname.required' => 'The first name field is required!',
            'mname.required' => 'The middle name field is required!',
            'lname.required' => 'The last name field is required!',
            'bday.required' => 'The birthday field is required!',
            'cnum.required' => 'The contact number field is required!',
            'pnum.required' => 'The phone number field is required!',
            'email.required' => 'The email field is required!',
            'pwd.required' => 'The password field is required!',
            'pwd.regex' => "The password should contain atleast a numeric character",
            'confpw.required' => 'The confirm password field is required!',
            'region.required' => 'The region field is required!',
            'province.required' => 'The province field is required!',
            'city.required' => 'The city field is required!',
            'barangay.required' => 'The barangay field is required!',
            'houseNo.required' => 'The street field is required!',
            'laundryName.required' => 'The laundry name field is required!',
            'typeLaundry.required' => 'The laundry type field is required!',
            'description.required' => 'The laundry description field is required!',
            'openingtime.required' => 'The opening time field is required!',
            'closingtime.required' => 'The closing time field is required!',

            'bir.required' => 'The BIR file field is required!',
            'business.required' => 'The Business file field is required!',
            'dti.required' => 'The DTI file field is required!',
            'valid_id.required' => 'The valid ID file field is required!',
            'laundry_img.required' => 'The Laundry Image file field is required!',

            'bir.mimes' => 'The BIR file needs to be in PDF format!',
            'business.mimes' => 'The Business file needs to be in PDF format!',
            'dti.mimes' => 'The DTI file needs to be in PDF format!',
            'valid_id.mimes' => 'The valid ID file needs to be in PDF format!',
            'laundry_img.mimes' => 'The laundry image file needs to be in .jpg, .jpeg, .png format only!',
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
            'is_blocked' => 0
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
            request()->file('laundry_img')->storeAs('laundry_img_pics', $client->id . '/' . $file, 'public');
            $laundryInfo->update(['laundry_img' => $file]);
        }
        if (request()->hasFile('bir')) {
            $file = request()->file('bir')->getClientOriginalName();
            request()->file('bir')->storeAs('bir_pics', $client->id . '/' . $file, 'public');
            $laundry->update(['bir_permit' => $file]);
        }
        if (request()->hasFile('dti')) {
            $file = request()->file('dti')->getClientOriginalName();
            request()->file('dti')->storeAs('dti_pics', $client->id . '/' . $file, 'public');
            $laundry->update(['dti_permit' => $file]);
        }
        if (request()->hasFile('business')) {
            $file = request()->file('business')->getClientOriginalName();
            request()->file('business')->storeAs('business_pics', $client->id . '/' . $file, 'public');
            $laundry->update(['business_permit' => $file]);
        }
        if (request()->hasFile('valid_id')) {
            $file = request()->file('valid_id')->getClientOriginalName();
            request()->file('valid_id')->storeAs('valid_id_pics', $client->id . '/' . $file, 'public');
            $laundry->update(['valid_id' => $file]);
            $laundry->update(['address_id' => $laundryAddress->id]);
        }

        $pdf = PDF::loadView('pdf.contract');
        return $pdf->download('contract.pdf');
    }
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        return redirect('/login')->with('success', 'Nice');
    }
}
