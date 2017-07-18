<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;
use URL;
use Redirect;

class FrontendMiddleware
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
        if (!Auth::check()) {
            dd('you are not allowed to view this page');
            // Check where the user came from, if from admins then redirect accordingly
            // Set intended page
            Session::put('intended_url',$request->url());
            flash('You must be logged in to view the page')->error();
            return Redirect::action('HomeController@index');
        }
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('/');
            }
        }
        return $next($request);
    }
}
