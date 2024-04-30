<?php

namespace App\Http\Controllers;

use App\DataTables\BlacklistUserDataTable;
use App\Models\BlacklistUser;
use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BlacklistUsersImport;
use App\Models\BlacklistTag;
use App\Models\Uploads;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BlacklistUserController extends Controller
{

    public function index(BlacklistUserDataTable $dataTable)
    {
        $balcklistTag = BlacklistTag::all();
        return $dataTable->render('blacklist-user.index', compact('balcklistTag'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'email'],
            'ip_address' => ['required', 'ip'],
            'blacklist_tag_id' => ['required'],
        ], [], [
            'email.required' => trans("pages.blacklist_user.form.fields.email"),
            'email.email' =>  trans("pages.blacklist_user.form.fields.email"),
            'ip_address.required' => trans("pages.blacklist_user.form.fields.ip_address"),
            'ip_address.ip' => trans("pages.blacklist_user.form.fields.ip_address"),
            'blacklist_tag_id.required' => trans("pages.blacklist_user.form.fields.reason"),
        ]);

        try {
            DB::beginTransaction();
            $user = User::where('email', $request->email)->first();
            $userId = $user ? $user->id : null;
            $validatedData['user_id'] = $userId;
            BlacklistUser::create($validatedData);
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

    public function show($id)
    {
        try {
            $blacklistUser =  BlacklistUser::findOrfail($id);
            $uploadPath = null;
            if ($blacklistUser->user_id) {
                $upload = Uploads::where('uploadsable_id', $blacklistUser->user_id)->first();
                if ($upload) {
                    $uploadPath = asset('storage/' . $upload->path);
                }
            }
            return view('blacklist-user.show', compact('blacklistUser', 'uploadPath'));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Blacklist user not found'], 404);
        }
    }

    public function edit($id)
    {
        try {
            $blacklistUser = BlacklistUser::findOrFail($id);
            return response()->json(['data' => $blacklistUser], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Blacklist user not found'], 404);
        }
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $validatedData = $request->validate([
            'email' => ['required', 'email', Rule::unique('blacklist_users')->ignore($id)],
            'ip_address' => ['required', 'ip'],
            'blacklist_tag_id' => ['required'],
        ], [], [
            'email.required' => trans("pages.blacklist_user.form.fields.email"),
            'email.email' =>  trans("pages.blacklist_user.form.fields.email"),
            'ip_address.required' => trans("pages.blacklist_user.form.fields.ip_address"),
            'ip_address.ip' => trans("pages.blacklist_user.form.fields.ip_address"),
            'blacklist_tag_id.required' => trans("pages.blacklist_user.form.fields.reason"),
        ]);

        try {
            DB::beginTransaction();
            $user = User::where('email', $request->email)->first();
            $userId = $user ? $user->id : null;
            $validatedData['user_id'] = $userId;

            $blacklistUser = BlacklistUser::findOrFail($id);
            $blacklistUser->update($validatedData);

            DB::commit();
            return response()->json(['message' => trans("messages.add_success", ['module' => trans("global.blacklist_user")]), 'alert-type' =>  'success'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => trans("messages.something_went_wrong"), 'alert-type' =>  'error'], 500);
        }
    }
}
