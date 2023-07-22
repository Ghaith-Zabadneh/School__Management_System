<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use App\Models\MarksGrade;
use Illuminate\Http\Request;

class MarksGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = MarksGrade::all();
        return view ('Backend.Marks.marks_grade_view', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('Backend.Marks.marks_grade_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       MarksGrade::create([
        'grade_name' => $request->grade_name ,
        'grade_point' => $request->grade_point ,
        'start_mark' => $request->start_mark,
        'end_mark' => $request->end_mark ,
        'start_point' => $request->start_point,
        'end_point' => $request->end_point,
        'remark' => $request->remark
       ]);
       $notification = array(
        'message'=> 'Grade Inserted Successfully',
        'alert-type' => 'success'
    );

    return redirect()->route('grade.index')->with($notification) ;

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = MarksGrade::findOrFail($id);
        return view ('Backend.Marks.marks_grade_edit', compact('data'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        MarksGrade::findOrFail($id)->update([
            'grade_name' => $request->grade_name ,
            'grade_point' => $request->grade_point ,
            'start_mark' => $request->start_mark,
            'end_mark' => $request->end_mark ,
            'start_point' => $request->start_point,
            'end_point' => $request->end_point,
            'remark' => $request->remark
        ]);

        $notification = array(
            'message'=> 'Grade Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('grade.index')->with($notification);
    }


}
