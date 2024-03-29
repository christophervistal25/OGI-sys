<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        // To avoid visiting the login section of other user if already logged in
        if (Auth::guard('student')->check()) {
            return redirect()->intended(route('student.dashboard'));
        } elseif (Auth::guard('admin')->check()) {
            return redirect()->intended(route('admin.dashboard'));
        } elseif (Auth::guard('instructor')->check()) {
            return redirect()->intended(route('instructor.dashboard'));
        }

        switch ($guard) {
          case 'admin':
            if (Auth::guard($guard)->check()) {
                return redirect()->route('admin.dashboard');
            }
            break;
         case 'student' :
          if (Auth::guard($guard)->check()) {
              return redirect()->route('student.dashboard');
          }
          break;
          case 'instructor' :
          if (Auth::guard($guard)->check()) {
              return redirect()->route('instructor.dashboard');
          }
          break;
          case 'hr' :
          if (Auth::guard($guard)->check()) {
              return redirect()->route('hr.dashboard');
          }
          break;
          default:
            if (Auth::guard($guard)->check()) {
                return redirect('/home');
            }
            break;
        }
        Session::forget('url.intented');

        return $next($request);
    }
}
