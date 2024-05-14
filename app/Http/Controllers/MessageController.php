<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index($projectId)
    {
        try {
            $senderId = Auth::user()->id;
            $senderRoleId = Auth::user()->role_id;
            $project = Project::findOrFail($projectId);
            $userId = $project->user_id;
            $creators = null;
            if ($senderRoleId == config('constant.role.creator')) {
                $receiverId = $userId;
                $projectId = $projectId;
            } else {
                $receiverId = $senderId;

                // If project is locked.
                $getProjectStatus = $project->project_status;
                if ($getProjectStatus == 1) {
                    // get only one creator that is associated with that project after project is locked.
                    $creartorId = DB::table('project_creator')->where('project_id', $projectId)->value('creator_id');
                    $creators = User::where('id', $creartorId)->get();
                } else {
                    //get all creators so I can show in the sidebar.
                    $creators = $project->creators;
                }
            }

            $user = User::with('uploads')->findOrFail($userId);

            // get all chat data
            $getChatData = Chat::with('sender', 'receiver')
                ->where(function ($query) use ($receiverId, $senderId) {
                    $query->where('receiver_id', $receiverId)
                        ->where('sender_id', $senderId);
                })
                ->orWhere(function ($query) use ($receiverId, $senderId) {
                    $query->where('sender_id', $receiverId)
                        ->where('receiver_id', $senderId);
                })
                ->orderBy('id', 'asc')
                ->get();
            return view('message.index', compact('receiverId', 'senderId', 'projectId', 'user', 'getChatData', 'creators'));
        } catch (\Throwable $th) {
        }
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function storeMessage(Request $request)
    {
        Chat::create($request->all());
        return  response()->json(['message' => 'Message sent successfully']);
    }


    // public function displayUserSide($projectId)
    // {
    //     $userId = Auth::user()->id;
    //     $user = User::findOrFail($userId);

    //     return view('message.message-screen');
    // }

    public function messageScreen(Request $request)
    {
        try {
            $userId = $request->user_id;
            $user = User::findOrFail($userId);
            $senderId = Auth()->user()->id;
            $projectId =  $request->project_id;

            // $userStatus =  DB::table('project_creator')->where('project_id', $projectId)->where('creator_id', $userId)->value('user_status');

            $project = Project::findOrFail($projectId);
            $projectStatus = $project->project_status;

            $getChatData = Chat::with('sender', 'receiver')
                ->where(function ($query) use ($userId, $senderId) {
                    $query->where('receiver_id', $userId)
                        ->where('sender_id', $senderId);
                })
                ->orWhere(function ($query) use ($userId, $senderId) {
                    $query->where('sender_id', $userId)
                        ->where('receiver_id', $senderId);
                })
                ->orderBy('id', 'asc')
                ->get();

            $html = view('message.message-screen', compact('user', 'getChatData', 'projectId', 'projectStatus'))->render();

            // return response()->json(['message' => trans("messages.add_success", ['module' => trans("global.blacklist_user")]), 'alert-type' =>  'success'], 200);

            return response()->json(['html' => $html]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => trans("messages.something_went_wrong"),
                'alert-type' => 'error'
            ], 500);
        }
    }
}
