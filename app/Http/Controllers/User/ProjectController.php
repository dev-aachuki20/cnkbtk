<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\TagType;
use App\Models\User;
use App\Models\ProjectCreators;
class ProjectController extends Controller
{
    public function index()
  
    {   
        $tagTypes = TagType::all(); 
        $creators = User::where('role_id', 2)->get();
        return view("user.project", compact('tagTypes','creators')); 
    }

    public function store(Request $request)
     {
        try{
            $userId = auth()->user()->id;
            $userIp = $request->ip();
            $validatedData = $request->validate([
                'type' => 'required|string',
                'tags' => 'required',
                'creator_id' => 'required',
                'budget' => 'nullable|numeric',
                'comment' => 'nullable|string',
        ]);
    
        
            $project = new Project();
            $project->type = $validatedData['type'];
            $project->tags = $validatedData['tags'];
            $project->user_id = $userId;
            $project->user_ip = $userIp;
            $project->creator_id = $validatedData['creator_id'];
            $project->budget = $validatedData['budget'];
            $project->comment = $validatedData['comment'];
            $project->copyright = $request->has('copyright') ? 1 : 0;
            $project->save();
    
            $projectCreators = new ProjectCreators();
            $projectCreators->project_id = $project->id; 
            $projectCreators->creator_id = $validatedData['creator_id'];
            $projectCreators->save();
    
             return response()->json(['message' => 'Project created successfully'], 200);
            } catch (\Exception $e) {
                
                return response()->json(['error' => $e->getMessage()], 500);
            }
    }
}
