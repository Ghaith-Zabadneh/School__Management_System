<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\ExamType;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use App\Models\StudentYear;
use PDF;
use Illuminate\Http\Request;

class ExamFeeController extends Controller
{
    public function Exam_Fee_View(){

        $data['years']= StudentYear::all();
        $data['classes']= StudentClass::all();
        $data['exam_type']= ExamType::all();
        $data['all_data']= "";
        return view('Backend.Student.Exam_Fee.exam_fee_view',['data' => $data]);
    }

    public function Get_Student(Request $request){

        // Get all classes and years from the respective models
        $data['classes'] = StudentClass::all();
        $data['years'] = StudentYear::all();
        $data['exam_type']= ExamType::all();
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam = $request->exam;


        // Build the query conditions based on the provided year_id and class_id
        if ($year_id !='') {
            $where[] = ['year_id','like',$year_id.'%'];
        }
        if ($class_id !='') {
            $where[] = ['class_id','like',$class_id.'%'];
        }

        // Get all data with discounts based on the conditions
        $data['all_data'] = AssignStudent::with(['discount'])->where($where)->get();
        $students = [];
        
        // Iterate over the data and format it for the view
        foreach ($data['all_data'] as $key => $value) {
            $exam_fee = FeeCategoryAmount::where('fee_category_id','3')->where('class_id',$value->class_id)->first();
            $row = [];
            $row['SL'] = $key + 1;
            $row['ID_No'] = $value['student']['id_number'];
            $row['Student_Name'] = $value['student']['name'];
            $row['Roll_No'] = $value->roll;
            $row['Exam_Fee'] = $exam_fee->amount;
            $row['Discount'] = $value['discount']['discount'] == null ? '0%' : ($value['discount']['discount'].'%');

            $original_fee = $exam_fee->amount;
            $discount = $value['discount']['discount'];
            $discount_table_fee = $discount/100*$original_fee;
            $final_fee = (float)$original_fee-(float)$discount_table_fee;
            $row['Student_Fee'] = $final_fee . '$';
            $row['Student_id'] = $value->student_id;
            $row['Student_class'] = $value->class_id;
            $row['exam'] = $exam;

            $students[] = $row;
        }
        
        
        // Pass the data and students to the view for rendering
        return view('Backend.Student.Exam_Fee.exam_fee_view',[
            'data' => $data ,
            'students' => $students
        ]);
    }

    public function Print_PaySlip(Request $request){

        $data['details']=AssignStudent::with('student','discount')->where('student_id',$request->student_id)->where('class_id',$request->class_id)->first();
        $data['exam_fee']=FeeCategoryAmount::where('fee_category_id',2)->where('class_id',$request->class_id)->first();
        $original_fee = $data['exam_fee']->amount;
        $discount= $data['details']['discount']->discount;
        $data['exam_fee_with_discount']= (float)$original_fee-(float)($discount/100*$original_fee);
        $data['exam']=ExamType::where('id',$request->exam)->first()['name'];;
        $pdf = PDF::loadView('Backend.Student.Exam_Fee.exam_fee_PaySlip', compact('data'));
        return $pdf->stream('exam_PaySlip.pdf');
    
   }
}
