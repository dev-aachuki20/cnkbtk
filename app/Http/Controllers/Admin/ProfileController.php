<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;
use Storage;


class ProfileController extends Controller
{   
    public $folder;

    function __construct()
    {
        $this->folder =  'profileImage';
    }

    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function updateProfile(Request $request, $id)
    {
        $this->validate($request, [
            'user_name' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'image' => 'nullable|image|mimes:jpg,png,jpeg,JPG,JPEG,PNG'
            ],[],[
                'user_name' => trans("cruds.profile.fields.user_name"),
                'email'=> trans("cruds.profile.fields.email"),
                'image'=> trans("cruds.profile.fields.image"),
            ]
        );

        $user = Auth::user();
        if ($request->hasFile('image')) {
            if (isset($user->uploads->first()->path) && Storage::disk('public')->exists($user->uploads->first()->path)) {
                deleteFile($user->uploads->first()->id);
            }
            $file = $request->file('image');
            $profileImage = uploadImage($user, $file, $this->folder); 
        }
        
        $user->user_name = $request->user_name;
        $user->email = $request->email;
       
        $user->save();

        return redirect()->back()->with(['message' => trans("messages.profile.success"),'alert-type' =>  'success']);
    }
    
    public function showChangePasswordForm(Request $request) {
        return view('admin.change-password');
    }

    public function changePassword(Request $request) {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:5|confirmed',
        ],[],[
            'old_password' => trans("cruds.change_password.fields.user_name"),
            'password'=> trans("cruds.change_password.fields.email"),
        ]);
        $user = Auth::user();
        if (!Hash::check($request->old_password, $user->password)) {
            $notification = ['message' => '{{trans("messages.password.old_not_match")}}','alert-type' =>  'error'];
        } else {
            $user->update(['password' => Hash::make($request->password)]);
            $notification = ['message' => '{{trans("messages.password_success")}}','alert-type' =>  'success'];
        }
        return redirect()->back()->with($notification);
    }
}
