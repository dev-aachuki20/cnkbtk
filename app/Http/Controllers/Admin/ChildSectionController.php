<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Poster;
use App\DataTables\ChildSectionDataTable;
use Validator;
use Illuminate\Validation\Rule;

class ChildSectionController extends Controller
{  
    public $folder;

    function __construct()
    {   
        $this->folder =  'section_logo';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ChildSectionDataTable $dataTable)
    {
        return $dataTable->render('admin.section.child_section.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parentSections = Section::where(["level" => config("constant.sectionLevel.level1"), "status" => 1 ])->get();
        return view('admin.section.child_section.create',compact(["parentSections"]));
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
            'name_en' => ['required','string',Rule::unique('sections')->where(function ($query) use ($request) {
                return $query->where('level', config("constant.sectionLevel.level3"));
            })],
            'name_ch' => ['required','string',Rule::unique('sections')->where(function ($query) use ($request) {
            return $query->where('level', config("constant.sectionLevel.level3"));
            })],
            'description_en' => ['required','string','max:1000'],
            'description_ch' => ['required','string','max:1000'],
            'creator_can_post' => ['required','in:0,1'],
            'user_can_post' => ['required','in:0,1'],
            'show_in_header' => ['required','in:0,1'],
            'show_in_footer' => ['required','in:0,1'],
            'parent_id' => ['required','exists:sections,id'],
            'sub_parent_id' => ['required','exists:sections,id'],
            'section_logo' => ['nullable','mimes:png,PNG','max:1024'],
            'status' => ['required','in:0,1']
        ],[],[
            'name_en' => trans("cruds.section_management.child_section.fields.title"),
            'name_ch'  => trans("cruds.section_management.child_section.fields.title"),
            'description_en' => trans("cruds.section_management.child_section.fields.description"),
            'description_ch'  => trans("cruds.section_management.child_section.fields.description"),
            'creator_can_post' => trans("cruds.section_management.child_section.fields.creator_can_post"),
            'user_can_post'  => trans("cruds.section_management.child_section.fields.user_can_post"),
            'show_in_header' => trans("cruds.section_management.child_section.fields.show_in_header"),
            'show_in_footer'  => trans("cruds.section_management.child_section.fields.show_in_footer"),
            'parent_id' => trans("cruds.section_management.child_section.fields.parent_section"),
            'sub_parent_id' => trans("cruds.section_management.child_section.fields.sub_section"),
            'section_logo' => trans("cruds.section_management.child_section.fields.section_logo"),
            'status' => trans("cruds.global.status"),
        ]);


        $section = new Section;
        $section->name_en = $request->name_en;
        $section->name_ch = $request->name_ch;
        $section->description_en = $request->description_en;
        $section->description_ch = $request->description_ch;
        $section->creator_can_post = $request->creator_can_post;
        $section->user_can_post = $request->user_can_post;
        $section->show_in_header = $request->show_in_header;
        $section->show_in_footer = $request->show_in_footer;
        $section->status = $request->status;
        $section->parent_id = $request->sub_parent_id;
        $section->level = config("constant.sectionLevel.level3");
        
