<?php

namespace App\Http\Controllers\Backend\Accounts;

use App\Http\Controllers\Controller;
use App\Models\AccountStudentFee;
use App\Models\AssignStudent;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class StudentFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $data = AccountStudentFee::all();
       return view('Backend.Accounts.Student_Fee.student_fee_view',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['classes'] = StudentClass::all();
        $data['years'] = StudentYear::all();
        $data['fee_categories'] = FeeCategory::all();
        return view('Backend.Accounts.Student_Fee.student_fee_add',$data);
    }

    /**
     * Get Student Fee
     */
    public function show(string $id ,Request $request)
    {
       $year_id = $request->year_id;
       $class_id = $request->class_id;
       $fee_category = $request->fee_category_id;
       $date = date('M Y',strtotime($request->date));
       $data = AssignStudent::with(['discount'])->where('year_id',$year_id)->where('class_id',$class_id)->get();


       $students = [];
       foreach($data as $key => $student){
           $registration_fee=FeeCategoryAmount::where('fee_category_id',$fee_category)->where('class_id',$student->class_id)->first();
           $account_student_fee = AccountStudentFee::where('student_id',$student->student_id)
                                                    ->where('year_id',$student->year_id)
                                                    ->where('class_id',$student->class_id)
                                                    ->where('fee_category_id',$fee_category)
                                                    ->where('date',$date)->first();
           if($account_student_fee !=null) {
                $checked = 'checked';
            }else{
                $checked = '';
            }

           $original_fee = $registration_fee->amount;
           $discount = $student['discount']['discount'];
           $discountable_fee = $discount/100*$original_fee;
           $final_fee = (int)$original_fee-(int)$discountable_fee;

           $help_array['SL']= ++$key;
           $help_array['student_id']= $student->student_id;
           $help_array['id_number']= $student['student']->id_number;
           $help_array['name']= $student['student']->name;
           $help_array['year_id']= $student->year_id;
           $help_array['class_id']= $student->class_id;
           $help_array['fee_category_id']= $fee_category;
           $help_array['date']= $date;
           $help_array['f_name']= $student['student']->personalInformation->father_name;
           $help_array['orginal_fee']= $original_fee;
           $help_array['discount']= $discount;
           $help_array['final_fee']= $final_fee;
           $help_array['final_fee']= $final_fee;
           $help_array['key']= $key;
           $help_array['checked']= $checked;
           $students[] =$help_array;
       }
       return response()->json($students);
    }

     /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $date = $request->date;

         AccountStudentFee::where('student_id',$request->student_id)
                            ->where('year_id',$request->year_id)
                            ->where('class_id',$request->class_id)
                            ->where('fee_category_id',$request->fee_category_id)
                            ->where('date',$date)->delete();

        $check_data = $request->input('checkmanage', []);

        if($check_data != NULL){
            for($i=0;$i<count($check_data);$i++){
                $data=AccountStudentFee::create([
                    'student_id' => $request->student_id[$check_data[$i]],
                    'class_id' => $request->class_id,
                    'year_id' => $request->year_id,
                    'fee_category_id' => $request->fee_category_id,
                    'date' => $date,
                    'amount' => $request->amount[$check_data[$i]]
                ]);
            }
        }
        if( !empty($check_data) || !empty(@$data)){


            $notification = array(
                'message'=> 'Well Done Data Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('student_account.index')->with($notification);
        }else{

            $notification = array(
                'message'=> 'Sorry Data Not Saved',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
