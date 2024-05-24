<?php

namespace App\Http\Middleware;

use App\Models\BlacklistUser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckIfBlacklisted
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
        if (Auth::check()) {
            $user = Auth::user();
           $blacklist = BlacklistUser::where('email', $user->email)->first();
            if ($blacklist) {
                Auth::logout();
                return redirect()->route('login')->with(["alert-type" => "error", "message" => trans("messages.access_denied")]);
            }
        }

        return $next($request);
    }
}
