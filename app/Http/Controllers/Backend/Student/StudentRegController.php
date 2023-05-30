<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\StudentYear;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStudentRequest;
use App\Models\DiscountStudent;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Traits\Upload_Image;
use Illuminate\Support\Facades\Redis;
use PDF;

class StudentRegController extends Controller
{
    use Upload_Image;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['classes'] = StudentClass::all();
        $data['years'] = StudentYear::all();
        $data['year_id'] = StudentYear::orderby('id', 'desc')->first()->id;
        $data['class_id'] = "";
        $data['all_data']= AssignStudent::where('year_id', '=', $data['year_id'])->get();
        
        return view('Backend.Student.Student_Reg.student_view',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['classes'] = StudentClass::all();
        $data['years'] = StudentYear::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts']= StudentShift::all();
        return view('Backend.Student.Student_Reg.student_add',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $year = StudentYear::find($request->year_id);
        $student_id= generate_student_id('users',$year->name);
        $code= rand(11111111,999999999); 
        $image = $this->upload($request,$student_id);
        DB::transaction(function () use ($request,$code,$student_id,$image) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($code),
                'code' => $code,
                'user_type' => 'Student',
                'id_number' => $student_id,
                'image' => $image,                
            ]);     
            $user->personalInformation()->create([
                'user_id' => $user->id,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'gender' => $request->gender,
                'date_of_birth' => date('Y-m-d',strtotime($request->date_of_birth)),
            ]);
            $assign_student=AssignStudent::create([
                'student_id' => $user->id,
                'class_id' => $request->class_id,
                'year_id' => $request->year_id,
                'group_id' => $request->group_id,
                'shift_id' => $request->shift_id,
            ]);
            $discount=DiscountStudent::create([
                'assign_student_id'=> $assign_student->id,
                'fee_category_id' => 1,
                'discount' =>$request->discount

            ]);
        });
        $notification = array(
            'message'=> 'Student Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('reg.index')->with($notification) ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $data['classes'] = StudentClass::all();
        $data['years'] = StudentYear::all();
        $data['year_id'] = $request->year_id;
        if($request->class_id){
            $data['all_data']= AssignStudent::where('year_id', '=', $request->year_id)->where('class_id','=',$request->class_id)->get();
            $data['class_id'] = $request->class_id;
        }else{
            $data['all_data']= AssignStudent::where('year_id', '=', $request->year_id)->get();
            $data['class_id'] = "";
        }  
              
        return view('Backend.Student.Student_Reg.student_view',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['classes'] = StudentClass::all();
        $data['years'] = StudentYear::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts']= StudentShift::all();
        $data['edit_data']=AssignStudent::with('student','discount')->where('student_id',$id)->first();
        return view('Backend.Student.Student_Reg.student_edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $student_id)
    {
        DB::transaction(function () use ($request,$student_id){
            $user = User::where('id', $student_id)->first();
            $user->name=$request->name;
            $user->email=$request->email;
            if($request->file('image')){
                @unlink(public_path('upload/users/'.$user->image));
                $image = $this->upload($request,$user->id_number);
                $user->image =$image;
            }
            $user->personalInformation->father_name=$request->father_name;
            $user->personalInformation->mother_name=$request->mother_name;
            $user->personalInformation->mobile=$request->mobile;
            $user->personalInformation->address=$request->address;
            $user->personalInformation->gender=$request->gender;
            $user->personalInformation->date_of_birth=$request->date_of_birth;
            $user->personalInformation->save();
            $user->save();
            $assign_student=AssignStudent::where('id',$request->id)->first();
            $assign_student->year_id=$request->year_id;
            $assign_student->class_id=$request->class_id;
            $assign_student->group_id=$request->group_id;
            $assign_student->shift_id=$request->shift_id;
            $assign_student->save();
            $discount=DiscountStudent::where('assign_student_id',$request->id)->first();
            $discount->discount=$request->discount;
            $discount->save();
        });
        $notification = array(
            'message'=> 'Student Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('reg.index')->with($notification) ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function Promotion_Edit ($id){

        $data['classes'] = StudentClass::all();
        $data['years'] = StudentYear::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts']= StudentShift::all();
        $data['edit_data']=AssignStudent::with('student','discount')->where('student_id',$id)->first();
        return view('Backend.Student.Student_Reg.student_promotion',compact('data'));
    }

    public function Promotion_Stor (Request $request, $student_id){
        DB::transaction(function () use ($request,$student_id){
            $assign_student=AssignStudent::create([
                'student_id' => $student_id,
                'year_id' => $request->year_id,
                'class_id' => $request->class_id,
                'group_id' => $request->group_id,
                'shift_id' => $request->shift_id
            ]);
            $discount=DiscountStudent::create([
                'assign_student_id' => $assign_student->id,
                'fee_category_id' => 1,
                'discount' => $request->discount

            ]);

        });
        $notification = array(
            'message'=> 'Student Promotion Updated Successfully',
            'alert-type' => 'success'
        );
        
        return redirect()->route('reg.index')->with($notification) ;
    }

    public function Print_PDF($student_id){
        
        $data['details']=AssignStudent::with('student','discount')->where('student_id',$student_id)->first();

         $pdf = PDF::loadView('Backend.Student.Student_Reg.student_details', compact('data'));
        
         return $pdf->stream('student_information.pdf');
    }
}
