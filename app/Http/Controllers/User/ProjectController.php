<?php

namespace App\Http\Controllers\User;

use App\DataTables\ProjectUserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Models\BlacklistUser;
use App\Models\Project;
use App\Models\TagType;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Notifications\ProjectCreatedNotification;
use Illuminate\Support\Facades\Notification;


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

            // Attach creators to the project
            if ($request->has('creator_id')) {
                $project->creators()->attach($request->input('creator_id'));
            }
            // Get selected creators
            $creatorIds = $request->input('creator_id');
            // If creators are selected, send notifications to them
            if ($creatorIds) {
                $creators = User::whereIn('id', $creatorIds)->get();
                Notification::send($creators, new ProjectCreatedNotification($project));
            } else {
                $users = User::where('role_id', config("constant.role.creator"))->get();
                Notification::send($users, new ProjectCreatedNotification($project));
            }

            DB::commit();
            $routeUrl = URL::route('user.project.create');
            return response()->json(['reloadUrl' => $routeUrl, 'message' => trans("messages.add_success", ['module' => trans("global.project")]), 'alert-type' =>  'success'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => trans("messages.something_went_wrong"),
                'alert-type' => 'error'
            ], 500);
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

    public function getProjectRequest($id)
    {
        $requestProject = Project::findorFail($id);
        return view('project.creator-show', compact('requestProject'));
    }
}
