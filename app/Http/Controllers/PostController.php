<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;
use App\Models\Poster;
use App\Models\Follow;
use App\Models\PosterReadCount;
use App\Models\UserEpisode;
use App\Models\Points;
use Illuminate\Support\Facades\Crypt;


class PostController extends Controller
{
    public function index(Request $request)
    {
      try {
        $slug = $request->slug;
        $poster  = Poster::with(["parentSection" ,"subSection" ,"episodes.uploads","userDetails"])->withCount("reads")->where(["slug" => $slug, "status" => "1"])->first();
        if(empty($poster)){
            return redirect()->route("home")->with(["alert-type" => "info" , "message" => trans("messages.poster_not_found")]);
        }
        $is_follower = false;
        if(auth()->check()){
          $is_follower = Follow::where(["user_id" => auth()->user()->id, "poster_id" => $poster->id ])->exists();
        }

        $ip = $request->ip();
        $poster_id = $poster->id;
        $this->addCount($ip,$poster_id);
        if(auth()->check()){
          $purchasedEpisodes = UserEpisode::where(["poster_id" => $poster->id, "user_id" => auth()->user()->id])->get()->pluck("episode_id");
          return view("poster.index",compact("poster","is_follower","purchasedEpisodes"));
        }else{
          return view("poster.index",compact("poster","is_follower"));
        }

      } catch (\Throwable $th) {
        return abort(500);
      }
        
        
    }
    

    private function addCount($ip,$poster_id){
      $result = PosterReadCount::where(["date" => date("Y-m-d"), "ip_address" => $ip, "poster_id" => $poster_id])->first();
        if(empty($result)){
          PosterReadCount::create([
                'ip_address' => $ip,
                'date' => date("Y-m-d"),
                'poster_id' => $poster_id
            ]);
        }
    }


    public function follow(Request $request){

      try {
        $poster_id = Crypt::decrypt($request->posterId);
        $follwoStatus = Crypt::decrypt($request->follwoStatus);
        if($follwoStatus == 1){
          $store  = new Follow;
          $store->user_id = auth()->user()->id;
          $store->poster_id = $poster_id;
          $store->save();
          return  response()->json(['message' => trans("messages.follow_success"),'alert-type' =>  'success',"follow_status" => 0]);
        }else{
          $delete  = Follow::where(["user_id" => auth()->user()->id, "poster_id" => $poster_id ])->delete();
          return  response()->json(['message' => trans("messages.unfollow_success",['module' => trans("cruds.reports.title_singular")]),'alert-type' =>  'info',"follow_status" => 1]);
        }
      } catch (\Throwable $th) {
        //throw $th;

        return response()->json(['message' => trans("messages.something_went_wrong"),'alert-type' =>  'error'],500);
      }

    }

    public function createPurchase(Request $request)
    {  
        try {
          $id = Crypt::decrypt($request->episodeId);
          $episode = Episode::where("id",$id)->first();
          $view =  view('poster.purchase',compact("id","episode"))->render();
          return $view;
        } catch (\Throwable $th) {
          return response()->json(['message' => trans("messages.invalid_request"),'alert-type' =>  'error'],500);
        }
        
    }

    public function storePurchase(Request $request)
    { 
  
      try {
          $episodeId = Crypt::decrypt($request->episode_id);
          $episode = Episode::with("poster")->where("id",$episodeId)->first();
          if(empty($episode)){
            return response()->json(['message' => trans("messages.invalid_request"),'alert-type' =>  'error'],500);
          }

          if(!isset($episode->poster)){
            return response()->json(['message' => trans("messages.invalid_request"),'alert-type' =>  'error'],500);
          }

          if($episode->poster->user_id == auth()->user()->id){
            return response()->json(['message' => trans("messages.you_can_not_purchase_your_own_posters"),'alert-type' =>  'error'],403);
          }

          $posterId = $episode->poster->id;
          $creatorId = $episode->poster->user_id;
          $avlGenPoint = 0;
          $lastPointRow = Points::where(["user_id" => auth()->user()->id, "type" => config("constant.point_type.general")])->orderBy("id","desc")->first();
          if($lastPointRow){
            $avlGenPoint = $lastPointRow->available_general_point;
          }

          if($episode->cost > $avlGenPoint){
            return response()->json(['message' => trans("messages.insufficient_point"),'alert_type' =>  'info'],200);
          }

          \DB::beginTransaction();
          $inputEpisode = array();
          $inputEpisode["user_id"] = auth()->user()->id; 
          $inputEpisode["poster_id"] = isset($episode->poster) ? $episode->poster->id : "0";
          $inputEpisode["episode_id"] = $episode->id;
          $inputEpisode["points"] = $episode->cost;
          $inputEpisode["episode_title"] = $episode->title;
          $storeOrder = UserEpisode::create($inputEpisode);
          $remainingGenPoint = $avlGenPoint - $episode->cost; 
          $updateUserPoint = Points::create([
              "user_id" => auth()->user()->id,
              "debit" => $episode->cost,
              "post_id" => $posterId,
              "episode_id" => $episodeId,
              "available_general_point" => $remainingGenPoint,
              "type" => config("constant.point_type.general")
          ]);
          
          $creatorAvlGenPoint = 0;

          $lastPointRowCreator = Points::where(["user_id" => $creatorId, "type" => config("constant.point_type.general")])->orderBy("id","desc")->first();
          if($lastPointRowCreator){
            $creatorAvlGenPoint =  $episode->cost + $lastPointRowCreator->available_general_point;
          }else{
            $creatorAvlGenPoint = $episode->cost;
          }

          $updateCreatorPoint = Points::create([
            "user_id" => $creatorId,
            "credit" => $episode->cost,
            "post_id" => $posterId,
            "episode_id" => $episodeId,
            "available_general_point" => $creatorAvlGenPoint,
            "type" => config("constant.point_type.general")
          ]);

          \DB::commit();
          return  response()->json(['message' => trans("messages.purchase.success"),'alert-type' =>  'success'],200);

      } catch (\Throwable $th) {
        \DB::rollBack();
        return response()->json(['message' => trans("messages.something_went_wrong"),'alert-type' =>  'error'],500);
      }
    }
}
