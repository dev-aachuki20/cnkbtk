<?php

namespace App\Http\Controllers;

use App\DataTables\BlacklistUserDataTable;
use App\Http\Requests\BlacklistUser\StoreBlacklistUserRequest;
use App\Http\Requests\BlacklistUser\UpdateBlacklistUserRequest;
use App\Models\BlacklistUser;
use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BlacklistUsersImport;
use App\Models\BlacklistTag;
use App\Models\Uploads;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BlacklistUserController extends Controller
{

    public function index(BlacklistUserDataTable $dataTable)
    {
        try {
            $balcklistTag = BlacklistTag::where('status', 1)->get();
            return $dataTable->render('blacklist-user.index', compact('balcklistTag'));
        } catch (\Exception $e) {
            return response()->json([
                'message' => trans("messages.something_went_wrong"),
                'alert-type' => 'error'
            ], 500);
        }
    }

    public function store(StoreBlacklistUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $validatedData = $request->all();
            $user = User::where('email', $validatedData['email'])->first();
            $userId = $user ? $user->id : null;
            $validatedData['user_id'] = $user ? $userId : null;

            $existingBlacklistUser = BlacklistUser::where('email', $validatedData['email'])->first();
            if ($existingBlacklistUser) {
                return response()->json([
                    'message' => trans("messages.email_already_blacklisted"),
                    'alert-type' => 'warning'
                ], 400);
            } else {
                if ($validatedData['blacklist_tag_id'] == 'other') {
                    $validatedData['blacklist_tag_id'] = null;
                    $validatedData['other_reason'] = $request->other_reason;
                } else {
                    $validatedData['other_reason'] = null;
                }

                BlacklistUser::create($validatedData);

                DB::commit();
                return response()->json(['message' => trans("messages.add_success", ['module' => trans("global.blacklist_user")]), 'alert-type' =>  'success'], 200);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => trans("messages.something_went_wrong"),
                'alert-type' => 'error'
            ], 500);
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
            // dd($e->getMessage(). $e->getFile() . $e->getLine());
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

    public function update(UpdateBlacklistUserRequest $request)
    {
        $id = $request->id;
        try {
            DB::beginTransaction();
            $validatedData = $request->all();
            $user = User::where('email', $request->email)->first();
            $userId = $user ? $user->id : null;
            $validatedData['user_id'] = $userId;

            // Handle other_reason field
            if ($request->blacklist_tag_id === 'other') {
                $validatedData['blacklist_tag_id'] = null;
            } else {
                $validatedData['other_reason'] = null;
            }

            $blacklistUser = BlacklistUser::findOrFail($id);
            $blacklistUser->update($validatedData);

            DB::commit();
            return response()->json(['message' => trans("messages.update_success", ['module' => trans("global.blacklist_user")]), 'alert-type' =>  'success'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => trans("messages.something_went_wrong"), 'alert-type' =>  'error'], 500);
        }
    }

    public function downloadExcel()
    {
        $filePath = public_path('sample_excel_blacklist_user.xlsx');
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="sample_excel_blacklist_user.xlsx"',
        ];
        return response()->download($filePath, 'sample_excel_blacklist_user.xlsx', $headers);
    }
}
