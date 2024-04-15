<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Points;
use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class PointsController extends Controller
{
    public function selftopup(){
        $current_timestamp = Carbon::now()->timestamp;
        $orderId = "OR-".auth()->user()->id.$current_timestamp;
        $plan = Plan::orderBy("id","desc")->first();
        return view("self-topup",compact("current_timestamp","orderId","plan"));
    }

    public function paymenttopup(Request $request){

        try {
            $planid = Crypt::decrypt($request->plan_id);
            $plan = Plan::where("id",$planid)->first();
            if(!$plan){
                return  response()->json(['message' => trans("messages.invalid_request"), 'alert-type' => 'error'],500);
            }
            $input = array();
            $input["plan_id"] =  $planid;
            $input["user_id"] = auth()->user()->id;
            $input["credit"] = $plan->points;
            $input["amount"] = $plan->amount;
            $input["status"] = 1;
            $input["payment_id"] = NULL;
            $input["available_general_point"] = $plan->points;
            $lastPointRow = Points::where(["user_id" => auth()->user()->id, "type" => config("constant.point_type.general")])->orderBy("id","desc")->first();
            if($lastPointRow){
                $avlGenPoint = $lastPointRow->available_general_point;
                $input["available_general_point"] = $avlGenPoint + $plan->points;
            }
            $input["type"] =  config("constant.point_type.general");
            $create = Points::create($input);

            return  response()->json(['message' => trans("messages.add_success",['module' => trans("cruds.point.title_singular")]),'alert-type' =>  'success'],200);
        } catch (\Throwable $th) {
            return  response()->json(['message' => trans("messages.something_went_wrong")],500);
        }
    }
}
