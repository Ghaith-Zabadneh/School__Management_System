<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class RollGeneratorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        return view('Backend.Student.Roll_Generator.roll_generator_view',$data);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->student_id){
            for($i=0;$i<count($request->student_id);$i++){
                AssignStudent::where('student_id',$request->student_id[$i])->update(['roll' => $request->roll[$i]]);
            }

            $notification = array(
                'message'=> 'Roll Inserted Successfully',
                'alert-type' => 'success'
            );

        }else{
            $notification = array(
                'message'=> 'Sorry there are no students',
                'alert-type' => 'success'
            );
        }
        return redirect()->route('roll.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
      $data = AssignStudent::with('student')->where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
      $students = [];
      foreach($data as $student){
        $help_array=[];
        $help_array['student_id']= $student->student_id;
        $help_array['id_number']= $student['student']->id_number;
        $help_array['name']= $student['student']->name;
        $help_array['father_name']= $student['student']->personalInformation->father_name;
        $help_array['gender']= $student['student']->personalInformation->gender;
        $help_array['roll']= $student->roll;
        $students[] =$help_array;
      }  
      return response()->json($students);
      
    }
}
