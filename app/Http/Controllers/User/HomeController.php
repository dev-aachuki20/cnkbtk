<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Points;
use App\Models\User;

class HomeController extends Controller
{
    public function index(){
        $transectionHistory = Points::with(["plan"])->where(["user_id" => auth()->user()->id, "type" => config("constant.point_type.general") ])->paginate(1);
        $user = User::with(['userPoint' => function ($query) {
            $query->orderBy('id', 'desc')->first();
        }])->where("id",auth()->user()->id)->first();
        return view("user.profile",compact("transectionHistory","user"));
    } 
}
