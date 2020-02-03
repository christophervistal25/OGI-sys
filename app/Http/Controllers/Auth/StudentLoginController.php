<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\StudentViewGrade;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StudentLoginController extends Controller
{
  // use AuthenticatesUsers;
  
	public function __construct()
	{
		// $this->middleware('guest:student');
    $this->middleware('guest:student')->except('logout');
	}

	public function login()
	{
      // session()->put('url.intended',url()->previous());
      Session::forget('url.intented');
  		return view('student.auth.login');
	}

    public function loginStudent(Request $request)
    {
      if (StudentViewGrade::isStudentCanLogin()) {
          $credentials = $request->only('id_number', 'password');
            // Attempt to log the user in
            if (Auth::guard('student')->attempt($credentials, $request->remember)) {
              // if successful, then redirect to their intended location
              return redirect()->intended(route('student.dashboard'));
            } 
            return back()->withInput($request->only('id_number', 'remember'))
                          ->withErrors(['message' => 'Please check your ID number or password.']);
      } else {
        return back()->withInput($request->only('id_number', 'remember'))
                          ->withErrors(['message' => 'Please contact the administrator to set a schedule for viewing grades.']);
      }
      
    }

    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        return redirect()->route('student.auth.login');
    }
}
