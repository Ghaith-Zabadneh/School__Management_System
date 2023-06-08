<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeLeave;
use App\Models\LeavePurpose;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['employees'] = EmployeeLeave::orderBy('id','desc')->get();
        return view('Backend.Employee.Employee_Leave.employee_leave_view',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $all_employees = User::where('user_type', 'Employee')->where('status','1')->get();
        $data['employees'] = [];
        foreach($all_employees as $value){
            $help_array = [];
            $help_array['id']=$value->id;
            $help_array['name']=$value->name;
            $help_array['start_date']=$value->personalInformation->join_date;
            $data['employees'][]=$help_array;
        }
        $data['purposes'] = LeavePurpose::all();
        return view('Backend.Employee.Employee_Leave.employee_leave_add',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->purpose == '0'){
            $leave_purpose = new LeavePurpose();
            $leave_purpose->name = $request->name;
            $leave_purpose->save();
            $leave_purpose_id= $leave_purpose->id;
        }else{
            $leave_purpose_id = $request->purpose;
        }
      
        EmployeeLeave::create([
            'employee_id' => $request->employee_id,
            'leave_purpose_id' => $leave_purpose_id,
            'start_date' => date('Y-m-d',strtotime($request->start_date)),
            'end_date' => date('Y-m-d',strtotime($request->end_date))
        ]);
        User::find($request->employee_id)->update([
            'status' => '0'
        ]);

        $notification = array(
            'message'=> 'Employee Leave Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('leave.index')->with($notification);
    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['edit_data'] = EmployeeLeave::findOrFail($id)->first();
        $data['purposes'] = LeavePurpose::all();
        $all_employees = User::where('user_type', 'Employee')->get();
        $data['employees'] = [];
        foreach($all_employees as $value){
            $help_array = [];
            $help_array['id']=$value->id;
            $help_array['name']=$value->name;
            $help_array['start_date']=$value->personalInformation->join_date;
            $data['employees'][]=$help_array;
        }
        
        return view('Backend.Employee.Employee_Leave.employee_leave_edit',$data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->purpose == '0'){
            $leave_purpose = new LeavePurpose();
            $leave_purpose->name = $request->name;
            $leave_purpose->save();
            $leave_purpose_id= $leave_purpose->id;
        }else{
            $leave_purpose_id = $request->purpose;
        }
      
        EmployeeLeave::find($id)->update([
            'leave_purpose_id' => $leave_purpose_id,
            'end_date' => date('Y-m-d',strtotime($request->end_date))
        ]);

        $notification = array(
            'message'=> 'Employee Leave Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('leave.index')->with($notification);
    }

    public function Return_Employee(string $id){
        $employee=EmployeeLeave::findOrFail($id)->first();
        $employee_id = $employee->employee_id;
        $employee->delete();
        User::findOrFail($employee_id)->update([
            'status' => '1'
        ]);
        $notification = array(
            'message'=> 'Employee Returned Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('leave.index')->with($notification);
    }
}
