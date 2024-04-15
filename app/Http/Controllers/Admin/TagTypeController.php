<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TagType;
use App\Models\Tag;
use App\DataTables\TagTypeDataTable;
use Validator;
use Illuminate\Validation\Rule;


class TagTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TagTypeDataTable $dataTable)
    {
        return $dataTable->render('admin.tag_management.tag_type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag_management.tag_type.create');
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
            'name_en' => ['required','string','unique:tag_types'],
            'name_ch' => ['required','string','unique:tag_types'],
            'status' => ['required','in:0,1']
        ],[],[
            'name_en' => trans("cruds.tag_management.tag_type.fields.title"),
            'name_ch'  => trans("cruds.tag_management.tag_type.fields.title"),
            'status' => trans("cruds.global.status"),
        ]);

        $tagtype = new TagType;
        $tagtype->name_en = $request->name_en;
        $tagtype->name_ch = $request->name_ch;
        $tagtype->status = $request->status;
        $tagtype->save();
        return redirect()->back()->with(['message' => trans("messages.add_success",['module' => trans("cruds.tag_management.tag_type.title_singular")]),'alert-type' =>  'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tagtype = TagType::findOrFail($id);
        return view("admin.tag_management.tag_type.show",compact('tagtype'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tagType = TagType::findOrFail($id);
        return view("admin.tag_management.tag_type.edit",compact('tagType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $validateData = $request->validate([
            'name_en' => ['required','string',Rule::unique('tag_types')->ignore($id)],
            'name_ch' => ['required','string',Rule::unique('tag_types')->ignore($id)],
            'status' => ['required','in:0,1']
        ],[],[
            'name_en' => trans("cruds.tag_management.tag_type.fields.title"),
            'name_ch'  => trans("cruds.tag_management.tag_type.fields.title"),
            'status' => trans("cruds.global.status"),
        ]);

        

        $tagtype = TagType::findOrFail($id);
        $tagtype->name_en = $request->name_en;
        $tagtype->name_ch = $request->name_ch;
        $tagtype->status = $request->status;
        $tagtype->save();
        return redirect()->back()->with(['message' => trans("messages.update_success",['module' => trans("cruds.tag_management.tag_type.title_singular")]),'alert-type' =>  'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,TagType $tagType)
    {
        if ($request->ajax()) { 
        
            $deleteTags = Tag::where('tag_type' , $tagType->id)->delete();
            $tagType->delete();
            $notification = array(
                'message' => trans("messages.delete_success",['module' => trans("cruds.tag_management.tag_type.title_singular")]),
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
            'id'  => 'required|exists:tag_types,id',
            'status' => 'required|in:1,0',
        ]);

        if ($validator->passes()) {
            $tagtype = TagType::find($request->id);
            if ($tagtype) {
                $tagtype->status = $request->status;
                $tagtype->save();
                return response()->json(['success' => true, 'message' => trans("messages.status_success")], 200);
            }
        } else {
            return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray(), 'message' => trans("messages.error_occured")], 400);
        }
    }
}