        if($section->save()){
            if ($request->hasFile('section_logo')) {
                if (isset($section->uploads->first()->path) && Storage::disk('public')->exists($section->uploads->first()->path)) {
                    deleteFile($section->uploads->first()->id);
                }
                $file = $request->file('section_logo');
                $profileImage = uploadImage($section, $file, $this->folder); 
            }

            return response()->json(['message' => trans("messages.add_success",['module' => trans("cruds.section_management.child_section.title_singular")]),'alert-type' =>  'success'],200);
           // return redirect()->back()->with(['message' => 'Section has been added successfully!','alert-type' =>  'success']);
        }else{
            return response()->json(['message' => trans("messages.something_went_wrong"),'alert-type' =>  'error'],500);
            //return redirect()->back()->with();
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
        $section = Section::with('parent_category')->findOrFail($id);
        return view("admin.section.child_section.show",compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $section = Section::findOrFail($id);
        $parentId = Section::where("id",$section->parent_category->parent_category->id)->pluck("id")->first();
        $parentSections = Section::where(["level" => config("constant.sectionLevel.level1"), "status" => 1 ])->get();
        return view("admin.section.child_section.edit",compact('section','parentSections','parentId'));
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
            'name_en' => ['required','string',Rule::unique('sections')->where(function ($query) use ($request) {
                return $query->where('level', config("constant.sectionLevel.level3"));
             })->ignore($id)],
            'name_ch' => ['required','string',Rule::unique('sections')->where(function ($query) use ($request) {
                return $query->where('level', config("constant.sectionLevel.level3"));
            })->ignore($id)],
            'description_en' => ['required','string','max:1000'],
            'description_ch' => ['required','string','max:1000'],
            'creator_can_post' => ['required','in:0,1'],
            'user_can_post' => ['required','in:0,1'],
            'show_in_header' => ['required','in:0,1'],
            'show_in_footer' => ['required','in:0,1'],
            'parent_id' => ['required','exists:sections,id'],
            'sub_parent_id' => ['required','exists:sections,id'],
            'section_logo' => ['nullable','mimes:png,PNG','max:1024'],
            'status' => ['required','in:0,1']
        ],[],[
            'name_en' => trans("cruds.section_management.child_section.fields.title"),
            'name_ch'  => trans("cruds.section_management.child_section.fields.title"),
            'description_en' => trans("cruds.section_management.child_section.fields.description"),
            'description_ch'  => trans("cruds.section_management.child_section.fields.description"),
            'creator_can_post' => trans("cruds.section_management.child_section.fields.creator_can_post"),
            'user_can_post'  => trans("cruds.section_management.child_section.fields.user_can_post"),
            'show_in_header' => trans("cruds.section_management.child_section.fields.show_in_header"),
            'show_in_footer'  => trans("cruds.section_management.child_section.fields.show_in_footer"),
            'parent_id' => trans("cruds.section_management.child_section.fields.parent_section"),
            'sub_parent_id' => trans("cruds.section_management.child_section.fields.sub_section"),
            'section_logo' => trans("cruds.section_management.child_section.fields.section_logo"),
            'status' => trans("cruds.global.status"),
        ]);
        

        $section = Section::findOrFail($id);
        $section->name_en = $request->name_en;
        $section->name_ch = $request->name_ch;
        $section->description_en = $request->description_en;
        $section->description_ch = $request->description_ch;
        $section->creator_can_post = $request->creator_can_post;
        $section->user_can_post = $request->user_can_post;
        $section->show_in_header = $request->show_in_header;
        $section->show_in_footer = $request->show_in_footer;
        $section->status = $request->status;
        $section->parent_id = $request->sub_parent_id;
        $section->level = config("constant.sectionLevel.level3");
        
        if($section->save()){
            if ($request->hasFile('section_logo')) {
                if (isset($section->uploads->first()->path) && Storage::disk('public')->exists($section->uploads->first()->path)) {
                    deleteFile($section->uploads->first()->id);
                }
                $file = $request->file('section_logo');
                $profileImage = uploadImage($section, $file, $this->folder); 
            }
            return response()->json(['message' => trans("messages.update_success",['module' => trans("cruds.section_management.child_section.title_singular")]),'alert-type' =>  'success'],200);
            //return redirect()->back()->with(['message' => 'Section has been updated successfully!','alert-type' =>  'success']);
        }else{
            return response()->json(['message' => trans("messages.something_went_wrong"),'alert-type' =>  'error'],500);
            //return redirect()->back()->with(['message' => 'Something went wrong!','alert-type' =>  'error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {   
        if ($request->ajax()) {
            $section = Section::findOrFail($id);
            if($section){
                $posters = Poster::where("child_section",$id)->delete();
            }
            $section->delete();
            $notification = array(
                'message' => trans("messages.delete_success",['module' => trans("cruds.section_management.child_section.title_singular")]),
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
            'id'  => 'required|exists:sections,id',
            'status' => 'required|in:1,0',
        ]);

        if ($validator->passes()) {
            $section = Section::find($request->id);
            if ($section) {
                $section->status = $request->status;
                $section->save();
                return response()->json(['success' => true, 'message' => trans("messages.status_success")], 200);
            }
        } else {
            return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray(), 'message' => trans("messages.error_occured")], 400);
        }
    }
}
