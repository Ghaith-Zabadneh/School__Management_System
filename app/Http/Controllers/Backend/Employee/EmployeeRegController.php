<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Designation;
use App\Models\EmployeeSalaryLog;
use App\Models\User;
use App\Traits\Upload_Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PDF;

class EmployeeRegController extends Controller
{
    use Upload_Image;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['all_data']=User::where('user_type','Employee')->where('status','1')->get();
        return view ('Backend.Employee.Employee_Reg.employee_view',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['all_data']=Designation::all();
        return view ('Backend.Employee.Employee_Reg.employee_add',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $year_month = date('Ym',strtotime($request->join_date));
        $employee_id= generate_employee_id('users',$year_month);
        $code= rand(11111111,999999999); 
        $image = $this->employee_upload($request,$employee_id);
        DB::transaction(function () use ($request,$code,$employee_id,$image) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($code),
                'code' => $code,
                'user_type' => 'Employee',
                'id_number' => $employee_id,
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
                'join_date' => date('Y-m-d',strtotime($request->join_date)),
                'salary' => $request->salary,
                'designation_id' => $request->designation
            ]);
            $assign_student=EmployeeSalaryLog::create([
                'employee_id' => $user->id,
                'previous_salary' => $request->salary,
                'present_salary' => $request->salary,
                'increment_salary' => '0',
                'effective_salary' => date('Y-m-d',strtotime($request->join_date)),
            ]);
        });
        $notification = array(
            'message'=> 'Employee Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('em_reg.index')->with($notification) ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['designations']=Designation::all();
        $data['employee']=User::findOrFail($id);
        return view ('Backend.Employee.Employee_Reg.employee_edit',$data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::transaction(function () use ($request,$id){
            $user = User::where('id', $id)->first();
            $user->name=$request->name;
            $user->email=$request->email;
            if($request->file('image')){
                @unlink(public_path('upload/employees/'.$user->image));
                $image = $this->employee_upload($request,$user->id_number);
                $user->image =$image;
            }
            $user->personalInformation->father_name=$request->father_name;
            $user->personalInformation->mother_name=$request->mother_name;
            $user->personalInformation->mobile=$request->mobile;
            $user->personalInformation->address=$request->address;
            $user->personalInformation->gender=$request->gender;
            $user->personalInformation->date_of_birth=$request->date_of_birth;
            $user->personalInformation->designation_id=$request->designation;
            $user->personalInformation->save();
            $user->save();
            
        });
        $notification = array(
            'message'=> 'Employee Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('em_reg.index')->with($notification) ;
    }

    public function Print_PDF($id){
        
        $data=User::where('id',$id)->first();
        $pdf = PDF::loadView('Backend.Employee.Employee_Reg.employee_details', compact('data'));
        
         return $pdf->stream('Employee_information.pdf');
    }
}
