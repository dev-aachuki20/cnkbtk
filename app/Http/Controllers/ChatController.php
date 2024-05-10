<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\TryCatch;

class ChatController extends Controller
{
    /**
     * Display a listing sidebar users list..
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $userLogin = auth()->user();
            $users = [];
            if ($userLogin->role_id == config("constant.role.user")) {
                // get all creators.
                $users = User::where('role_id', config("constant.role.creator"))->get();
            } else if ($userLogin->role_id == config("constant.role.creator")) {
                // get all users.
                $users = User::where('role_id', config("constant.role.user"))->get();
            } else {
                // get both creator and users.
                $users = User::where('role_id', config("constant.role.user"))->orWhere('role_id', config("constant.role.creator"))->get();
            }
            return view('chat.index', compact('users'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        Chat::create($request->all());
        return  response()->json(['message' => 'Message sent successfully']);
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

    public function chatScreen(Request $request)
    {
        try {
            $userId = $request->user_id;
            $user = User::findOrFail($userId);
            $senderId = Auth()->user()->id;

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

            $html = view('chat.chat-screen', compact('user', 'getChatData'))->render();

            // return response()->json(['message' => trans("messages.add_success", ['module' => trans("global.blacklist_user")]), 'alert-type' =>  'success'], 200);

            return response()->json(['html' => $html]);
        } catch (\Exception $e) {
            dd($e);
            return response()->json([
                'message' => trans("messages.something_went_wrong"),
                'alert-type' => 'error'
            ], 500);
        }
    }
}
