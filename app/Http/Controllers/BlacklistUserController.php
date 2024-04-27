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

    public function create()
    {
        return view("blacklist-user.create");
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

    // public function import(Request $request)
    // {
    //     $request->validate([
    //         'file' => 'required|mimes:xlsx,csv,txt|max:2048',
    //     ]);

    //     try {
    //         Excel::import(new BlacklistUsersImport, $request->file('file'));

    //         return back()->with('success', 'Data imported successfully');
    //     } catch (\Exception $e) {
    //         return back()->with('error', 'Error importing data: ' . $e->getMessage());
    //     }
    // }

    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'excel_file' => 'required|file|mimes:xlsx,xls|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('excel_file')) {
            $file = $request->file('excel_file');

            Excel::import(new BlacklistUsersImport, $file);
            return redirect()->back()->with('success', 'Excel file uploaded and processed successfully.');
        }

        return redirect()->back()->with('error', 'Please select an Excel file.');
    }
}
