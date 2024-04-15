<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\DataTables\PlansDataTable;
use Illuminate\Validation\Rule;
use Validator;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PlansDataTable $dataTable)
    {
        return $dataTable->render('admin.plan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        abort(404);
        return view('admin.plan.create');
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
            'title_en' => ['required','max:100','unique:plans'],
            'title_ch' => ['required','max:100','unique:plans'],
            'points' => ['required','numeric'],
            'amount' => ['required','numeric'],
            'status' => ['required','in:0,1']
        ],[],[
            'title_en' => trans("cruds.plan.fields.title"),
            'title_ch'  => trans("cruds.plan.fields.title"),
        ]);


        $plan = new Plan;
        $plan->title_en = $request->title_en;
        $plan->title_ch = $request->title_ch;
        $plan->points = $request->points;
        $plan->amount = $request->amount;
        $plan->status = $request->status;
      
        if($plan->save()){
            return redirect()->back()->with(['message' => trans("messages.add_success",['module' => trans("cruds.plan.module")]),'alert-type' =>  'success']);
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
        $plan = Plan::findOrFail($id);
        return view("admin.plan.edit",compact('plan'));
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
            'title_en' => ['required','max:100',Rule::unique('plans')->ignore($id)],
            'title_ch' => ['required','max:100',Rule::unique('plans')->ignore($id)],
            'points' => ['required','numeric'],
            'amount' => ['required','numeric'],
            'status' => ['required','in:0,1']
        ],[],[
            'title_en' => trans("cruds.plan.fields.title"),
            'title_ch'  => trans("cruds.plan.fields.title"),
        ]);

        $plan = Plan::findOrFail($id);
        $plan->title_en = $request->title_en;
        $plan->title_ch = $request->title_ch;
        $plan->points = $request->points;
        $plan->amount = $request->amount;
        $plan->status = $request->status;

        if($plan->save()){
            return redirect()->back()->with(['message' => trans("messages.update_success",['module' => trans("cruds.plan.module")]),'alert-type' =>  'success']);
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
    public function destroy($id)
    {
        //
    }


    public function updateStatus(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'  => 'required|exists:plans,id',
            'status'   => 'required|in:1,0',
        ]);

        if ($validator->passes()) {
            $plan = Plan::find($request->id);
            if ($plan) {
                $plan->status = $request->status;
                $plan->save();
                return response()->json(['success' => true, 'message' =>  trans("messages.status_success",['module' => trans("cruds.plan.title_singular")])], 200);
            }
        } else {
            return response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray(), 'message' =>  trans("messages.error_occured")], 400);
        }
    }
}
