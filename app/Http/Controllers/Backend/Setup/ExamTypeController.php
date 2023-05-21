<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\ExamType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExamTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=ExamType::all();    
        return view('Backend.Setup.Exam_Type.exam_view',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Backend.Setup.Exam_Type.exam_add');   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:exam_types,name',       
        ]);
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }
 
        ExamType::create([
            'name' => $request->name,
        ]);
        $notification = array(
            'message'=> 'Exam Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('exam.index')->with($notification); 
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
        $data = ExamType::find($id);
        return view('Backend.Setup.Exam_Type.exam_edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:exam_types,name',       
        ]);
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator);
        }
        

        ExamType::findorFail($id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message'=> 'Class Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('exam.index')->with($notification); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ExamType::findorFail($id)->delete();
        $notification = array(
            'message'=> 'Class Deleted Successfully',
            'alert-type' => 'info'
        );
        return back()->with($notification);
    }
}
