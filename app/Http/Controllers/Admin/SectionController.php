<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Poster;
use App\DataTables\SectionDataTable;
use Validator;
use Illuminate\Validation\Rule;

class SectionController extends Controller
{
    public $folder;

    function __construct()
    {
        $this->folder =  'profileImage';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SectionDataTable $dataTable)
    {
        return $dataTable->render('admin.section.parent_section.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('admin.section.parent_section.create');
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
            'name_en' => ['required', 'string', Rule::unique('sections')->where(function ($query) use ($request) {
                return $query->where('level', config("constant.sectionLevel.level1"));
            })],
            'name_ch' => ['required', 'string', Rule::unique('sections')->where(function ($query) use ($request) {
                return $query->where('level', config("constant.sectionLevel.level1"));
            })],
            'description_en' => ['required', 'string', 'max:1000'],
            'description_ch' => ['required', 'string', 'max:1000'],
            'creator_can_post' => ['required', 'in:0,1'],
            'user_can_post' => ['required', 'in:0,1'],
            'show_in_header' => ['required', 'in:0,1'],
            'show_in_footer' => ['required', 'in:0,1'],
            'status' => ['required', 'in:0,1'],
            'position' => ['required','unique:sections,position']
        ], [], [
            'name_en' => trans("cruds.section_management.parent_section.fields.title"),
            'name_ch'  => trans("cruds.section_management.parent_section.fields.title"),
            'description_en' => trans("cruds.section_management.parent_section.fields.description"),
            'description_ch'  => trans("cruds.section_management.parent_section.fields.description"),
            'creator_can_post' => trans("cruds.section_management.parent_section.fields.creator_can_post"),
            'user_can_post'  => trans("cruds.section_management.parent_section.fields.user_can_post"),
            'show_in_header' => trans("cruds.section_management.parent_section.fields.show_in_header"),
            'show_in_footer'  => trans("cruds.section_management.parent_section.fields.show_in_footer"),
            'position' => trans("cruds.section_management.parent_section.fields.position"),
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
        $section->position = $request->position;
        $section->level = config("constant.sectionLevel.level1");
        $section->save();
        return redirect()->back()->with(['message' => trans("messages.add_success", ['module' => trans("cruds.section_management.parent_section.title_singular")]), 'alert-type' =>  'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $section = Section::findOrFail($id);
        return view("admin.section.parent_section.show", compact('section'));
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
        return view("admin.section.parent_section.edit", compact('section'));
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
            'name_en' => ['required', 'string', Rule::unique('sections')->where(function ($query) use ($request) {
                return $query->where('level', config("constant.sectionLevel.level1"));
            })->ignore($id)],
            'name_ch' => ['required', 'string', Rule::unique('sections')->where(function ($query) use ($request) {
                return $query->where('level', config("constant.sectionLevel.level1"));
            })->ignore($id)],
            'description_en' => ['required', 'string', 'max:1000'],
            'description_ch' => ['required', 'string', 'max:1000'],
            'creator_can_post' => ['required', 'in:0,1'],
            'user_can_post' => ['required', 'in:0,1'],
            'show_in_header' => ['required', 'in:0,1'],
            'show_in_footer' => ['required', 'in:0,1'],
            // 'position' => ['required','unique:sections,position'],
            'position' => ['required',Rule::unique('sections')->ignore($id)],
            'status' => ['required', 'in:0,1']
        ], [], [
            'name_en' => trans("cruds.section_management.parent_section.fields.title"),
            'name_ch'  => trans("cruds.section_management.parent_section.fields.title"),
            'description_en' => trans("cruds.section_management.parent_section.fields.description"),
            'description_ch'  => trans("cruds.section_management.parent_section.fields.description"),
            'creator_can_post' => trans("cruds.section_management.parent_section.fields.creator_can_post"),
            'user_can_post'  => trans("cruds.section_management.parent_section.fields.user_can_post"),
            'show_in_header' => trans("cruds.section_management.parent_section.fields.show_in_header"),
            'show_in_footer'  => trans("cruds.section_management.parent_section.fields.show_in_footer"),
            'position' => trans("cruds.section_management.parent_section.fields.position"),
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
        $section->position = $request->position;
        $section->level = config("constant.sectionLevel.level1");
        $section->save();
        return redirect()->back()->with(['message' => trans("messages.update_success", ['module' => trans("cruds.section_management.parent_section.title_singular")]), 'alert-type' =>  'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {


            $section = Section::findOrFail($id);
            if ($section) {

                $subsections =  Section::where('parent_id', $section->id)->get();

                if ($subsections->count() > 0) {
                    foreach ($subsections as $key => $value) {
                        $childSection  = Section::where("parent_id", $value->id)->delete();
                    }
                }

                $subsections =  Section::where('parent_id', $section->id)->delete();
                $section->delete();
                $notification = array(
                    'message' => trans("messages.delete_success", ['module' => trans("cruds.section_management.parent_section.title_singular")]),
                    'alert-type' => 'success'
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
                // update status of parent section
                $section->status = $request->status;
                $section->save();

                // update status of posters which associatated with parent section
                $posterStatus = $request->status == 1 ? 1 : 0;

                $section->parentSectionPosters()->update(['status' => $posterStatus]);
                return response()->json(['success' => true, 'message' => trans("messages.status_success")], 200);
            }
        } else {
            return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray(), 'message' => trans("messages.error_occured")], 400);
        }
    }
}
