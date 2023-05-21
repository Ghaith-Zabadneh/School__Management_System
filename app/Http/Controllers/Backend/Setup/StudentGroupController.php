<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=StudentGroup::all();    
        return view('Backend.Setup.Group.group_view',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.Setup.Group.group_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:student_groups,name',       
        ]);
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }
 
        StudentGroup::create([
            'name' => $request->name,
        ]);
        $notification = array(
            'message'=> 'Group Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('group.index')->with($notification); 
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
        $data = StudentGroup::find($id);
        return view('Backend.Setup.Group.group_edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:student_groups,name',       
        ]);
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }
        

        StudentGroup::findorFail($id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message'=> 'Group Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('Group.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        StudentGroup::findorFail($id)->delete();
        $notification = array(
            'message'=> 'Group Deleted Successfully',
            'alert-type' => 'info'
        );
        return back()->with($notification);
    }
}
