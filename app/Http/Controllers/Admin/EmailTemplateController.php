<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\EmailTemplateDataTable;
use App\Models\EmailTemplate;
use Validator;

class EmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EmailTemplateDataTable $dataTable)
    {
        return $dataTable->render('admin.email-template.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.email-template.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'subject' => 'required',
            'email_body' => 'required',
        ],[],[
            'name' => trans("cruds.email_template.fields.name"),
            'subject'  => trans("cruds.email_template.fields.subject"),
            'email_body' => trans("cruds.advertisement.fields.email_body")
        ]);
        $inputs = $request->all();
        $emailTemp = EmailTemplate::create($inputs);
        $notification = array(
            'message' => trans("messages.add_success",['module' => trans("cruds.email_template.title_singular")]),
            'alert-type' =>'success' 
        );
    
        return redirect()->route('admin.email-templates.index')->with($notification);
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
        $emailTemp = EmailTemplate::findOrFail($id);
        return view('admin.email-template.edit',compact('emailTemp'));
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
        $request->validate([
            'name' => 'required',
            'subject' => 'required',
            'email_body' => 'required',
        ],[],[
            'name' => trans("cruds.email_template.fields.name"),
            'subject'  => trans("cruds.email_template.fields.subject"),
            'email_body' => trans("cruds.advertisement.fields.email_body")
        ]);
        $inputs = $request->all();
        $email_template = EmailTemplate::findOrFail($id);
        $email_template->update($inputs);
        $notification = array(
            'message' => trans("messages.update_success",['module' => trans("cruds.email_template.title_singular")]),
            'alert-type' =>'success' 
        );
    
        return redirect()->route('admin.email-templates.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $validator = Validator::make($request->all(), [
        //     'emailTempId'  => 'required|exists:email_templates,id',
        //     'status'   => 'required|in:1,0',
        // ]);
        // if ($validator->passes()) {
        //     $emailTemp = EmailTemplate::find($request->emailTempId);
        //     if ($emailTemp) {
        //         $emailTemp->status = $request->status;
        //         $emailTemp->save();
        //         return response()->json(['success' => true, 'message' => 'Status has been changed successfully!'], 200);
        //     }
        // } else {
        //     return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray(), 'message' => 'Error Occured!'], 400);
        // }
    }
}
