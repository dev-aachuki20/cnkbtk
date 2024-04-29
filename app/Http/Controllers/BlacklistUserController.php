<?php

namespace App\Http\Controllers;

use App\Models\BlacklistUser;
use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BlacklistUsersImport;
use Illuminate\Support\Facades\Validator;

class BlacklistUserController extends Controller
{

    public function index()
    {
        $balcklistUsers = BlacklistUser::paginate(15);
        return view("blacklist-user.index", compact('balcklistUsers'));
    }

    public function store(Request $request)
    {
        $rules = [
            'email' => ['required', 'email'],
            'ip_address' => ['required', 'ip'],
        ];
        $customMessages = [
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'ip_address.required' => 'IP address is required',
            'ip_address.ip' => 'IP address must be a valid IP address',
        ];

        $this->validate($request, $rules, $customMessages);
        DB::beginTransaction();
        try {
            $blacklistUserData = $request->only(['email', 'ip_address']);
            BlacklistUser::create($blacklistUserData);
            DB::commit();
            return response()->json(['message' => trans("messages.add_success", ['module' => trans("global.blacklist_user")]), 'alert-type' =>  'success'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => trans("messages.something_went_wrong"), 'alert-type' =>  'error'], 500);
        }
    }


    public function importExcel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'excel_file' => 'required|file|mimes:xlsx,xls|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        try {
            DB::beginTransaction();
            if ($request->hasFile('excel_file')) {
                $file = $request->file('excel_file');
                Excel::import(new BlacklistUsersImport, $file);
                DB::commit();
                return response()->json(['message' => trans("messages.excel_uploaded")], 200);
            }
        } catch (\Exception $e) {
            DB::rollback();
            $message = 'Something went wrong';
            return response()->json(['message' => $message], 400);
        }
    }
}
