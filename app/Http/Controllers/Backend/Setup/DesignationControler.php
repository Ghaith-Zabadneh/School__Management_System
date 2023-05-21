<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DesignationControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=Designation::all();    
        return view('Backend.Setup.Designation.designation_view',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.Setup.Designation.designation_add'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:designations,name',       
        ]);
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }
 
        Designation::create([
            'name' => $request->name,
        ]);
        $notification = array(
            'message'=> 'Designation Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('designation.index')->with($notification); 
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
        $data = Designation::find($id);
        return view('Backend.Setup.Designation.designation_edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:designations,name',       
        ]);
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }
        

        Designation::findorFail($id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message'=> 'Designation Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('designation.index')->with($notification); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Designation::findorFail($id)->delete();
        $notification = array(
            'message'=> 'Designation Deleted Successfully',
            'alert-type' => 'info'
        );
        return back()->with($notification);
    }
}
