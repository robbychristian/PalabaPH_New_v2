<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required',
            'password' => 'required',
            'captcha' => 'required|captcha'
            // new rules here
        ], [
            'captcha.captcha' => "Re-enter Captcha!"
        ]);
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $exist = DB::table('users')->where('email', $request->email)->count();

        if(!$exist) {
            return redirect('/login')->with("error", 'Credentials does not exist!');
        }

        $valid = DB::table('users')->select('email_verified_at')->where('email', $request->email)->first();
        $is_blocked = DB::table('users')->select('is_blocked')->where('email', $request->email)->first();
        // dd($is_blocked->is_blocked);
        if ($valid->email_verified_at == '') {
            return redirect('/login')->with("email", "Your Email is not yet verified!");
        } else if ($is_blocked->is_blocked == true) {
            return redirect('/login')->with('blocked', 'Your email has been blocked');
        } else {
            if ($this->guard('web')->validate($this->credentials($request))) {
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                    return redirect('/home');
                } else {
                    $this->incrementLoginAttempts($request);
                    return response()->json([
                        'error' => 'This account is not activated.'
                    ], 401);
                }
            } else {
                // dd('ok');
                $this->incrementLoginAttempts($request);
                return redirect('/login')->with('error', 'test');
            }
        }
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }
}
