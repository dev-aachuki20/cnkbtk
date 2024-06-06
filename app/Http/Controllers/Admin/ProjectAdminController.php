<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProjectsAdminDataTable;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class ProjectAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProjectsAdminDataTable $dataTable)
    {
        return $dataTable->render('admin.project.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view("admin.project.show", compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $section = Report::findOrFail($id);
            $section->delete();
            $notification = array(
                'message' => trans("messages.delete_success", ['module' => trans("cruds.reports.title_singular")]),
                'alert-type' => 'success'
            );
            return $response = response()->json([
                'success' => true,
                'message' => $notification,
            ]);
        }
    }

    public function updateStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'  => 'required|exists:projects,id',
            'status'   => 'required|in:1,0',
        ]);

        if ($validator->passes()) {
            $project = Project::find($request->id);
            if ($project) {
                $project->status = $request->status;
                $project->save();
                return response()->json(['success' => true, 'message' =>  trans("messages.status_success", ['module' => trans("cruds.create_project.project")])], 200);
            }
        } else {
            return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray(), 'message' =>  trans("messages.error_occured")], 400);
        }
    }

    public function readChat(Request $request, $projectId)
    {
        // dd($request->all());
        $project = Project::findOrFail($projectId);

        // find user
        $userId = $project->user_id;
        $user = User::with('uploads')->findOrFail($userId);

        //Find project id form project_creator table
        // find creator
        $creator = User::findOrFail(DB::table('project_creator')->where('project_id', $projectId)->where('user_status', 1)->where('creator_status', 1)->value('creator_id'));

        $creatorId = $creator->id;

        // Get chat between user and creator
        $getChatData = Chat::with(['sender', 'receiver'])
            ->where(function ($query) use ($user, $creator) {
                $query->where('sender_id', $user->id)
                    ->where('receiver_id', $creator->id);
            })
            ->orWhere(function ($query) use ($user, $creator) {
                $query->where('sender_id', $creator->id)
                    ->where('receiver_id', $user->id);
            })
            ->where('project_id', $projectId)
            ->orderBy('id', 'desc')
            ->paginate(4);
        // ->get();
        $getChatData = $getChatData->reverse();
        if ($request->isAjax == true) {
            // dd('sdf');
            $html = view('admin.message.message', compact('getChatData', 'user', 'creator', 'projectId', 'userId', 'creatorId'))->render();
            return response()->json(['html' => $html]);
        } else {
            return view('admin.message.index', compact('getChatData', 'user', 'creator', 'projectId', 'userId', 'creatorId'));
        }
    }

    public function loadMoreAdminMessages(Request $request)
    {
        // dd($request->all());
        $senderId = $request->userId;
        $receiverId = $request->creatorId;
        $projectId = $request->project_id;
        $lastMessageId = $request->last_message_id;

        $additionalMessages = Chat::with('sender', 'receiver')
            ->where('project_id', $projectId)
            ->where(function ($q) use ($receiverId, $senderId) {
                $q->where(function ($query) use ($receiverId, $senderId) {
                    $query->where('receiver_id', $receiverId)
                        ->where('sender_id', $senderId);
                })
                    ->orWhere(function ($query) use ($receiverId, $senderId) {
                        $query->where('sender_id', $receiverId)
                            ->where('receiver_id', $senderId);
                    });
            })
            ->where('id', '<', $lastMessageId)
            ->orderBy('id', 'desc')
            ->paginate(100);
        return response()->json($additionalMessages);
    }
}
