<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use App\Models\SchoolSubject;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class AssignSubjectControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=AssignSubject::select('class_id')->groupBy('class_id')->get();     
        return view('Backend.Setup.Assign_Subject.assign_view',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['subjects']=SchoolSubject::all();
        $data['classes']=StudentClass::all();
        return view('Backend.Setup.Assign_Subject.assign_add',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $count_subject= count($request->subject_id);
        if($count_subject){
            for($i=0;$i<$count_subject;$i++){
                AssignSubject::create([
                    'class_id'=>$request->class_id,
                    'subject_id'=>$request->subject_id[$i],
                    'full_mark'=>$request->full_mark[$i],
                    'pass_mark'=>$request->pass_mark[$i],
                    'subjective_mark'=>$request->subjective_mark[$i],
                ]);
            } //end for
        } //end if

        $notification = array(
            'message'=> 'Assign Subject Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('assign_sub.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data=AssignSubject::where('class_id',$id)->orderBy('subject_id', 'asc')->get();
        return view('Backend.Setup.Assign_Subject.assign_details',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['edit_data']=AssignSubject::where('class_id',$id)->orderBy('subject_id', 'asc')->get();
        $data['subjects']=SchoolSubject::all();
        $data['classes']=StudentClass::all();

        return view('Backend.Setup.Assign_Subject.assign_edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $count_subject= count($request->subject_id);
        AssignSubject::where('class_id',$id)->delete();
        if($count_subject){
            for($i=0;$i<$count_subject;$i++){
                AssignSubject::create([
                    'class_id'=>$request->class_id,
                    'subject_id'=>$request->subject_id[$i],
                    'full_mark'=>$request->full_mark[$i],
                    'pass_mark'=>$request->pass_mark[$i],
                    'subjective_mark'=>$request->subjective_mark[$i],
                ]);
            } //end for
        } //end if

        $notification = array(
            'message'=> 'Assign Subject Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('assign_sub.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        AssignSubject::where('class_id',$id)->delete();
        $notification = array(
            'message'=> 'Assign Subject Deleted Successfully',
            'alert-type' => 'info'
        );
        return back()->with($notification);
    }
}
