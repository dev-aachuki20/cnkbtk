<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BlacklistTagDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlacklistTag\StoreBlacklistTagRequest;
use Illuminate\Http\Request;
use App\Models\BlacklistTag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Validation\Rule;

class BlacklistTagController extends Controller
{
    public function index(BlacklistTagDataTable $dataTable)
    {
        try {
            return $dataTable->render('admin.blacklist_tag.index');
        } catch (\Exception $e) {
            return response()->json([
                'message' => trans("messages.something_went_wrong"),
                'alert-type' => 'error'
            ], 500);
        }
    }

    public function create()
    {
        try {
            return view('admin.blacklist_tag.create');
        } catch (\Exception $e) {
            return response()->json([
                'message' => trans("messages.something_went_wrong"),
                'alert-type' => 'error'
            ], 500);
        }
    }

    public function store(StoreBlacklistTagRequest $request)
    {
        try {
            DB::beginTransaction();
            $validatedData = $request->all();
            $validatedData['created_by'] = Auth::user()->id;

            BlacklistTag::create($validatedData);
            DB::commit();
            return redirect()->back()->with(['message' => trans("messages.add_success", ['module' => trans("cruds.blacklist_tag.message")]), 'alert-type' =>  'success']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => trans("messages.something_went_wrong"),
                'alert-type' => 'error'
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $blacklistTag = BlacklistTag::findOrFail($id);
            return view("admin.blacklist_tag.show", compact('blacklistTag'));
        } catch (\Exception $e) {
            return response()->json([
                'message' => trans("messages.something_went_wrong"),
                'alert-type' => 'error'
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $blacklistTag = BlacklistTag::findOrFail($id);
            return view("admin.blacklist_tag.edit", compact('blacklistTag'));
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => trans("messages.something_went_wrong"),
                'alert-type' => 'error'
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name_en' => ['required', 'string', Rule::unique('blacklist_tags')->whereNull('deleted_at')->ignore($id)],
                'name_ch' => ['required', 'string', Rule::unique('blacklist_tags')->whereNull('deleted_at')->ignore($id)],
                'status' => ['required', 'in:0,1']
            ], [], [
                'name_en' => trans("cruds.blacklist_tag.fields.title"),
                'name_ch' => trans("cruds.blacklist_tag.fields.title"),
                'status' => trans("cruds.global.status"),
            ]);

            $blacklistTag = BlacklistTag::findOrFail($id);

            if ($blacklistTag) {
                $validatedData['updated_by'] = Auth::user()->id;
                $blacklistTag->update($validatedData);
                return redirect()->back()->with(['message' => trans("messages.update_success", ['module' => trans("cruds.blacklist_tag.message")]), 'alert-type' =>  'success']);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => trans("messages.something_went_wrong"),
                'alert-type' => 'error'
            ], 500);
        }
    }

    public function destroy(Request $request, BlacklistTag $blacklistTag)
    {
        try {
            if ($request->ajax()) {
                $blacklistTag->delete();
                $notification = array(
                    'message' => trans("messages.delete_success", ['module' => trans("cruds.blacklist_tag.title_singular")]),
                    'alert-type' => 'success'
                );
                return $response = response()->json([
                    'success' => true,
                    'message' => $notification,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => trans("messages.something_went_wrong"),
                'alert-type' => 'error'
            ], 500);
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id'  => 'required|exists:blacklist_tags,id',
                'status' => 'required|in:1,0',
            ]);

            if ($validator->passes()) {
                $tag = BlacklistTag::find($request->id);
                if ($tag) {
                    $tag->status = $request->status;
                    $tag->save();
                    return response()->json(['success' => true, 'message' => trans("messages.status_success")], 200);
                }
            } else {
                return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray(), 'message' => trans("messages.error_occured")], 400);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => trans("messages.something_went_wrong"),
                'alert-type' => 'error'
            ], 500);
        }
    }
}
