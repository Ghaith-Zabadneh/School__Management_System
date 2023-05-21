<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\StudentYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class StudentYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=StudentYear::all();    
        return view('Backend.Setup.Year.year_view',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.Setup.Year.year_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:student_years,name',       
        ]);
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }
 
        StudentYear::create([
            'name' => $request->name,
        ]);
        $notification = array(
            'message'=> 'Year Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('year.index')->with($notification); 
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
        $data = StudentYear::find($id);
        return view('Backend.Setup.Year.year_edit',compact('data'));
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
        

        StudentYear::findorFail($id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message'=> 'Year Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('year.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        StudentYear::findorFail($id)->delete();
        $notification = array(
            'message'=> 'Year Deleted Successfully',
            'alert-type' => 'info'
        );
        return back()->with($notification);
    }
}
