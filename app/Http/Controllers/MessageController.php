<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class MessageController extends Controller
{
    public function index($projectId, $userId)
    {
        try {
            $senderId = Auth::user()->id; //creator
            $receiverId = $userId; // userid
            $projectId = $projectId; //project id

            $user = User::with('uploads')->findOrFail($userId);

            // get all user data
            return view('message.index', compact('receiverId', 'senderId', 'projectId', 'user'));
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

    public function sendMessage(Request $request)
    {
        // $request->validate([
        //     'content' => 'required|string',
        //     // 'recipientId' => 'required|exists:users,id'
        // ]);

        Chat::create($request->all());



        // Return a success response
        // return response()->json(['success' => true]);   
        // return  response()->json(['message' => trans("messages.follow_success"),'alert-type' =>  'success',"follow_status" => 0]);

        return  response()->json(['message' => 'Message sent successfully']);
    }

    public function getMessages($userId)
    {
        dd('gbjf');
        $user = User::findOrFail($userId);
        $incomingMessages = $user->incomingMessages()->with('sender')->get();
        $outgoingMessages = $user->outgoingMessages()->with('receiver')->get();

        return view('messages', compact('incomingMessages', 'outgoingMessages'));
    }
}
