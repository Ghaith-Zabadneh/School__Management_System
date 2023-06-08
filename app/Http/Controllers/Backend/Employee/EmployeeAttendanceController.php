<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['all_data']= EmployeeAttendance::select('date')->groupBy('date')->orderBy('date','desc')->get();
        return view ('Backend/Employee/Employee_Attendance/employee_attendance_view',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['employees']= User::where('user_type', 'employee')->where('status','1')->get();
        return view ('Backend/Employee/Employee_Attendance/employee_attendance_add',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        for($i=0;$i<count($request->employee_id);$i++){
           $attend_status='attend_status'.$i;
           EmployeeAttendance::create([
            'date' => $request->date,
            'employee_id' => $request->employee_id[$i],
            'attend_status' => $request->$attend_status
           ]);
        }
        $notification = array(
            'message'=> 'Attendance Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('attendance.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $date)
    {
        $data['details']=EmployeeAttendance::where('date' ,$date)->get();
        return view ('Backend/Employee/Employee_Attendance/employee_attendance_details',$data);
    }
   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $date)
    {
        $data['edit_data']=EmployeeAttendance::where('date' ,$date)->get();
        return view ('Backend/Employee/Employee_Attendance/employee_attendance_edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $date)
    {
        EmployeeAttendance::where('date' , date('Y-m-d',strtotime($date)))->delete();
        for($i=0;$i<count($request->employee_id);$i++){
            $attend_status='attend_status'.$i;
            EmployeeAttendance::create([
             'date' => $request->date,
             'employee_id' => $request->employee_id[$i],
             'attend_status' => $request->$attend_status
            ]);
         }
         $notification = array(
             'message'=> 'Attendance Updated Successfully',
             'alert-type' => 'success'
         );
         return redirect()->route('attendance.index')->with($notification);
    }

}
