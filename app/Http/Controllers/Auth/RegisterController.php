<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\BlacklistUser;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_name' => ['required', 'string','alpha_num', 'max:255','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed','regex:/[a-z]/','regex:/[A-Z]/','regex:/[0-9]/','regex:/[@$!%*#?&]/'],
        ],[
            'password.regex' => trans("pages.sign_up.char_password"),
        ],[
            'user_name' => trans("pages.sign_up.form.fields.user_name"),
            'email'  => trans("pages.sign_up.form.fields.email_address"),
            'password'  => trans("pages.sign_up.form.fields.password"),
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {   
        return User::create([
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => config("constant.role.user"),
            'registration_ip' => $data["registration_ip"],
            'status' => 1
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        if (BlacklistUser::where('email', $request->email)->exists()) {
            return $request->wantsJson()
                ? new JsonResponse(['message' =>  trans("messages.registration_failed")], 422)
                : redirect()->back()->withErrors(['email' => trans("messages.registration_failed")]);
        }

        $data = array();
        $data = $request->all(); 
        $data['registration_ip'] = $request->ip();

        event(new Registered($user = $this->create($data)));
        $this->guard()->login($user);
        if ($response = $this->registered($request, $user)) {
            return $response;
            LoginLog::create([
                'user_id' => auth()->user()->id,
                'ip_address' => $request->ip(),
                'login_at' => now(),
            ]);
        }
        
        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }

    public function registered(Request $request, $user)
    {   
        return redirect()->route('home')->with(['message' => trans("messages.register.success"), 'alert-type' =>'success' ]);
    }
}
