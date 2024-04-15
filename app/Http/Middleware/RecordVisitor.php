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
        $result = UniqueVisitor::where(["date" => date("Y-m-d"), "ip_address" => $request->ip()])->first();
        if(empty($result)){
            UniqueVisitor::create([
                'ip_address' => $request->ip(),
                'date' => date("Y-m-d")
            ]);
        }
       
        return $next($request);
    }
}
