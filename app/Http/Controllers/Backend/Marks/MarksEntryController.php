<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\AssignSubject;
use App\Models\ExamType;
use App\Models\SchoolSubject;
use App\Models\StudentClass;
use App\Models\StudentMark;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class MarksEntryController extends Controller
{
    public function Marks_Add (){
        $data['classes']= StudentClass::all();
        $data['years'] = StudentYear::all();
        $data ['exams'] = ExamType::all();

        return view ('Backend.Marks.marks_entry',$data);
    }

    public function Marks_Get_Subject(Request $request){

        $data = AssignSubject::where('class_id',$request->class_id)->get();
        $subjects = [];
        foreach($data as $subject){
            $arr['id']= $subject->id;
            $arr['name']= $subject['school_subject']->name;
            $subjects [] =$arr;
        }
        return response()->json($subjects);
    }
    public function Marks_Get_Student(Request $request){

        $data = AssignStudent::where('year_id',$request->year_id)->where('class_id',$request->class_id)->get();
        $students = [];
        foreach($data as $student){
            $arr['student_id']= $student->student_id;
            $arr['id_number']= $student['student']->id_number;
            $arr['name']= $student['student']->name;
            $arr['gender']= $student['student']->personalInformation->gender;
            $students [] =$arr;
        }
        return response()->json($students);
    }

    public function Marks_store(Request $request){
        $student_count = $request->student_id;
        if($student_count){
            for($i =0; $i<count($request->student_id); $i++){
                StudentMark::create([
                    'student_id' => $request->student_id[$i],
                    'class_id' => $request->class_id,
                    'year_id' => $request->year_id,
                    'assign_subject_id' => $request->assign_subject_id,
                    'id_number' => $request->id_number[$i],
                    'exam_type_id' => $request->exam_type_id,
                    'mark' => $request->mark[$i]
                ]);
            }
            $notification = array(
                'message'=> 'Marks Inserted Successfully',
                'alert-type' => 'success',
            );
            return redirect()->route('marks.add')->with($notification);
        }
    }
    public function Marks_Edit (){
        $data['classes']= StudentClass::all();
        $data['years'] = StudentYear::all();
        $data ['exams'] = ExamType::all();
        $data['subjects']= SchoolSubject::all();

        return view ('Backend.Marks.marks_edit',$data);
    }
    public function Marks_Get_Edit_Student(Request $request){

        $student_marks = StudentMark::where('year_id',$request->year_id)
                                    ->where('class_id',$request->class_id)
                                    ->where('assign_subject_id',$request->assign_subject_id)
                                    ->where('exam_type_id',$request->exam_type_id)->get();

        $students = [];
        foreach($student_marks as $student){
            $arr['student_id']= $student->student_id;
            $arr['id_number']= $student['user']->id_number;
            $arr['name']= $student['user']->name;
            $arr['gender']= $student['user']->personalInformation->gender;
            $arr['mark']= $student->mark;
            $students [] =$arr;
        }

        return response()->json($students);

    }
    public function Marks_Update (Request $request){

        $old_marks = StudentMark::where('year_id',$request->year_id)
                                ->where('class_id',$request->class_id)
                                ->where('assign_subject_id',$request->assign_subject_id)
                                ->where('exam_type_id',$request->exam_type_id)->delete();

        $student_count = $request->student_id;
        if($student_count){
            for($i =0; $i<count($request->student_id); $i++){
                StudentMark::create([
                    'student_id' => $request->student_id[$i],
                    'class_id' => $request->class_id,
                    'year_id' => $request->year_id,
                    'assign_subject_id' => $request->assign_subject_id,
                    'id_number' => $request->id_number[$i],
                    'exam_type_id' => $request->exam_type_id,
                    'mark' => $request->mark[$i]
                ]);
            }
            $notification = array(
                'message'=> 'Marks Updated Successfully',
                'alert-type' => 'success',
            );
            return redirect()->route('marks.edit')->with($notification);
        }
    }

}
