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
    public function handle($request, Closure $next, $role)
    {

        if (!Auth::check()) { // Is the user logged in?
            // Check where the user came from, if from admins then redirect accordingly
            $redirect_path = ($request->is('admins') || $request->is('admins/*')) ? '/admins/login' : '/';
            // Set intended page
            Session::put('intended_url',$request->url());
            flash('You must be logged in to view the page')->error();
            return redirect($redirect_path);
        }

        // Is the user a guest? Kick em out if they are
        if (Auth::guard($guard)->guest()) {
            flash()->message('You are a not allowed to visit this page.')->warning();
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->route('home');
            }
        }

        // Check if user has a role_id that is less than 4 (employees or higher)
        if (Auth::user()->role_id > 3) {
            flash('You must be logged in to view the page')->error();
            return redirect()->route('pages_index');
        }

        // Otherwise show as usual
        return $next($request);
    }
}
