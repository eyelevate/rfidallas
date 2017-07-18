<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;
use Illuminate\Support\Facades\Auth;
use Session;
use Route;
use URL;

class Authenticate
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
        if (!Auth::check()) { // Is the user logged in?
            // Set intended page
            session()->put('intended_url',$request->url());
            flash('You must be logged in to view the page')->warning();
            return redirect()->route('login');
        }

        // Is the user a guest? Kick em out if they are
        if (Auth::guard()->guest()) {
            
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                flash('You must be logged into view this page. Please try logging in.')->warning()->important();
                return redirect()->route('home');
            }
        }

        // Otherwise show as usual
        return $next($request);
    }
}
