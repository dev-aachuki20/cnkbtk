<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Poster;
use App\DataTables\SubSectionDataTable;
use Validator;
use Illuminate\Validation\Rule;
use Storage;

class SubSectionController extends Controller
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
    public function index(SubSectionDataTable $dataTable)
    {
        return $dataTable->render('admin.section.sub_section.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {       
        $parentSections = Section::where(["level" => config("constant.sectionLevel.level1"), "status" => 1 ])->get();
        return view('admin.section.sub_section.create',compact(["parentSections"]));
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
                return $query->where('level', config("constant.sectionLevel.level2"));
             })],
            'name_ch' => ['required','string',Rule::unique('sections')->where(function ($query) use ($request) {
                return $query->where('level', config("constant.sectionLevel.level2"));
            })],
            'description_en' => ['required','string','max:1000'],
            'description_ch' => ['required','string','max:1000'],
            'creator_can_post' => ['required','in:0,1'],
            'user_can_post' => ['required','in:0,1'],
            'show_in_header' => ['required','in:0,1'],
            'show_in_footer' => ['required','in:0,1'],
            'parent_id' => ['required','exists:sections,id'],
            'section_logo' => ['nullable','mimes:png,PNG','max:1024'],
            'status' => ['required','in:0,1']
        ],[],[
            'name_en' => trans("cruds.section_management.sub_section.fields.title"),
            'name_ch'  => trans("cruds.section_management.sub_section.fields.title"),
            'description_en' => trans("cruds.section_management.sub_section.fields.description"),
            'description_ch'  => trans("cruds.section_management.sub_section.fields.description"),
            'creator_can_post' => trans("cruds.section_management.sub_section.fields.creator_can_post"),
            'user_can_post'  => trans("cruds.section_management.sub_section.fields.user_can_post"),
            'show_in_header' => trans("cruds.section_management.sub_section.fields.show_in_header"),
            'show_in_footer'  => trans("cruds.section_management.sub_section.fields.show_in_footer"),
            'parent_id' => trans("cruds.section_management.sub_section.fields.parent_section"),
            'section_logo' => trans("cruds.section_management.sub_section.fields.section_logo"),
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
        $section->parent_id = $request->parent_id;
        $section->level = config("constant.sectionLevel.level2");
        
        if($section->save()){
            if ($request->hasFile('section_logo')) {
                if (isset($section->uploads->first()->path) && Storage::disk('public')->exists($section->uploads->first()->path)) {
                    deleteFile($section->uploads->first()->id);
                }
                $file = $request->file('section_logo');
                $profileImage = uploadImage($section, $file, $this->folder); 
            }

            return redirect()->back()->with(['message' => 'Section has been added successfully!','alert-type' =>  'success']);
        }else{
            return redirect()->back()->with(['message' =>  trans("messages.something_went_wrong"),'alert-type' =>  'error']);
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
        return view("admin.section.sub_section.show",compact('section'));
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
        $parentSections = Section::where(["level" => config("constant.sectionLevel.level1"), "status" => 1 ])->get();
        return view("admin.section.sub_section.edit",compact('section','parentSections'));
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
            'name_en' => ['required','string',Rule::unique('sections')->where(function ($query) use ($request) {
                return $query->where('level', config("constant.sectionLevel.level2"));
            })->ignore($id)],
            'name_ch' => ['required','string',Rule::unique('sections')->where(function ($query) use ($request) {
            return $query->where('level', config("constant.sectionLevel.level2"));
            })->ignore($id)],
            'description_en' => ['required','string','max:1000'],
            'description_ch' => ['required','string','max:1000'],
            'creator_can_post' => ['required','in:0,1'],
            'user_can_post' => ['required','in:0,1'],
            'show_in_header' => ['required','in:0,1'],
            'show_in_footer' => ['required','in:0,1'],
            'parent_id' => ['required','exists:sections,id'],
            'section_logo' => ['nullable','mimes:png,PNG','max:1024'],
            'status' => ['required','in:0,1']
        ],[],[
            'name_en' => trans("cruds.section_management.sub_section.fields.title"),
            'name_ch'  => trans("cruds.section_management.sub_section.fields.title"),
            'description_en' => trans("cruds.section_management.sub_section.fields.description"),
            'description_ch'  => trans("cruds.section_management.sub_section.fields.description"),
            'creator_can_post' => trans("cruds.section_management.sub_section.fields.creator_can_post"),
            'user_can_post'  => trans("cruds.section_management.sub_section.fields.user_can_post"),
            'show_in_header' => trans("cruds.section_management.sub_section.fields.show_in_header"),
            'show_in_footer'  => trans("cruds.section_management.sub_section.fields.show_in_footer"),
            'parent_id' => trans("cruds.section_management.sub_section.fields.parent_section"),
            'section_logo' => trans("cruds.section_management.sub_section.fields.section_logo"),
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
        $section->parent_id = $request->parent_id;
        $section->level = config("constant.sectionLevel.level2");

        if ($section->save()) {
            if ($request->hasFile('section_logo')) {
                // Check if the section has existing uploads
                $existingUpload = $section->uploads->first();
                
                if ($existingUpload) {
                    // Delete the existing file from storage
                    if (Storage::disk('public')->exists($existingUpload->path)) {
                        Storage::disk('public')->delete($existingUpload->path);
                    }
        
                    // Upload the new file and update the existing upload record
                    $file = $request->file('section_logo');
                    $profileImage = uploaSectiondImage($section, $file, $this->folder, $existingUpload);
                } else {
                    // Upload the new file and create a new upload record
                    $file = $request->file('section_logo');
                    $profileImage = uploaSectiondImage($section, $file, $this->folder);
                }
            }
        
            return redirect()->back()->with([
                'message' => 'Section has been updated successfully!',
                'alert-type' => 'success'
            ]);
        } else {
            return redirect()->back()->with([
                'message' => trans("messages.something_went_wrong"),
                'alert-type' => 'error'
            ]);
        }
        
        // if($section->save()){
        //     if ($request->hasFile('section_logo')) {
        //         if (isset($section->uploads->first()->path) && Storage::disk('public')->exists($section->uploads->first()->path)) {
        //             deleteFile($section->uploads->first()->id);
        //         }
        //         $file = $request->file('section_logo');
        //         $profileImage = uploadImage($section, $file, $this->folder); 
        //     }

        //     return redirect()->back()->with(['message' => 'Section has been updated successfully!','alert-type' =>  'success']);
        // }else{
        //     return redirect()->back()->with(['message' =>  trans("messages.something_went_wrong"),'alert-type' =>  'error']);
        // }
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
                $deleteSection = Section::where('parent_id', $id)->delete();
                $section->delete();
                $posters = Poster::where("sub_section",$id)->delete();
                $notification = array(
                    'message' => trans("messages.delete_subsection",['module' => trans("cruds.global.status")]),
                    'alert-type' =>'success' 
                );
                return $response = response()->json([
                    'success' => true,
                    'message' => $notification,
                ]);
            }
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
            return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray(), 'message' =>  trans("messages.error_occured")], 400);
        }
    }

}
