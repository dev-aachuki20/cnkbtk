<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\DataTables\AdvertisementDataTable;
use Storage;
use Validator;

class AdvertisementController extends Controller
{   
    public $folder;

    function __construct()
    {   
        $this->folder =  'advertisements';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdvertisementDataTable $dataTable)
    {
        return $dataTable->render('admin.advertisement.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.advertisement.create');
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
            'image_en' => ['required','mimes:jpg,png,jpeg,JPG,JPEG,PNG','max:1024'],
            'image_ch' => ['required','mimes:jpg,png,jpeg,JPG,JPEG,PNG','max:1024'],
            'url' => ['nullable','url'],
            'advertisement_type' => ['required','in:home_banner_image,home_banner_upper_img,home_banner_lower_img,notification_image'],
            'status' => ['required','in:0,1']
        ],[],[
            'image_en' => trans("cruds.advertisement.fields.image"),
            'image_ch'  => trans("cruds.advertisement.fields.image"),
            'url' => trans("cruds.advertisement.fields.url"),
            'advertisement_type' => trans("cruds.advertisement.fields.advertisement_type"),
            'status' => trans("cruds.global.status"),
        ]);
        
        $advertisement = new Advertisement;
        $advertisement->advertisement_type = $request->advertisement_type;
        $advertisement->url = $request->url;
        $advertisement->status = $request->status;
        if ($request->hasFile('image_en')) {
            $file = $request->file('image_en');
            $advertisement->image_en         = $file->store($this->folder, 'public');
        }


        if ($request->hasFile('image_ch')) {
            $file = $request->file('image_ch');
            $advertisement->image_ch         = $file->store($this->folder, 'public');
        }

        if($advertisement->save()){
            return redirect()->back()->with(['message' => trans("messages.add_success",['module' => trans("cruds.advertisement.title_singular")]),'alert-type' =>  'success']);
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
        $advertisement = Advertisement::findOrFail($id);
        return view("admin.advertisement.show",compact('advertisement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $advertisement = Advertisement::findOrFail($id);
        return view("admin.advertisement.edit",compact('advertisement'));
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
            'url' => ['nullable','url'],
            'advertisement_type' => ['required','in:home_banner_image,home_banner_upper_img,home_banner_lower_img,notification_image'],
            'status' => ['required','in:0,1']
        ],[],[
            'image_en' => trans("cruds.advertisement.fields.image"),
            'image_ch'  => trans("cruds.advertisement.fields.image"),
            'url' => trans("cruds.advertisement.fields.url"),
            'advertisement_type' => trans("cruds.advertisement.fields.advertisement_type"),
            'status' => trans("cruds.global.status"),
        ]);
       
        //$this->validate($request, $rules, $customMessages);
       
        $advertisement = Advertisement::findOrFail($id);
        $advertisement->advertisement_type = $request->advertisement_type;
        $advertisement->url = $request->url;
        $advertisement->status = $request->status;
        if ($request->hasFile('image_en')) {
            if (isset($advertisement->image_en) && Storage::disk('public')->exists($advertisement->image_en)) {
                \Storage::disk('public')->delete($advertisement->image_en);
            }

            $file = $request->file('image_en');
            $advertisement->image_en     = $file->store($this->folder, 'public');
        }


        if ($request->hasFile('image_ch')) {
            if (isset($advertisement->image_ch) && Storage::disk('public')->exists($advertisement->image_ch)) {
                \Storage::disk('public')->delete($advertisement->image_ch);
            }

            $file = $request->file('image_ch');
            $advertisement->image_ch         = $file->store($this->folder, 'public');


            $file = $request->file('image_ch');
            $advertisement->image_ch         = $file->store($this->folder, 'public');
        }

        if($advertisement->save()){ 
            return redirect()->back()->with(['message' => trans("messages.update_success",['module' => trans("cruds.advertisement.title_singular")]),'alert-type' =>  'success']);
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
    public function destroy(Request $request,Advertisement $advertisement)
    {
        if ($request->ajax()) {
            $advertisement->delete();
            $notification = array(
                'message' => trans("messages.delete_success",['module' => trans("cruds.advertisement.title_singular")]),
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
            'id'  => 'required|exists:advertisements,id',
            'status'   => 'required|in:1,0',
        ]);

        if ($validator->passes()) {
            $advertisement = Advertisement::find($request->id);
            if ($advertisement) {
                $advertisement->status = $request->status;
                $advertisement->save(); 
                return response()->json(['success' => true, 'message' => trans("messages.status_success"),['module' => trans("cruds.advertisement.title_singular")]], 200);
            }
        } else {
            return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray(), 'message' => trans("messages.error_occured")], 400);
        }
    }
}
