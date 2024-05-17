<?php

namespace App\Http\Controllers\User;

use App\DataTables\ProjectStatusDataTable;
use App\DataTables\ProjectUserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Project\StoreProjectRequest;
use App\Models\BlacklistUser;
use App\Models\Project;
use App\Models\TagType;
use App\Models\User;
use App\Notifications\BidUpdatedNotification;
use App\Notifications\ProjectConfirmedForAdminNotification;
use App\Notifications\ProjectConfirmedForCreatorNotification;
use App\Notifications\ProjectConfirmedForUserNotification;
use App\Notifications\ProjectConfirmedNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Notifications\ProjectCreatedNotification;
use App\Notifications\ProjectFinishedNotification;
use App\Notifications\ProjectLockNotification;
use App\Notifications\ProjectLockRequestNotification;
use App\Notifications\ProjectUpdatedNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;


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
            $routeUrl = URL::route('user.project.index');
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

    public function edit(Project $project)
    {
        $tagTypes = TagType::all();
        $creators = User::where('role_id', config("constant.role.creator"))->get();
        return view("project.edit", compact('tagTypes', 'creators', 'project'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'title' => ['required', 'string',  Rule::unique('projects')->ignore($id)],
            'budget' => ['required'],
            'comment' => ['required'],
        ];

        $customMessages = [];

        $customName = [
            'title' => trans("cruds.create_project.fields.title"),
            'budget' => trans("cruds.create_project.fields.budget"),
            'comment' => trans("cruds.create_project.fields.description"),
        ];


        $this->validate($request, $rules, $customMessages, $customName);
        try {
            if (BlacklistUser::where('email', auth()->user()->email)->exists()) {
                return response()->json(['message' => trans("messages.project_request_failed"), 'alert-type' => 'error'], 403);
            }
            DB::beginTransaction();
            $project = Project::findOrFail($id);


            $oldTitle = $project->title;
            $oldType = $project->type;
            $oleTags_id = $project->tags_id;
            $oldBudget = $project->budget;
            $oldComment = $project->comment;

            $oldCreatorIds = $project->creators()->pluck('id')->toArray();

            $project->update([
                'title' => $request->title,
                'type' => $request->type,
                'tags_id' => $request->tags_id,
                'budget' => $request->budget,
                'status' => $request->status,
                'comment' => $request->comment,
                'copyright' => $request->has('copyright') ? 1 : 0,
            ]);

            if ($request->has('creator_id')) {
                $project->creators()->sync($request->input('creator_id'));
            }


            $newCreatorIds = $request->input('creator_id', []);

            // Find new creator IDs
            $addedCreatorIds = array_diff($newCreatorIds, $oldCreatorIds);

            // If added new creator but not edit any field then Send create notification to new added creators only
            if (
                $addedCreatorIds && $oldTitle == $request->title && $oldType == $request->type && $oleTags_id == $request->tags_id && $oldBudget == $request->budget && $oldComment == $request->comment
            ) {
                foreach ($addedCreatorIds as $creatorId) {
                    $creator = User::find($creatorId);
                    Notification::send($creator, new ProjectCreatedNotification($project, $creator));
                }
            }

            // If added field but not add new creator then send update notification to old users only
            if (
                $oldType != $request->type || $oleTags_id != $request->tags_id || $oldBudget != $request->budget || $oldComment != $request->comment && empty($addedCreatorIds)
            ) {
                // Send update notification to old creators only
                foreach ($oldCreatorIds as $creatorId) {
                    $creator = User::find($creatorId);
                    Notification::send($creator, new ProjectUpdatedNotification($project, $creator));
                }
            }

            // If changes in field and add new creator also
            if ($oldType != $request->type || $oleTags_id != $request->tags_id || $oldBudget != $request->budget || $oldComment != $request->comment && $addedCreatorIds) {
                // Send update notification to old creators
                foreach ($oldCreatorIds as $creatorId) {
                    $creator = User::find($creatorId);
                    Notification::send($creator, new ProjectUpdatedNotification($project, $creator));
                }
                // Send create notification to new added creators
                foreach ($addedCreatorIds as $creatorId) {
                    $creator = User::find($creatorId);
                    Notification::send($creator, new ProjectCreatedNotification($project, $creator));
                }
            }

            $creatorIds = $request->input('creator_id');
            // If all creators are removed during edit
            if (empty($creatorIds)) {
                // Send mail to all users
                $creator = User::where('role_id', config("constant.role.creator"))->get();
                foreach ($creator as $creatorId) {
                    $creator = User::find($creatorId->id);
                    Notification::send($creator, new ProjectUpdatedNotification($project, $creator));
                }
            }


            // $creatorIds = $request->input('creator_id');
            // // add one more condition like if remove all creators during edit then send mail to all.
            // if ($creatorIds) {
            //     foreach ($creatorIds as $creatorId) {
            //         $creator = User::find($creatorId);
            //         Notification::send($creator, new ProjectUpdatedNotification($project, $creator));
            //     }
            // } else {
            //     $creator = User::where('role_id', config("constant.role.creator"))->get();
            //     if ($creator) {
            //         foreach ($creator as $creatorId) {
            //             $creator = User::find($creatorId->id);
            //             Notification::send($creator, new ProjectUpdatedNotification($project, $creator));
            //         }
            //     }
            // }

            DB::commit();

            $routeUrl = URL::route('user.project.index');
            return response()->json(['reloadUrl' => $routeUrl, 'message' => trans("messages.update_success", ['module' => trans("global.project")]), 'alert-type' =>  'success'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => $e->getMessage(), 'alert-type' => 'error'], 500);
        }
    }

    // public function update(Request $request, $id)
    // {
    //     $rules = [
    //         'title' => ['required', 'string'],
    //         'budget' => ['required'],
    //         'comment' => ['required'],
    //     ];

    //     $customMessages = [];

    //     $customName = [
    //         'title' => trans("cruds.create_project.fields.title"),
    //         'budget' => trans("cruds.create_project.fields.budget"),
    //         'comment' => trans("cruds.create_project.fields.description"),
    //     ];


    //     $this->validate($request, $rules, $customMessages, $customName);
    //     try {
    //         if (BlacklistUser::where('email', auth()->user()->email)->exists()) {
    //             return response()->json(['message' => trans("messages.project_request_failed"), 'alert-type' => 'error'], 403);
    //         }
    //         DB::beginTransaction();
    //         $project = Project::findOrFail($id);

    //         $project->update([
    //             'title' => $request->title,
    //             'type' => $request->type,
    //             'tags_id' => $request->tags_id,
    //             'budget' => $request->budget,
    //             'status' => $request->status,
    //             'comment' => $request->comment,
    //             'copyright' => $request->has('copyright') ? 1 : 0,
    //         ]);

    //         if ($request->has('creator_id')) {
    //             $project->creators()->sync($request->input('creator_id'));
    //         }

    //         $creatorIds = $request->input('creator_id');

    //         if ($creatorIds) {
    //             foreach ($creatorIds as $creatorId) {
    //                 $creator = User::find($creatorId);
    //                 Notification::send($creator, new ProjectUpdatedNotification($project, $creator));
    //             }
    //         } else {
    //             $creator = User::where('role_id', config("constant.role.creator"))->get();
    //             if ($creator) {
    //                 foreach ($creator as $creatorId) {
    //                     $creator = User::find($creatorId->id);
    //                     Notification::send($creator, new ProjectUpdatedNotification($project, $creator));
    //                 }
    //             }
    //         }

    //         DB::commit();

    //         $routeUrl = URL::route('user.project.index');

    //         return response()->json(['reloadUrl' => $routeUrl, 'message' => trans("messages.update_success", ['module' => trans("global.project")]), 'alert-type' =>  'success'], 200);
    //     } catch (\Exception $e) {
    //         DB::rollback();
    //         return response()->json(['message' => $e->getMessage(), 'alert-type' => 'error'], 500);
    //     }
    // }


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
            $project = Project::findorFail($project_id);
            $creatorStatus =  DB::table('project_creator')->where('project_id', $project_id)->where('creator_id', $creator_id)->value('creator_status');
            return view('project.creator-show', compact('creator', 'project', 'creatorStatus'));
        }
    }

    public function getAllProjectRequest()
    {
        $user =  Auth::user();
        // $allRequestProjects = $user->projects;
        $allRequestProjects = $user->projects->map(function ($project) use ($user) {
            $creatorStatus = DB::table('project_creator')
                ->where('project_id', $project->id)
                ->where('creator_id', $user->id)
                ->value('creator_status');

            $userStatus = DB::table('project_creator')
                ->where('project_id', $project->id)
                ->where('creator_id', $user->id)
                ->value('user_status');

            return [
                'project' => $project, 'creatorStatus' => $creatorStatus, 'userStatus' =>  $userStatus,
            ];
        });

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

            $getUserStatus = DB::table('project_creator')->where('project_id', $request->project_id)->where('creator_id', $request->auth_id)->value('user_status');

            if ($getUserStatus == 1) {
                return response()->json(['message' => 'Sorry, you cannot bid. This project is locked.'], 403);
            }

            DB::table('project_creator')->where('project_id', $request->project_id)->where('creator_id', $request->auth_id)->update(['bid' => $validatedData['bid'], 'creator_status' => 2]);

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



    // cancel project by creator
    // public function cancelProjectByCreator(Request $request)
    // {
    //     if ($request->creatorId != Auth::id()) {
    //         return response()->json(['message' => 'You are not authorized to cancel this project.'], 403);
    //     }
    //     $project = Project::findOrFail($request->projectId);

    //     DB::table('project_creator')->where('project_id', $request->projectId)->where('creator_id', $request->creatorId)->update(['creator_status' => 0]);

    //     $creator = User::findOrFail($request->creatorId);
    //     $user = User::findOrFail($request->userId);
    //     $user->notify(new ProjectCancelledNotification($project, $creator));
    //     return response()->json(['message' => 'Project cancelled successfully.']);
    // }




    // Working function
    // locked project by user  and send request to creator when click on button from user panel.
    public function lockedProject(Request $request)
    {
        $authUser = auth()->user();
        $projectId = $request->projectId;
        $creatorID = $request->creatorId;

        DB::table('project_creator')->where('project_id', $projectId)->where('creator_id', $creatorID)->update(['user_status' => 1]);

        $project = Project::findOrFail($projectId);
        $creator = User::find($creatorID);
        $user = User::find($authUser->id);

        // Send email to creator.
        $creator->notify(new ProjectLockNotification($project, $creator, $authUser));
        // Send email to user.
        $user->notify(new ProjectLockRequestNotification($project, $creator, $authUser));

        return response()->json(['message' => trans("messages.project_lock_request", ['module' => trans("global.project")]), 'alert-type' =>  'success'], 200);
    }

    // confirm project by creator.
    public function confirmProjectByCreator(Request $request)
    {
        $projectId = $request->projectId;
        $creatorId = $request->creatorId;
        $userId = $request->userId;

        if ($request->creatorId != Auth::id()) {
            // return response()->json(['message' => 'You are not authorized to confirm this project.'], 403);
            return to_route('login');
        }

        $project = Project::findOrFail($projectId);
        DB::table('project_creator')->where('project_id', $projectId)->where('creator_id', $creatorId)->update(['creator_status' => 1, 'user_status' => 1]);

        $projectStatus =  $project->project_status == 0 ? 1 : 0;
        $project->update(['project_status' => $projectStatus]);

        $user = User::findOrFail($userId);
        $creator = User::findOrFail($creatorId);
        $admin = User::where('role_id', config('constant.role.admin'))->first();

        if ($project->project_status == 1) {
            // mail send to User
            $user->notify(new ProjectConfirmedForCreatorNotification($project, $creator, $user));

            // mail send to Creator
            $creator->notify(new ProjectConfirmedForUserNotification($project, $creator, $user));

            // mail send to Admin
            $admin->notify(new ProjectConfirmedForAdminNotification($project, $creator, $user, $admin));
        }
        return response()->json(['message' => 'Project confirmed successfully.']);
    }

    // confirm project by creator by mail confirm button
    public function confirmProject($creator_id, $project_id)
    {
        if ($creator_id != Auth::id()) {
            return to_route('login');
        }

        $project = Project::findOrFail($project_id);
        $userId = $project->user_id;

        DB::table('project_creator')->where('project_id', $project_id)->where('creator_id', $creator_id)->update(['creator_status' => 1]);

        $projectStatus =  $project->project_status == 0 ? 1 : 0;
        $project->update(['project_status' => $projectStatus]);

        $user = User::findOrFail($userId);
        $creator = User::findOrFail($creator_id);
        $admin = User::where('role_id', config('constant.role.admin'))->first();

        $creatorStatus =  DB::table('project_creator')->where('project_id', $project_id)->where('creator_id', $creator_id)->value('creator_status');

        if ($project->project_status == 1) {
            // mail send to User
            $user->notify(new ProjectConfirmedForCreatorNotification($project, $creator, $user));

            // mail send to Creator
            $creator->notify(new ProjectConfirmedForUserNotification($project, $creator, $user));

            // mail send to Admin
            $admin->notify(new ProjectConfirmedForAdminNotification($project, $creator, $user, $admin));
        }

        return view('project.creator-show', compact('creator', 'project', 'creatorStatus'));
    }

    //Finished prject by user.
    public function finishedProject(Request $request)
    {
        $request->validate([
            'remark' => 'required|string|max:255',
        ]);

        $projectId = $request->project_id;
        try {
            DB::beginTransaction();
            $project = Project::findOrFail($projectId);
            $project->update(['finish_status' => 1, 'remark' => $request->remark]);

            $creatorId = DB::table('project_creator')->where('project_id', $projectId)->value('creator_id');
            $creator =  User::where('id', $creatorId)->first(); //get creator
            $user = Auth()->user(); //get user           
            $admin = User::where('role_id', config('constant.role.admin'))->first(); //get admin        

            Notification::send($user, new ProjectFinishedNotification($project));
            Notification::send($admin, new ProjectFinishedNotification($project));
            Notification::send($creator, new ProjectFinishedNotification($project));

            DB::commit();
            return response()->json(['message' => trans("messages.finish_success", ['module' => trans("global.project")]), 'alert-type' =>  'success'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'alert-type' => 'error'], 422);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => trans("messages.something_went_wrong"), 'alert-type' => 'error'], 500);
        }
    }
}
