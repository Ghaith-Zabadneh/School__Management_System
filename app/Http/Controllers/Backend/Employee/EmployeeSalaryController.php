<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeSalaryLog;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['employees']=User::where('user_type', 'Employee')->where('status','1')->get();
        return view('Backend.Employee.Employee_Salary.employee_salary_view',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['employee_data']=User::findOrFail($id);
        return view('Backend.Employee.Employee_Salary.employee_salary_increment',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = User::findOrFail($id);
        $pervious_salary = $employee->personalInformation->salary;
        $present_salary = (float)($pervious_salary)+(float)($request->increment_salary);
        $employee->personalInformation->salary=$present_salary ;
        $employee->personalInformation->save();
        $salary_data = EmployeeSalaryLog::create([
            'employee_id' => $id,
            'previous_salary' => $pervious_salary,
            'present_salary' => $present_salary,
            'increment_salary' => $request->increment_salary,
            'effective_salary' => date('Y-m-d',strtotime($request->effective_salary)),
        ]);

        $notification = array(
            'message'=> 'Employee Salary Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('salary.index')->with($notification) ;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['employee'] = User::findOrFail($id);
        $data['salary_data'] =EmployeeSalaryLog::where('employee_id', $id)->orderBy('effective_salary','desc')->get();
        return view('Backend.Employee.Employee_Salary.employee_salary_details',$data);
    }

}
