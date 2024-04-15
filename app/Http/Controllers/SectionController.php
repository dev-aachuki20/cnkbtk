<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Poster;
class SectionController extends Controller
{
    
    public function index(Request $request){
        $slug = $request->slug;
        $level = $request->level;

        $section  = Section::where("slug",$slug)->exists();
        if(!$section){
            return abort(404);
        }

        switch ($level) {
            case 1:
            $section = Section::with(['parentSectionPosters'])->where("slug",$slug)->first();
            $posters = Poster::with("userDetails")->withCount("reads")->where(["parent_section" => $section->id,"status" => "1"])->paginate(3);
                break;
            case 2:
            $section = Section::with(['subSectionPosters','parent_category.parent_category'])->where("slug",$slug)->first();
            $posters = Poster::with("userDetails")->withCount("reads")->where(["sub_section" => $section->id,"status" => "1"])->paginate(3);
                break;
            case 3:
            $section = Section::with(['childSectionPosters'])->where("slug",$slug)->first();
            $posters = Poster::with("userDetails")->withCount("reads")->where(["child_section" => $section->id,"status" => "1"])->paginate(3);
                break;
            default:
                return abort(404);
                break;
        }
        
        $mostViewed = $posters->sortByDesc("reads")->take(5);
        return view("section",compact("section","posters","mostViewed"));
    }

}
