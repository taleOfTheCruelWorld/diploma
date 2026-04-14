<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRightToGetToTheCRUD
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::user()) {
            return to_route('login');
        }
        if (Auth::user()->userRole->name != 'content-manager' && Auth::user()->userRole->name != 'universal') {
            return redirect('/');
        }
        return $next($request);
    }
}
