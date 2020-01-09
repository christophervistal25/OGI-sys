<?php

namespace App\Http\Middleware\Instructor;

use App\GradeEvaluation;
use Closure;

class InstructorGradeEvaluation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $evaluation = 
        return $next($request);
    }
}
