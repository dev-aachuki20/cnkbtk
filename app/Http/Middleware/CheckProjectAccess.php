<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckProjectAccess
{
    // public function handle(Request $request, Closure $next)
    // {
    //     if (auth()->check()) {
    //         $user = auth()->user();
    //         $roleId = $user->role_id;

    //         // if ($roleId == 3) {
    //         //     if ($request->is('user/project/create')) {
    //         //         return $next($request);
    //         //     } else {
    //         //         return redirect()->route("home")->with(["alert-type" => "error", "message" => trans("messages.access_denied")]);
    //         //     }
    //         // }

    //         if ($roleId == 1 || $roleId == 2) {
    //             return redirect()->route("home")->with(["alert-type" => "error", "message" => trans("messages.access_denied")]);
    //         }

    //         return $next($request);
    //     }

    //     return redirect()->route("home")->with(["alert-type" => "error", "message" => trans("messages.logged_in_route_access")]);
    // }

    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $roleId = $user->role_id;

            if ($roleId == 3) {
                return $next($request);
            } else {
                return redirect()->route("home")->with(["alert-type" => "error", "message" => trans("messages.access_denied")]);
            }
        }

        return redirect()->route("home")->with(["alert-type" => "error", "message" => trans("messages.logged_in_route_access")]);
    }
}
