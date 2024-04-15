<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;
use Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{   
    public $folder;

    function __construct()
    {
        $this->folder =  'profileImage';
    }


    public function updateProfile(Request $request)
    {      
       
        $this->validate($request, [
            'user_name' => ['required', 'string','alpha_num', 'max:255',Rule::unique('users')->ignore(auth()->user()->id)],
            //'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(auth()->user()->id)],
            'image' => ['nullable','mimes:jpg,png,jpeg,JPG,JPEG,PNG','max:1024'],
            'user_about' => ['nullable','max:1000','string']
        ],[],[
            'user_name' =>  trans("pages.user.profile_tab.form.field.user_name"),
            'image' =>  trans("pages.user.profile_tab.form.field.profile_image"),
            'user_about' =>  trans("pages.user.profile_tab.form.field.about_your_self"),

        ]);

       
        $user = User::findOrFail(Auth::user()->id);
        if ($request->hasFile('image')) {
            if (isset($user->uploads->first()->path) && Storage::disk('public')->exists($user->uploads->first()->path)) {
                deleteFile($user->uploads->first()->id);
            }
            $file = $request->file('image');
            $profileImage = uploadImage($user, $file, $this->folder); 
        }
        
        $user->user_name = $request->user_name;
        //$user->email = $request->email;
        $user->user_about = $request->user_about;
        $user->save();

        return redirect()->back()->with(['message' => trans("messages.profile.success"),'alert-type' =>  'success']);
    }

    public function changePassword(Request $request) {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ],[],[
            'old_password' =>  trans("pages.user.change_password_tab.old_password"),
            'password' =>  trans("pages.user.change_password_tab.new_password"),
        ]);

        $user = Auth::user();
        if (!Hash::check($request->old_password, $user->password)) {
            $notification = ['message' => trans("messages.password.old_not_match"),'alert-type' =>  'error'];
            return response()->json($notification,405);
        } else {
            $user->update(['password' => Hash::make($request->password)]);
            $notification = ['message' => trans("messages.password.success"),'alert-type' =>  'success'];
            return response()->json($notification,200);
        }
       
    }
}
