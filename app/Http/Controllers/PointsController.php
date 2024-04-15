<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Points;
use App\Models\Plan;
use Carbon\Carbon;

class PointsController extends Controller
{
    public function selftopup(){
        $current_timestamp = Carbon::now()->timestamp;
        $orderId = "OR-".auth()->user()->id.$current_timestamp;
        $plan = Plan::orderBy("id","desc")->first();
        return view("self-topup",compact("current_timestamp","orderId","plan"));
    }

    
}
