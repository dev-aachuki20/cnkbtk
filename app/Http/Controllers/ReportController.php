<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Report;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {  
        $id = $request->posterId;
        $view =  view('report.create',compact("id"))->render();
        return $view;
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
            'reason' => ['required','string','max:1000'],
            'description' => ['required','string'],
        ],[],[
            'reason' => trans("cruds.reports.fields.reason"),
            'description'  => trans("cruds.reports.fields.description"),
        ]);

        $report = new Report;
        $report->poster_id = Crypt::decrypt($request->poster_id);
        $poster = Poster::where("id",$report->poster_id)->first();
        if($poster->user_id == auth()->user()->id){
            return  response()->json(['message' => trans("messages.you_can_not_report_your_own_post")],403);
        }   
        $report->reason = $request->reason;
        $report->description = $request->description;
        $report->user_id = auth()->user()->id;
        $report->save();
        return  response()->json(['message' => trans("messages.add_success",['module' => trans("cruds.reports.title_singular")]),'alert-type' =>  'info']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    
}
