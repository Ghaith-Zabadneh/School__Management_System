<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use Illuminate\Http\Request;
use PDF;

class MonthlySalaryController extends Controller
{
    public function Monthly_Salary_View(){
        return view('Backend.Employee.Employee_Monthly_Salary.monthly_salary_view');
    }
    public function Get_Salary_Data (Request $request){
        $date = date('Y-m' , strtotime($request->date));
        
        $data = EmployeeAttendance::select('employee_id')->groupBy('employee_id')->with(['user'])->where('date','like', $date."%")->get();
        $students = [];
        foreach($data as $key => $attend){
            $total_attend=EmployeeAttendance::with(['user'])->where('date','like', $date."%")->where('employee_id',$attend->employee_id)->get();
            $absent_count= count($total_attend->where('attend_status','Absent'));
            $salary = $attend['user']->personalInformation->salary;
            $salary_per_day = (float)$salary/30;
            $discount_salary=(float)$absent_count *(float)$salary_per_day;
            $total_salary=(int)((float)$salary-(float)$discount_salary);
            $help_array['SL']= ++$key;
            $help_array['employee_id']= $attend->employee_id;
            $help_array['name']= $attend['user']->name;
            $help_array['salary']= $attend['user']->personalInformation->salary;
            $help_array['number_of_absent_day']= $absent_count;
            $help_array['total_salary']= $total_salary;
            $help_array['date']= $date;
            $students[] =$help_array;
        }  
        return response()->json($students);
    }
    public function Print_Salary_Data($employee_id , $date){
        $data=EmployeeAttendance::with(['user'])->where('date','like', $date."%")->where('employee_id',$employee_id)->get();
        $absent_count= count($data->where('attend_status','Absent'));
        $salary = $data['0']['user']->personalInformation->salary;
        $salary_per_day = (float)$salary/30;
        $discount_salary=(float)$absent_count *(float)$salary_per_day;
        $total_salary=(int)((float)$salary-(float)$discount_salary);
        $details['name']=$data['0']['user']->name;
        $details['salary']=$salary;
        $details['number_of_absent_day']= $absent_count;
        $details['month']=date('M-Y',strtotime($date));
        $details['total_salary']=$total_salary;

        $pdf = PDF::loadView('Backend.Employee.Employee_Monthly_Salary.monthly_salary_details', compact('details'));   
         return $pdf->stream('Employee_Salary_information.pdf');
        
        
    }
}
