<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Poster;
use App\Models\UniqueVisitor;
use App\Models\User;
use App\Models\Query;
use Carbon\Carbon;
use Validator;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Points;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $posters =  Poster::with(["userDetails","parentSection"])->where("status",1)->orderBy("id", "DESC")->take(10)->get();
        $posterCount = Poster::where("status",1)->count();
        $sections = Section::with('subSections')->where(['level' => 1 , 'status' => 1])->orderBy('position','asc')->get();
        $advertisements = Advertisement::where(function($query){
            $query->orWhere("advertisement_type",'home_banner_image')->orWhere("advertisement_type",'notification_image');
        })->where("status",1)->orderBy("id","desc")->get();
        $members = User::where("role_id","!=",config("constant.role.admin"))->count();
        $uniqueVisitorCount = UniqueVisitor::where("date",Carbon::now()->toDateString())->orWhere("date" , Carbon::yesterday()->toDateString())->get();
        $todayVisitor = $uniqueVisitorCount->where("date",Carbon::now()->toDateString())->count();
        $yesterdayVisitor = $uniqueVisitorCount->where("date",Carbon::yesterday()->toDateString())->count();
        return view('home',compact('sections','posters','posterCount','advertisements','members','todayVisitor','yesterdayVisitor'));
    }


    public function search(Request $request){
        
        if(!empty($request->search_query)){
            $searchQuery = $request->search_query;
            $results = Poster::with("userDetails")->where(function($query) use ($searchQuery){
                $query->orWhere('title_en','like', '%'.$searchQuery.'%')
                ->orWhere('title_ch','like', '%'.$searchQuery.'%');
            })->get();
            
            $view = view("render.search_result",compact("results"))->render();
            return response()->json(["view" => $view],200);
        }else{

            return response()->json(['success' => false, 'errors' => "Something went wrong"], 400);
        }
       //return response()->json($notification);
    }


    public function SubmitQuery(Request $request){
        // $rules = [
        //     'email' => ['email','string','nullable'],
        //     'subject' => ['required','max:999'],
        //     'message' => ['required','max:9999'],
        // ]; 
        // $validate = $this->validate($request, $rules);

        $validateData = $request->validate( [
            'email' => ['email','string','nullable'],
            'subject' => ['required','max:999'],
            'message' => ['required','max:9999'],
            ],[],[
            'email' => trans("cruds.enquiries.fields.email"),
            'subject'  => trans("cruds.enquiries.fields.subject"),
            'message'  => trans("cruds.enquiries.fields.message")
        ]);
        $email =  $request->email;
        if(empty($request->email)){
            $email = $request->ip();
        }
        $queryData = ['email'=> $email, 
                    'subject'=>  $request->subject , 
                    'message' => $request->message
                ];
        $save = Query::create($queryData);
        return response()->json(['message' => trans("messages.contact.success"),'alert-type' =>  'success'],200);
    }
    
    
    public function addPreviousUser(Request $request){
        $usersArray = DB::table('pre_ucenter_members')->get()->toArray();
        
        foreach ($usersArray as $userData) {
            $user = new User();
            $user->user_name = $userData->username;
            $user->email = $userData->email;
            $user->password = Hash::make('pass@1234');
            $user->registration_ip = $userData->regip;
            $user->created_at = Carbon::createFromTimestamp($userData->regdate);
            $user->updated_at = Carbon::createFromTimestamp($userData->regdate);
            $user->status = 1;
            $user->role_id = config("constant.role.user");
            
            $user->save();
        }
    }
    
    public function addCreditPoints(Request $request){
        $creditPointsArray = DB::table('pre_common_member')->select('uid', 'credits')->whereNotNull('uid')->get()->toArray();
        
        foreach ($creditPointsArray as $point) {
             DB::table('points')->insert([
                'user_id' => $point->uid,
                'plan_id' => 1,
                'credit' => $point->credits,
                'debit' => null,
                'amount' => $point->credits,
                'available_general_point' => $point->credits,
                'available_integral_point' => null,
                'post_id' => null,
                'episode_id' => null,
                'type' => config("constant.point_type.general"),
                'status' => 1,
                'creator_id' => null ,
                'payment_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        return "points store successfully.";
    }
    
}

