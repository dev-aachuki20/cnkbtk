<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UniqueVisitor;

class RecordVisitor
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
        $userAgent = $request->header('User-Agent');
        $deviceName = null;

        $deviceName = strpos($userAgent, 'Mobile') !== false ? 'Mobile Device' : 'Desktop Device';

        $result = UniqueVisitor::where(["date" => date("Y-m-d"), "ip_address" => $request->ip()])->first();
        if (empty($result)) {
            UniqueVisitor::create([
                'ip_address' => $request->ip(),
                'date' => date("Y-m-d"),
                'device_name' => $deviceName,
            ]);
        }

        return $next($request);
    }
}
