<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InstructorLoginController extends Controller
{
    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';
    public function __construct()
    {
        // $this->middleware('guest:instructor');
        $this->middleware('guest:instructor')->except('logout');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        // session()->put('url.intended',url()->previous());
        Session::forget('url.intented');

        return view('instructor.auth.login');
    }

    public function loginInstructor(Request $request)
    {
        $credentials = $request->only('id_number', 'password');

        // Attempt to log the user in
        if (Auth::guard('instructor')->attempt($credentials, $request->remember)) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('instructor.dashboard'));
        }

        return back()->withInput($request->only('id_number', 'remember'))
                    ->withErrors(['message' => 'Please check your ID number or password.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('instructor')->logout();

        return redirect()->route('instructor.auth.login');
    }
}
