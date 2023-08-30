<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventDuplicateSubmissions
{
    /**
     * Handle an incoming request.
     *
    */

    public function handle(Request $request, Closure $next)
    {
        $cookieName = 'last_submission_time';
        $allowedInterval = 24 * 60; // 24 hours in minutes

        if ($request->hasCookie($cookieName)) {
            // User has submitted recently, prevent the submission
            return response()->json(['error_time_out' => 'You have already submitted within the past 24 hours.'], 400);
        }

        // Set a cookie to record the submission time
        return $next($request)->cookie($cookieName, time(), $allowedInterval);
    }
    
}
