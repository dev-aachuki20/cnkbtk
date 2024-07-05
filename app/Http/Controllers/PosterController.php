<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\TagType;
use Validator;
use App\Models\Poster;
use App\Models\Uploads;
use Storage;
use Illuminate\Support\Facades\Crypt;

class PosterController extends Controller
{
    public $sections;
    public $tagTypes;
    public $folder;
    function  __construct()
    {
        $this->sections = Section::where("status", 1)->get();
        $this->tagTypes = TagType::with("tags")->where("status", 1)->get();
        $this->folder =  'poster_image';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posters = Poster::where("user_id", auth()->user()->id)->paginate(15);
        return view("post.post-history", compact('posters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userRole = auth()->user()->role_id;
        $parentSections = $this->sections->where("level", config("constant.sectionLevel.level1"));
        if ($userRole != config("constant.role.admin")) {
            if ($userRole == config("constant.role.user")) {
                $parentSections =   $parentSections->where("user_can_post", "1");
            } else {
                $parentSections = $parentSections->where("creator_can_post", "1");
            }
        }
        $tagTypes = $this->tagTypes;
        return view("post.create", compact('parentSections', 'tagTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => ['required', 'string'],
            'parent_section' => ['required', 'exists:sections,id'],
            'sub_section' => ['required', 'exists:sections,id'],
            // 'child_section' => ['required','exists:sections,id'],
            'poster_image' => ['nullable', 'mimes:jpg,png,jpeg,JPG,JPEG,PNG', 'max:1024'],
            'tags' => ['required', 'exists:tags,id'],
            'description' => ['required', 'string'],
            'episodes.*.title' => ['required'],
            'episodes.*.cost' => ['required'],
            'episodes.*.content' => ['required'],
            'status' => ['required', 'in:0,1']
        ];

        $customMessages = [

            // 'title.required' => 'Title  is required',
            // 'parent_section.required' => "Parent section is required",
            // 'parent_section.exists' => "Parent section is invalid",
            // 'sub_section.required' => "Sub section is required",
            // 'sub_section.exists' => "Sub section is invalid",
            // 'child_section.required' => "Child section is required",
            // 'child_section.exists' => "Child section is invalid",
            // 'poster_image.max' => "Image size should not be greater then 1 MB",
            // 'poster_image.mimes' => "only jpg,png,jpeg,JPG,JPEG,PNG extentions are allowed",
            // 'tags.*.required' => "Tags are required",
            // 'tags.*.exists' => "Tags are invalid",
            // 'description.required' => 'Description  is required',
            // 'episodes.*.title.required' => 'Episode title  is required',
            // 'episodes.*.cost.required' => 'Episode cost  is required',
            // 'episodes.*.content.required' => 'Episode content  is required',
            // 'status.required' => 'Status is required',
            // 'status.in' => 'Status is invalid',  
        ];
        $customName = [
            'title' => trans("pages.post.form.fields.title"),
            'parent_section' => trans("pages.post.form.fields.parent_section"),
            'sub_section' => trans("pages.post.form.fields.sub_section"),
            // 'child_section' => trans("pages.post.form.fields.child_section"),
            'poster_image' => trans("pages.post.form.fields.poster_cover_image"),
            'tags' => trans("pages.post.form.fields.tags"),
            'description' => trans("pages.post.form.fields.description"),
            'episodes.*.title' => trans("pages.post.form.fields.episode_title"),
            'episodes.*.cost' => trans("pages.post.form.fields.episode_cost"),
            'episodes.*.content' => trans("pages.post.form.fields.episode_description"),
            'status' => trans("pages.post.form.fields.status"),
            // "episodes.*.title" => "Title",
            // "episodes.*.cost" => "Cost",
            // "episodes.*.content" => "Content",

        ];

        $this->validate($request, $rules, $customMessages, $customName);
        \DB::beginTransaction();
        try {
            $posterData = [
                'title_en' =>  $request->title, 'title_ch' =>  $request->title, 'parent_section' => $request->parent_section, 'sub_section' => $request->sub_section, 'child_section' => $request->child_section,
                'description_en' => $request->description,
                'description_ch' => $request->description,
                'tags' => $request->tags, 'status' => $request->status
            ];
            $save = Poster::create($posterData);

            if ($request->has("episodes")) {
                $episodeCount =  count($request->episodes);
                $episodesData = $request->episodes;
                $episodes = array();
                foreach ($episodesData as $key => $value) {
                    $episodes['title_en'] = $episodesData[$key]['title'];
                    $episodes['title_ch'] = $episodesData[$key]['title'];
                    $episodes['description_en'] = $episodesData[$key]['content'];
                    $episodes['description_ch'] = $episodesData[$key]['content'];
                    $episodes['cost'] = $episodesData[$key]['cost'];
                    $episodes['poster_id'] = $save->id;
                    $saveEpisode = Episode::create($episodes);

                    // if (isset($user->uploads->first()->path) && Storage::disk('public')->exists($user->uploads->first()->path)) {
                    //     deleteFile($user->uploads->first()->id);
                    // }
                    if (isset($episodesData[$key]['images']) && count($episodesData[$key]['images']) > 0) {
                        foreach ($episodesData[$key]['images'] as $imageKey => $imageValue) {
                            $file = $imageValue;
                            $episodeImage = uploadImage($saveEpisode, $file, $this->folder);
                        }
                    }
                }
                //$episodes = Episode::insert($episodes);
            }

            if ($request->hasFile('poster_image')) {
                if (isset($save->uploads->first()->path) && Storage::disk('public')->exists($save->uploads->first()->path)) {
                    deleteFile($save->uploads->first()->id);
                }
                $file = $request->file('poster_image');
                uploadImage($save, $file, $this->folder);
            }

            \DB::commit();
            return response()->json(['message' => trans("messages.add_success", ['module' => trans("global.post")]), 'alert-type' =>  'success'], 200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['message' => trans("messages.something_went_wrong"), 'alert-type' =>  'error'], 500);
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
        $poster = Poster::with(["episodes", 'parentSection', 'subSection'])->where("id", Crypt::decrypt($id))->first();
        if ($poster->user_id == auth()->user()->id) {
            return view("post.show", compact("poster"));
        }
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $poster = Poster::with(["episodes.uploads", "uploads"])->where("id", Crypt::decrypt($id))->first();
        $parentSections = $this->sections->where("level", config("constant.sectionLevel.level1"));
        $subSections = $this->sections->where("level", config("constant.sectionLevel.level2"))->where("parent_id", $poster->parent_section);
        // $childSections = $this->sections->where("level" , config("constant.sectionLevel.level3"))->where( "parent_id" ,  $poster->sub_section);
        $userRole  = auth()->user()->role_id;
        if ($userRole != config("constant.role.admin")) {
            if ($userRole == config("constant.role.user")) {
                $parentSections->where("user_can_post", '1');
                $subSections->where("user_can_post", '1');
                // $childSections->where("user_can_post",'1');
            } else {
                $parentSections->where("creator_can_post", '1');
                $subSections->where("creator_can_post", '1');
                // $childSections->where("creator_can_post",'1');
            }
        }
        $tagTypes = $this->tagTypes;
        $imgesArray = array();
        if ($poster->user_id == auth()->user()->id || auth()->user()->id == config('constant.role.admin') ) {
            return view("post.edit", compact('parentSections', 'subSections', 'tagTypes', 'poster'));
        }
        abort(403);
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
        $id = Crypt::decrypt($id);
        $rules = [
            'title' => ['required', 'string'],
            'parent_section' => ['required', 'exists:sections,id'],
            'sub_section' => ['required', 'exists:sections,id'],
            // 'child_section' => ['required','exists:sections,id'],
            'poster_image' => ['nullable', 'mimes:jpg,png,jpeg,JPG,JPEG,PNG', 'max:1024'],
            'tags' => ['required', 'exists:tags,id'],
            'description' => ['required', 'string'],
            'episodes.*.title' => ['required'],
            'episodes.*.cost' => ['required'],
            'episodes.*.content' => ['required'],
            'status' => ['required', 'in:0,1']
        ];

        $customMessages = [
            // 'title.required' => 'Title  is required',
            // 'parent_section.required' => "Parent section is required",
            // 'parent_section.exists' => "Parent section is invalid",
            // 'sub_section.required' => "Sub section is required",
            // 'sub_section.exists' => "Sub section is invalid",
            // 'child_section.required' => "Child section is required",
            // 'child_section.exists' => "Child section is invalid",
            // 'poster_image.max' => "Image size should not be greater then 1 MB",
            // 'poster_image.mimes' => "only jpg,png,jpeg,JPG,JPEG,PNG extentions are allowed",
            // 'tags.*.required' => "Tags are required",
            // 'tags.*.exists' => "Tags are invalid",
            // 'description.required' => 'Description  is required',
            // 'episodes.*.title.required' => 'Episode title  is required',
            // 'episodes.*.cost.required' => 'Episode cost  is required',
            // 'episodes.*.content.required' => 'Episode content  is required',
            // 'status.required' => 'Status is required',
            // 'status.in' => 'Status is invalid'


        ];

        $customName = [
            'title' => trans("pages.post.form.fields.title"),
            'parent_section' => trans("pages.post.form.fields.parent_section"),
            'sub_section' => trans("pages.post.form.fields.sub_section"),
            // 'child_section' => trans("pages.post.form.fields.child_section"),
            'poster_image' => trans("pages.post.form.fields.poster_cover_image"),
            'tags' => trans("pages.post.form.fields.tags"),
            'description' => trans("pages.post.form.fields.description"),
            'episodes.*.title' => trans("pages.post.form.fields.episode_title"),
            'episodes.*.cost' => trans("pages.post.form.fields.episode_cost"),
            'episodes.*.content' => trans("pages.post.form.fields.episode_description"),
            'status' => trans("pages.post.form.fields.status"),
        ];


        $this->validate($request, $rules, $customMessages, $customName);
        \DB::beginTransaction();
        try {

            $posterData = ['title_en' =>  $request->title, 'title_ch' =>  $request->title, 'parent_section' => $request->parent_section, 'sub_section' => $request->sub_section, 'child_section' => $request->child_section, 'description_en' => $request->description, 'description_ch' => $request->description, 'tags' => $request->tags, 'status' => $request->status];
            // $save = Poster::where("id", $id)->update($posterData);

            $save = Poster::findOrFail($id);
            $save->update($posterData);

            if ($request->has("episodes")) {
                $episodeCount =  count($request->episodes);
                $episodesData = $request->episodes;
                $episodes = array();
                foreach ($episodesData as $key => $value) {
                    $episodes['title_en'] = $episodesData[$key]['title'];
                    $episodes['title_ch'] = $episodesData[$key]['title'];
                    $episodes['description_en'] = $episodesData[$key]['content'];
                    $episodes['description_ch'] = $episodesData[$key]['content'];
                    $episodes['cost'] = $episodesData[$key]['cost'];
                    $episodes['poster_id'] = $id;

                    if (empty($episodesData[$key]['id'])) {
                        $saveEpisode = Episode::create($episodes);
                    } else {
                        $saveEpisode = Episode::find(Crypt::decrypt($episodesData[$key]['id']));
                        if ($saveEpisode) {
                            $saveEpisode->update($episodes);
                        }
                    }
                    if ($saveEpisode) {

                        if (isset($episodesData[$key]['images']) && count($episodesData[$key]['images']) > 0) {
                            foreach ($episodesData[$key]['images'] as $imageKey => $imageValue) {
                                $file = $imageValue;
                                $episodeImage = uploadImage($saveEpisode, $file, $this->folder);
                            }
                        }
                    }
                }
            }


            // if ($request->hasFile('poster_image')) {
            //     if (isset($save->uploads->first()->path) && Storage::disk('public')->exists($save->uploads->first()->path)) {
            //         deleteFile($save->uploads->first()->id);
            //     }
            //     $file = $request->file('poster_image');
            //     uploadImage($save, $file, $this->folder);
            // }

            if ($request->hasFile('poster_image')) {
                $existingUpload = $save->uploads->first();
    
                if ($existingUpload && isset($existingUpload->path) && Storage::disk('public')->exists($existingUpload->path)) {
                    deleteFile($existingUpload->id);
                }
    
                $file = $request->file('poster_image');
                uploadImage($save, $file, $this->folder);
            }

            \DB::commit();
            return response()->json(['message' => trans("messages.update_success", ['module' => trans("global.post")]), 'alert-type' =>  'success'], 200);
        } catch (\Exception $e) {
            // dd($e->getMessage(). $e->getFile() . $e->getLine());
            \DB::rollback();
            return response()->json(['message' => trans("messages.something_went_wrong"), 'alert-type' =>  'error'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = Crypt::decrypt($id);
        \DB::beginTransaction();
        try {
            $delete = Poster::where('id', $id)->delete();
            if ($delete) {
                $deleteEpisode = Episode::where("poster_id", $id)->delete();
            }
            \DB::commit();
            //trans("messages.delete_success",['module' => trans("cruds.advertisement.title_singular")])
            return response()->json(['message' => trans("messages.delete_success", ['module' => trans("global.post")]), 'alert-type' =>  'success'], 200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['message' => trans("messages.something_went_wrong"), 'alert-type' =>  'error'], 500);
        }
    }

    public function updateStatus(Request $request)
    {

        $request['id'] = Crypt::decrypt($request->id);
        $validator = Validator::make($request->all(), [
            'id'  => 'required|exists:posters,id',
            'status' => 'required|in:1,0',
        ]);

        if ($validator->passes()) {
            $poster = Poster::find($request->id);
            if ($poster) {
                $poster->status = $request->status;
                $poster->save();
                return response()->json(['success' => true, 'message' =>  trans("messages.status_success", ['module' => trans("global.post")])], 200);
            }
        } else {
            return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray(), 'message' => trans("messages.error_occured")], 400);
        }
    }

    public function removeEpisode(Request $request)
    {
        try {
            $episodeId = Crypt::decryptString($request->episodeId);
            $episode = Episode::where("id", $episodeId)->delete();
            return response()->json(['success' => true, 'message' => 'Episode deleted successfulluy.!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'errors' => '', 'message' => 'Error Occured!'], 500);
        }
    }

    public function deleteEpisodeImage(Request $request)
    {
        $upload = Uploads::find($request->id);

        if ($upload && $upload->id == $request->id) {
            // Delete the image file from the server (assuming it's stored in public disk)
            if (Storage::disk('public')->exists($upload->path)) {
                Storage::disk('public')->delete($upload->path);
            }
            // Delete the upload record from the database
            $upload->delete();

            return response()->json(['message' => 'Image deleted successfully'], 200);
        }
        // If the upload record doesn't exist or doesn't belong to the episode, return an error
        return response()->json(['error' => 'Image not found or invalid episode'], 404);
    }
}
