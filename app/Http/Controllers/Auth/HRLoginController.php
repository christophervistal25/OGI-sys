<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HRLoginController extends Controller
{
    // use AuthenticatesUsers;
    
    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    // protected $redirectTo = '/instructor';

       public function __construct()
       {
           $this->middleware('guest:hr')->except('logout');
       }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        Session::forget('url.intented');
        // session()->put('url.intended',url()->previous());
        return view('hr.auth.login');
    }

    public function loginHR(Request $request)
    {
      $credentials = $request->only('id_number', 'password');

      // Attempt to log the user in
      if (Auth::guard('hr')->attempt($credentials, $request->remember)) {

        // if successful, then redirect to their intended location
        return redirect()->intended(route('hr.dashboard'));
      }

      return back()->withInput($request->only('id_number', 'remember'))
                    ->withErrors(['message' => 'Please check your ID number or password.']);
    }
    
    public function logout(Request $request)
    {
        Auth::guard('hr')->logout();
        return redirect()->route('hr.auth.login');
    }
}
