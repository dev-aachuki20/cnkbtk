<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\DataTables\UserDataTable;
use Illuminate\Validation\Rule;
use Storage;
use Validator;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $folder;
    
    function __construct()
    {   
        $this->folder =  'profileImage';
    }

    
    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  

        $validateData = $request->validate([
                'user_name' => ['required','string','unique:users','alpha_num'],
                'email' => ['required','email','unique:users'],
                'role_id' => ['required','in:2,3'],
                'image' => ['nullable','mimes:jpg,png,jpeg,JPG,JPEG,PNG','max:1024'],
                'status' => ['required','in:0,1']
        ],[],[
                'user_name' => trans("cruds.user.fields.user_name"),
                'email'=> trans("cruds.user.fields.email"),
                'role_id'=> trans("cruds.user.fields.role"),
                'image'=> trans("cruds.user.fields.image"),
                'status'=> trans("cruds.global.status")
        ]);

        //$validateData = $request->validate();
       
        $user = new User;
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->status = $request->status;
        $user->password = Hash::make('12345678');
        
        if($user->save()){
            if ($request->hasFile('image')) {
                if (isset($user->uploads->first()->path) && Storage::disk('public')->exists($user->uploads->first()->path)) {
                    deleteFile($user->uploads->first()->id);
                }
                $file = $request->file('image');
                $profileImage = uploadImage($user, $file, $this->folder); 
            }
        }
        return redirect()->back()->with(['message' => trans("messages.add_success",['module' => trans("cruds.user.title_singular")]),'alert-type' =>  'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view("admin.users.show",compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view("admin.users.edit",compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   $validateData = $request->validate([
            'user_name' => ['required','string',Rule::unique("users")->ignore($id),'alpha_num'],
            'email' => ['required','email',Rule::unique("users")->ignore($id)],
            'role_id' => ['required','in:2,3'],
            'image' => ['nullable','mimes:jpg,png,jpeg,JPG,JPEG,PNG','max:1024'],
            'status' => ['required','in:0,1']
        ],[],[
            'user_name' => trans("cruds.user.fields.user_name"),
            'email'=> trans("cruds.user.fields.email"),
            'role_id'=> trans("cruds.user.fields.role"),
            'image'=> trans("cruds.user.fields.image"),
            'status'=> trans("cruds.global.status")
        ]);
       
        $user = User::findOrFail($id);
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->status = $request->status;
        $user->password = Hash::make('12345678');
        
        if($user->save()){
            if ($request->hasFile('image')) {
                if (isset($user->uploads->first()->path) && Storage::disk('public')->exists($user->uploads->first()->path)) {
                    deleteFile($user->uploads->first()->id);
                }
                $file = $request->file('image');
                $profileImage = uploadImage($user, $file, $this->folder); 
            }
        }
        return redirect()->back()->with(['message' => trans("messages.update_success",['module' => trans("cruds.user.title_singular")]),'alert-type' =>  'success']);
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


    public function updateStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userId'  => 'required|exists:users,id',
            'status'   => 'required|in:1,0',
        ]);
        if ($validator->passes()) {
            $user = User::find($request->userId);
            if ($user) {
                $user->status = $request->status;
                $user->save();
                return response()->json(['success' => true, 'message' => trans("messages.status_success",['module' => trans("cruds.user.title_singular")])], 200);
            }
        } else {
            return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray(), 'message' => trans("messages.error_occured",['module' => trans("cruds.user.title_singular")])], 400);
        }
    }
}
