<?php

namespace App\Http\Controllers;

use App\Events\Message;
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
                $projectStatus = $project->project_status;
                if ($projectStatus == 1) {
                    // get only one creator that is associated with that project after project is locked.
                    $creartorId = DB::table('project_creator')->where('project_id', $projectId)->where('creator_status', 1)->value('creator_id');
                    $creators = User::where('id', $creartorId)->get();
                } else {
                    //get all creators so I can show in the sidebar.
                    $creators = $project->creators;
                }
            }

            $user = User::with('uploads')->findOrFail($userId);

            // get all chat data
            $getChatData = Chat::with('sender', 'receiver')
                ->where('project_id', $projectId)
                ->where(function ($query) use ($receiverId, $senderId) {
                    $query->where('receiver_id', $receiverId)
                        ->where('sender_id', $senderId);
                })
                ->orWhere(function ($query) use ($receiverId, $senderId) {
                    $query->where('sender_id', $receiverId)
                        ->where('receiver_id', $senderId);
                })
                ->where('project_id', $projectId)
                ->orderBy('id', 'desc')
                ->paginate(100);
            $getChatData = $getChatData->reverse();
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
        $data = $request->all();
        Chat::create($data);
        broadcast(new Message($request->content, Auth::id(), $request->receiver_id))->toOthers();

        return  response()->json(['message' => 'Message sent successfully']);
    }

    public function messageScreen(Request $request)
    {
        try {
            $userId = $request->user_id;
            $user = User::findOrFail($userId);
            $senderId = Auth()->user()->id;
            $projectId =  $request->project_id;
            $receiverId = $userId;

            $project = Project::findOrFail($projectId);
            $projectStatus = $project->project_status;

            $projectAssginStatus = DB::table('project_creator')->where('project_id', $projectId)->where('user_status', 1)->where('creator_id', $userId)->value('assign_status');

            // Check if any creator has not responded within 7 days
            $shouldEnableButton = DB::table('project_creator')
                ->where('project_id', $projectId)
                ->where('user_status', 1)
                ->where('assign_status', 1)
                ->where('creator_status', 0)
                ->where('assign_date', '<=', now()->subDays(7))
                ->exists();

            if ($shouldEnableButton) {
                DB::table('project_creator')
                    ->where('project_id', $projectId)
                    ->where('user_status', 1)
                    ->where('assign_status', 1) // Assigned
                    ->where('assign_date', '<=', now()->subDays(7))
                    ->update(['assign_status' => 0, 'assign_date' => null]);
            }

            // Determine button text based on assignment status and shouldEnableButton
            $buttonText = $projectAssginStatus == 1 ? __('cruds.global.assigned') : __('cruds.global.assign');
            if ($shouldEnableButton) {
                $buttonText = __('cruds.global.assign');
            }

            $getChatData = Chat::with('sender', 'receiver')
                ->where('project_id', $projectId)
                ->where(function ($query) use ($userId, $senderId) {
                    $query->where('receiver_id', $userId)
                        ->where('sender_id', $senderId);
                })
                ->orWhere(function ($query) use ($userId, $senderId) {
                    $query->where('sender_id', $userId)
                        ->where('receiver_id', $senderId);
                })
                ->where('project_id', $projectId)
                ->orderBy('id', 'desc')->paginate(100);
            $getChatData = $getChatData->reverse();
            $html = view('message.message-screen', compact('user', 'getChatData', 'projectId', 'projectStatus', 'shouldEnableButton', 'buttonText', 'projectAssginStatus', 'receiverId', 'senderId'))->render();

            return response()->json(['html' => $html]);
        } catch (\Exception $e) {
            // dd($e->getMessage(). $e->getFile() . $e->getLine());
            return response()->json([
                'message' => trans("messages.something_went_wrong"),
                'alert-type' => 'error'
            ], 500);
        }
    }

    public function loadMoreMessages(Request $request)
    {
        $senderId = Auth::user()->id;
        $receiverId = $request->receiver_id;
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
