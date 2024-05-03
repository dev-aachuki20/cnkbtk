<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckProjectAccess
{
    // project module access
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $roleId = $user->role_id;

            if ($roleId ==  config("constant.role.user")) {
                return $next($request);
            } else {
                return redirect()->route("home")->with(["alert-type" => "error", "message" => trans("messages.access_denied")]);
            }
        }

        return redirect()->route("home")->with(["alert-type" => "error", "message" => trans("messages.logged_in_route_access")]);
    }
}
