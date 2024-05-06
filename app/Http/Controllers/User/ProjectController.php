<?php

namespace App\Http\Controllers\User;

use App\DataTables\ProjectUserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Models\BlacklistUser;
use App\Models\Project;
use App\Models\TagType;
use App\Models\User;
use App\Notifications\BidUpdatedNotification;
use App\Notifications\ProjectCancelledNotification;
use App\Notifications\ProjectConfirmedNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Notifications\ProjectCreatedNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;

class ProjectController extends Controller
{
    public function index(ProjectUserDataTable $dataTable)
    {
        return $dataTable->render('project.index');
    }

    public function create()
    {
        $tagTypes = TagType::all();
        $creators = User::where('role_id', config("constant.role.creator"))->get();
        return view("project.create", compact('tagTypes', 'creators'));
    }

    public function store(StoreProjectRequest $request)
    {
        try {
            if (BlacklistUser::where('email', auth()->user()->email)->exists()) {
                return response()->json(['message' => trans("messages.project_request_failed"), 'alert-type' => 'error'], 403);
            }
            DB::beginTransaction();
            $validatedData = $request->all();
            $validatedData['user_id'] = auth()->user()->id;
            $validatedData['user_ip'] = $request->ip();
            $validatedData['copyright'] = $request->has('copyright') ? 1 : 0;

            $project = Project::create($validatedData);

            if ($request->has('creator_id')) {
                $project->creators()->attach($request->input('creator_id'));
            }

            $creatorIds = $request->input('creator_id');

            if ($creatorIds) {
                foreach ($creatorIds as $creatorId) {
                    $creator = User::find($creatorId);
                    Notification::send($creator, new ProjectCreatedNotification($project, $creator));
                }
            } else {
                $creator = User::where('role_id', config("constant.role.creator"))->get();
                if ($creator) {
                    foreach ($creator as $creatorId) {
                        $creator = User::find($creatorId->id);
                        Notification::send($creator, new ProjectCreatedNotification($project, $creator));
                    }
                }
            }

            DB::commit();
            $routeUrl = URL::route('user.project.create');
            return response()->json(['reloadUrl' => $routeUrl, 'message' => trans("messages.add_success", ['module' => trans("global.project")]), 'alert-type' =>  'success'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage(), 'alert-type' => 'error'], 500);
        }
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view("project.show", compact('project'));
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy(Request $request, Project $project)
    {
        if ($request->ajax()) {
            try {
                $project = Project::findOrFail($project->id);
                $project->creators()->detach();
                $project->delete();
                return response()->json(['message' => trans("messages.delete_success", ['module' => trans("global.project")]), 'alert-type' =>  'success'], 200);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => trans("messages.delete_error", ['module' => trans("cruds.global.project")]),
                ]);
            }
        }
    }

    public function getProjectDetail($creator_id, $project_id)
    {
        $creator = User::findorFail($creator_id);
        if (Auth::check() && Auth()->user()->id != $creator_id) {
            return redirect()->route('login')->with(['message' => trans("messages.logged_in_route_access"), 'alert-type' =>  'success']);
        } else {
            $requestProject = Project::findorFail($project_id);
            $status =  DB::table('project_creator')->where('project_id', $project_id)->where('creator_id', $creator_id)->value('status');
            return view('project.creator-show', compact('creator', 'requestProject', 'status'));
        }
    }

    public function getAllProjectRequest()
    {
        $user =  Auth::user();
        // $allRequestProjects = $user->projects;
        $allRequestProjects = $user->projects->map(function ($project) use ($user) {
            $status = DB::table('project_creator')
                ->where('project_id', $project->id)
                ->where('creator_id', $user->id)
                ->value('status');

            return [
                'project' => $project, 'status' => $status,
            ];
        });

        // dd($allRequestProjects);
        return view('project.creator-projectlist-show', compact('allRequestProjects'));
    }

    // add project bid
    public function addBidByCreator(Request $request)
    {
        try {
            DB::beginTransaction();
            $validatedData = $request->validate([
                'bid' => ['required', 'numeric'],
            ]);

            $creator = User::find($request->auth_id);
            if (!$creator) {
                throw ValidationException::withMessages(['message' => 'Creator not found.']);
            }

            $projectCreator = DB::table('project_creator')->where('project_id', $request->project_id)->where('creator_id', $request->auth_id)->first();
            if (!$projectCreator) {
                throw ValidationException::withMessages(['message' => 'Project creator relationship not found.']);
            }
            DB::table('project_creator')->where('project_id', $request->project_id)->where('creator_id', $request->auth_id)->update(['bid' => $validatedData['bid'], 'status' => 2]);

            $user = User::find($request->user_id);
            $user->notify(new BidUpdatedNotification($creator, $validatedData['bid']));

            DB::commit();
            return response()->json(['message' => trans("messages.add_success", ['module' => trans("global.bid")]), 'alert-type' =>  'success'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['message' => $e->getMessage(), 'alert-type' => 'error'], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => trans("messages.something_went_wrong"), 'alert-type' => 'error'], 500);
        }
    }

    // confirm project 
    public function confirmProject(Request $request)
    {
        if ($request->creatorId != Auth::id()) {
            return response()->json(['message' => 'You are not authorized to confirm this project.'], 403);
        }
        $project = Project::findOrFail($request->projectId);

        DB::table('project_creator')->where('project_id', $request->projectId)->where('creator_id', $request->creatorId)->update(['status' => 1]);
        $creator = User::findOrFail($request->creatorId);
        $user = User::findOrFail($request->userId);
        $user->notify(new ProjectConfirmedNotification($project, $creator));
        return response()->json(['message' => 'Project confirmed successfully.']);
    }

    // cancel project
    public function cancelProject(Request $request)
    {
        if ($request->creatorId != Auth::id()) {
            return response()->json(['message' => 'You are not authorized to cancel this project.'], 403);
        }
        $project = Project::findOrFail($request->projectId);

        DB::table('project_creator')->where('project_id', $request->projectId)->where('creator_id', $request->creatorId)->update(['status' => 0]);

        $creator = User::findOrFail($request->creatorId);
        $user = User::findOrFail($request->userId);
        $user->notify(new ProjectCancelledNotification($project, $creator));
        return response()->json(['message' => 'Project cancelled successfully.']);
    }
}
