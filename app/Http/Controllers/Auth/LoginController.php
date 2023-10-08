<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $maxAttempts = 3; // Default is 5
    protected $decayMinutes = 5; // Default is 1
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function username()
    {
        return 'username';
    }
    public function credentials (\Illuminate\Http\Request $request)
    {
        // $clientIP = request()->ip();
        // $device = $request->header('User-Agent');
        // Log::channel('loginlogout')->info("$clientIP - $request->username LOGIN - $device");
        return [
            'username' => $request->username,
            'password' => $request->password,
            'is_enabled'=> true,
        ];
    }
}
