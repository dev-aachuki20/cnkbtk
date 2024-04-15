<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\LoginLog;
// use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
   

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        
    }


    // Overwriting Login Function 
    public function login(Request $request){
        $username = $request->user_name;
        $password  = $request->password;
        $columnName = "user_name";
        
        if(filter_var($username, FILTER_VALIDATE_EMAIL)) {
            //user sent their email 
            $columnName = "email";
        }
        $validations = [
            "user_name" => ['required','string', 'exists:users,'.$columnName.',status,1'],
            'password' => ['required','string'],
        ];

        $customMessages = [
            "user_name.exists" => "Invalid  email id or user name or your account is suspended"
        ];


        $customName = [
            "user_name" => trans("pages.login.form.fields.user"),
            "password" =>  trans("pages.login.form.fields.password"),
        ];

        $request->validate($validations,$customMessages,$customName);
       
        if(Auth::attempt([$columnName => $username, 'password' => $password])) {
            $response = ['alert-type' => "success", "message" => trans("auth.login_success")];
            LoginLog::create([
                'user_id' => auth()->user()->id,
                'ip_address' => $request->ip(),
                'login_at' => now(),
            ]);
            return redirect()->intended('/')->with($response);
        }else{
            $response = ['alert-type' => "error", "message" => trans('auth.failed')];
            return  redirect()->route("login")->with($response);
        }   
    
        
    }

    
    
}
