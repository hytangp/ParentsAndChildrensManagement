<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureProfileIsComplete
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && !Auth::user()->profile_completed) {

            if ($request->routeIs('logout')) {
                return $next($request);
            }

            if (!$request->routeIs('profile.complete', 'profile.store')) {
                return redirect()->route('profile.complete');
            }
        }

        return $next($request);
    }
}