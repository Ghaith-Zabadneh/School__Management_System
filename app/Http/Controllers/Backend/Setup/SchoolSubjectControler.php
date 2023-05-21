<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\SchoolSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SchoolSubjectControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=SchoolSubject::all();    
        return view('Backend.Setup.School_Subject.subject_view',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.Setup.School_Subject.subject_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:school_subjects,name',       
        ]);
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }
 
        SchoolSubject::create([
            'name' => $request->name,
        ]);
        $notification = array(
            'message'=> 'Subject Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('subject.index')->with($notification); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = SchoolSubject::find($id);
        return view('Backend.Setup.School_Subject.subject_edit',compact('data'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:school_subjects,name',       
        ]);
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }
        

        SchoolSubject::findorFail($id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message'=> 'Class Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('subject.index')->with($notification); 
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        SchoolSubject::findorFail($id)->delete();
        $notification = array(
            'message'=> 'Class Deleted Successfully',
            'alert-type' => 'info'
        );
        return back()->with($notification);
    }
}
