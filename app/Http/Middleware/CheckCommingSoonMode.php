<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;
use Illuminate\Http\Request;

class CheckCommingSoonMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $setting = Setting::first();

        if ($setting->comingsoon_mode) {

            if (request()->routeIs('admin*') || request()->routeIs('login.admin') || request()->routeIs('settings.*')) {

                return $next($request);
            } else {

                return response()->view('errors.commingsoon');
            }
        }

        return $next($request);
    }
}
