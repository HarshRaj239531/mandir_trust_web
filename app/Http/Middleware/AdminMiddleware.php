<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'Please log in with your Mandir Administrator credentials.');
        }

        if (!Auth::user()->is_admin) {
            return redirect()->route('devotee.profile')->with('error', 'Unauthorized: You do not have Mandir Administrator access.');
        }

        return $next($request);
    }
}
