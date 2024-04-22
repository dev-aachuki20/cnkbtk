<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $roleId = $user->role_id;
            if ($roleId == 1 || $roleId == 2) {
                return $next($request);
            } else {
                return redirect()->route("home")->with(["alert-type" => "error", "message" => trans("messages.access_denied")]);
            }
        }
        return redirect()->route("home")->with(["alert-type" => "error", "message" => trans("messages.logged_in_route_access")]);
    }
}
