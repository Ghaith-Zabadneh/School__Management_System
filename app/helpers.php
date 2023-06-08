<?php
use Illuminate\Support\Facades\DB;

if (! function_exists('generate_student_id')) {
    function generate_student_id($table_name,$year) {
        $current_year = $year;
        $last_id = DB::table($table_name)->where('user_type','Student')->orderBy('id', 'desc')->first();
       

        if ($last_id) {
            $last_id = substr($last_id->id_number, 4);
            //dd(substr($last_id->id_number,0, 4));
            $new_id = $current_year . sprintf('%04d', intval($last_id) + 1);
        } else {
            $new_id = $current_year . '0001';
        }

        return $new_id;
    }
}
if (! function_exists('generate_employee_id')) {
    function generate_employee_id($table_name,$year_month) {
        $last_id = DB::table($table_name)->where('user_type','Employee')->orderBy('id', 'desc')->first();
        if ($last_id) {
            $last_id = substr($last_id->id_number, 6);
            $new_id = $year_month . sprintf('%04d', intval($last_id) + 1);
        } else {
            $new_id = $year_month . '0001';
        }
        return $new_id;
    }
}

