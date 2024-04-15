<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserStatus
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
        if ($request->user() && $request->user()->status != 1) {
            auth()->logout();
            if($request->ajax())
            {
                return  response()->json(["alert-type" => "error" , "message" => trans("messages.user_inactivated")],403);
            }
            return redirect()->route("home")->with(["alert-type" => "error" , "message" => trans("messages.user_inactivated")]);
        }
        return $next($request);
    }
}
