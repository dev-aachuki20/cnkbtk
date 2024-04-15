<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\DataTables\TagDataTable;
use App\Models\TagType;
use Validator;
use Illuminate\Validation\Rule;
use Storage;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TagDataTable $dataTable)
    {
        return $dataTable->render('admin.tag_management.tags.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tagTypes = TagType::where( "status" , 1)->get();
        return view('admin.tag_management.tags.create',compact(["tagTypes"]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name_en' => ['required','string','unique:tags'],
            'name_ch' => ['required','string','unique:tags'],
            'tag_type' => ['required','exists:tag_types,id'],
            'status' => ['required','in:0,1']
        ],[],[
            'name_en' => trans("cruds.tag_management.tag.fields.title"),
            'name_ch'  => trans("cruds.tag_management.tag.fields.title"),
            'tag_type'  => trans("cruds.tag_management.tag.fields.tag_type"),
            'status' => trans("cruds.global.status"),
        ]);

        $tag = new Tag;
        $tag->name_en = $request->name_en;
        $tag->name_ch = $request->name_ch;
        $tag->tag_type = $request->tag_type;
        $tag->status = $request->status;
        
        if($tag->save()){
            return redirect()->back()->with(['message' => trans("messages.add_success",['module' => trans("cruds.tag_management.tag.title_singular")]),'alert-type' =>  'success']);
        }else{
            return redirect()->back()->with(['message' => trans("messages.something_went_wrong"),'alert-type' =>  'error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::with('type')->findOrFail($id);
        return view("admin.tag_management.tags.show",compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        $tagTypes = TagType::where("status",1)->get();
        return view("admin.tag_management.tags.edit",compact('tag','tagTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   $validateData = $request->validate([
            'name_en' => ['required','string',Rule::unique('tags')->where(function ($query) use ($request) {
                return $query->where('tag_type', $request->tag_type);
            })->ignore($id)],
            'name_ch' => ['required','string',Rule::unique('tags')->where(function ($query) use ($request) {
            return $query->where('tag_type', $request->tag_type);
            })->ignore($id)],
            'tag_type' => ['required','exists:tag_types,id'],
            'status' => ['required','in:0,1']
        ],[],[
            'name_en' => trans("cruds.tag_management.tag.fields.title"),
            'name_ch'  => trans("cruds.tag_management.tag.fields.title"),
            'tag_type'  => trans("cruds.tag_management.tag.fields.tag_type"),
            'status' => trans("cruds.global.status"),
        ]);

        $tag = Tag::findOrFail($id);
        $tag->name_en = $request->name_en;
        $tag->name_ch = $request->name_ch;
        $tag->status = $request->status;
        $tag->tag_type = $request->tag_type;
       
        
        if($tag->save()){
            return redirect()->back()->with(['message' => trans("messages.update_success",['module' => trans("cruds.tag_management.tag.title_singular")]),'alert-type' =>  'success']);
        }else{
            return redirect()->back()->with(['message' => trans("messages.something_went_wrong"),'alert-type' =>  'error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Tag $tag)
    {
        if ($request->ajax()) {
            $tag->delete();
            $notification = array(
                'message' => trans("messages.delete_success",['module' => trans("cruds.tag_management.tag.title_singular")]),
                'alert-type' =>'success' 
            );
            return $response = response()->json([
                'success' => true,
                'message' => $notification,
            ]);
        }
    }

    public function updateStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'  => 'required|exists:tags,id',
            'status' => 'required|in:1,0',
        ]);

        if ($validator->passes()) {
            $tag = Tag::find($request->id);
            if ($tag) {
                $tag->status = $request->status;
                $tag->save();
                return response()->json(['success' => true, 'message' => trans("messages.status_success")], 200);
            }
        } else {
            return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray(), 'message' => trans("messages.error_occured")], 400);
        }
    }
}
