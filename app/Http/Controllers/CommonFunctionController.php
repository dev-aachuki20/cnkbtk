<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Tag;


class CommonFunctionController extends Controller
{   
  
    public function getSubSections($id){
        $userRole  = auth()->user()->role_id;
        \DB::enableQueryLog();
        $datas = Section::where(["parent_id" => $id, 'level' => config("constant.sectionLevel.level2") , 'status' => 1]);
        if($userRole != config("constant.role.admin") ) {
            if($userRole == config("constant.role.user")){
                $datas = $datas->where("user_can_post",'1');
            }else{
                $datas = $datas->where("creator_can_post",'1');
            }
        }
        $datas = $datas->get();
      
       
        if($datas->count() == 0){
            return  response()->json(["message" => "Sub section not available for the selected parent section"],404);
        }
        $view = view("admin.render.common.subparent_section",compact("datas"))->render();
        
        return response()->json(["message" => $view],200);

    }

    // public function getChildSections($id){
    //     $userRole  = auth()->user()->role_id;
    //     \DB::enableQueryLog();
    //     $datas = Section::where(["parent_id" => $id, 'level' => config("constant.sectionLevel.level3") , 'status' => 1]);
    //     if($userRole != config("constant.role.admin") ) {
    //         if($userRole == config("constant.role.user")){
    //             $datas  = $datas->where("user_can_post",'1');
    //         }else{
    //             $datas =  $datas->where("creator_can_post",'1');
    //         }
    //     }

    //     $datas = $datas->get();
    //     if($datas->count() == 0){
    //         return  response()->json(["message" => "Child secton  not available for the selected sub  section"],404);
    //     }
    //     $view = view("admin.render.common.subparent_section",compact("datas"))->render();
    //     return response()->json(["message" => $view],200);

    // }

    public function getTags($id){
        $datas = Tag::where("tag_type", $id)->get();
       
        if($datas->count() == 0){
            return  response()->json(["message" => "Tags not available for selected tag type"],404);
        }
        $view = view("admin.render.common.subparent_section",compact("datas"))->render();
        
        return response()->json(["message" => $view],200);
    }
    
    public function updateLanguage($language){

        
        $locale = $language;
        if($language == "en" || $language == "zh"){
            app()->setLocale($locale);
            session()->put('locale', $locale);
            session()->save();
            return back()->with(["alert-type" => "success","message",trans('global.language_change_error')]);
        }
        return back()->with(["alert-type" => "error","message" => trans('global.language_change_success')]);

        // if (isset($locale) && in_array($locale, config('constant.language'))) {
        //    
        //    
        //     return  back()->with(["alert-type" => "success","message" => ""]);
        // }
        // return back()->with(["alert-type" => "error","message" => "{{trans('global.language_change_success}}"]);
    }


    
}
