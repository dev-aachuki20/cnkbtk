<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Storage;


class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $folder;

    function __construct()
    {
        $this->folder =  'uploads';
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $settings = Setting::where('status',1)->get();
       
        $basic_details  = $settings->where("detail_type",config("constant.setting_type.basic_details"));
        $footer_details  = $settings->where("detail_type",config("constant.setting_type.footer_details"));
        $social_details  = $settings->where("detail_type",config("constant.setting_type.social_links"));
        return view('admin.setting.create',compact('basic_details','footer_details','social_details'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
      
        foreach($request->settings as $key =>$val){
            if($val['type'] != 'file'){
                $setting = Setting::findOrFail($val['id']);
                $setting->value = $val['value'];
                $setting->save();
            }
            if($val['type'] == 'file' && array_key_exists("value",$val)){
                $setting = Setting::findOrFail($val['id']);
                if(!is_null($setting->value)){
                    Storage::disk('public')->delete($setting->value);
                }
                $file = $val['value'];
                $path = $file->store($this->folder, 'public');
               
                $setting->value = $path;
                $setting->save();
            }
        }
        $notification = array(
            'message' => 'Site Setting has been updated successfully!',
            'alert-type' =>'success' 
        );
    
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
