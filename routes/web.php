<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\Accounts\StudentFeeController;
use App\Http\Controllers\Backend\Employee\EmployeeAttendanceController;
use App\Http\Controllers\Backend\Employee\EmployeeLeaveController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Setup\AssignSubjectControler;
use App\Http\Controllers\Backend\Setup\DesignationControler;
use App\Http\Controllers\Backend\Setup\ExamTypeController;
use App\Http\Controllers\Backend\Setup\FeeAmountController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\SchoolSubjectControler;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\Student\ExamFeeController;
use App\Http\Controllers\Backend\Student\MonthlyFeeController;
use App\Http\Controllers\Backend\Student\RegistrationFeeController;
use App\Http\Controllers\Backend\Student\RollGeneratorController;
use App\Http\Controllers\Backend\Student\StudentRegController;
use App\Http\Controllers\Backend\Employee\EmployeeRegController;
use App\Http\Controllers\Backend\Employee\EmployeeSalaryController;
use App\Http\Controllers\Backend\Employee\MonthlySalaryController;
use App\Http\Controllers\Backend\Marks\MarksEntryController;
use App\Http\Controllers\Backend\Marks\MarksGradeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {


    Route::get('/dashboard', function () { return view('admin.index');})->name('dashboard');
    // User Controller Route
    Route::resource('users', UserController::class);
    Route::get('/del/{id}',[UserController::class,'destroy'])->name('user.del');
    // Profile Controller Route
    Route::prefix('Profile')->group(function () {
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/view', 'Profile_View')->name('profile.view');
            Route::get('/edit', 'Profile_Edit')->name('profile.edit');
            Route::post('/edit/{id}', 'Profile_Update')->name('profile.update');
            Route::get('/password', 'Password_View')->name('profile.password.view');
            Route::post('/password/{id}', 'Password_Stor')->name('profile.password.stor');
        }); //End controller group
    });// End prefix group
    // Setup Management route
    Route::prefix('setup')->group(function () {
        //Setup Class
        Route::resource('class', StudentClassController::class)->except('destroy');
        Route::get('/classdel/{id}',[StudentClassController::class,'destroy'])->name('class.del');
        //Setup Group
        Route::resource('group', StudentGroupController::class)->except('destroy');
        Route::get('/groupdel/{id}',[StudentGroupController::class,'destroy'])->name('group.del');
        //Setup Year
        Route::resource('year', StudentYearController::class)->except('destroy');
        Route::get('/yeardel/{id}',[StudentYearController::class,'destroy'])->name('year.del');
        //Setup Shift
        Route::resource('shift', StudentShiftController::class)->except('destroy');;
        Route::get('/shiftdel/{id}',[StudentShiftController::class,'destroy'])->name('shift.del');
        //Setup Fee Category
        Route::resource('feecat', FeeCategoryController::class)->except('destroy');
        Route::get('/feedel/{id}',[FeeCategoryController::class,'destroy'])->name('fee.del');
        //Setup Fee Amount
        Route::resource('feeam', FeeAmountController::class)->except('destroy');
        Route::get('/feeamdel/{id}',[FeeAmountController::class,'destroy'])->name('feeam.del');
        //Setup Exam
        Route::resource('exam', ExamTypeController::class)->except('destroy');
        Route::get('/examdel/{id}',[ExamTypeController::class,'destroy'])->name('exam.del');
        //Setup Subject
        Route::resource('subject', SchoolSubjectControler::class)->except('destroy');
        Route::get('/subjectdel/{id}',[SchoolSubjectControler::class,'destroy'])->name('subject.del');
        //Setup Assign Subject
        Route::resource('assign_sub', AssignSubjectControler::class)->except('destroy');
        Route::get('/assign_sub_del/{id}',[AssignSubjectControler::class,'destroy'])->name('assign_sub.del');
        //Setup Designation
        Route::resource('designation', DesignationControler::class)->except('destroy');
        Route::get('/designation_del/{id}',[DesignationControler::class,'destroy'])->name('designation.del');
    });
    // Setup Management route
    Route::prefix('student')->group(function () {
        // Student Registration
        Route::resource('reg', StudentRegController::class)->except('destroy');
        Route::get('/reg/search',[StudentRegController::class,'show'])->name('reg.search');
        Route::get('/reg/promotion/edit/{id}',[StudentRegController::class,'Promotion_Edit'])->name('reg.promotion.edit');
        Route::post('/reg/promotion/stor/{id}',[StudentRegController::class,'Promotion_Stor'])->name('reg.promotion.stor');
        Route::get('/details/pdf/{id}',[StudentRegController::class,'Print_PDF'])->name('Student.pdf');
        // Roll Generator
        Route::resource('roll', RollGeneratorController::class)->only([
            'index', 'show','store'
        ]);
        Route::get('/rol/show/',[RollGeneratorController::class,'show'])->name('roll.get_student');

        // Registration Fee
        Route::controller(RegistrationFeeController::class)->group(function () {
            Route::get('reg/fee/view', 'Registration_Fee_View')->name('reg_fee.view');
            Route::get('reg/fee/search', 'Get_Student')->name('reg.fee.search');
            Route::get('reg/fee/PaySlip', 'Print_PaySlip')->name('reg.fee.PaySlip');
        }); //End controller group

        // Monthly Fee
        Route::controller(MonthlyFeeController::class)->group(function () {
            Route::get('month/fee/view', 'Monthly_Fee_View')->name('month_fee.view');
            Route::get('month/fee/search', 'Get_Student')->name('month.fee.search');
            Route::get('month/fee/PaySlip', 'Print_PaySlip')->name('month.fee.PaySlip');
        }); //End controller group

         // Exam Fee
         Route::controller(ExamFeeController::class)->group(function () {
            Route::get('exam/fee/view', 'Exam_Fee_View')->name('exam_fee.view');
            Route::get('exam/fee/search', 'Get_Student')->name('exam.fee.search');
            Route::get('exam/fee/PaySlip', 'Print_PaySlip')->name('exam.fee.PaySlip');
        }); //End controller group

    }); //End Student Prefix
    Route::prefix('employee')->group(function () {
        // Employee Registration
        Route::resource('em_reg', EmployeeRegController::class)->except(['destroy','show']);
        Route::get('/details/pdf/{id}',[EmployeeRegController::class,'Print_PDF'])->name('employee.pdf');

        // Employee Salary
        Route::resource('salary', EmployeeSalaryController::class)->only(['index','edit','update','show']);

        // Leave Employee
        Route::resource('leave', EmployeeLeaveController::class)->except(['destroy','show']);
        Route::get('/rehiring/{id}',[EmployeeLeaveController::class,'Return_Employee'])->name('leave.rehiring');

        // Employee Attendance
        Route::resource('attendance', EmployeeAttendanceController::class)->except('destroy');

        // Employee Monthly Salary
        Route::controller(MonthlySalaryController::class)->group(function () {
            Route::get('month/salary/view', 'Monthly_Salary_View')->name('month_salary.view');
            Route::get('month/salary/search', 'Get_Salary_Data')->name('month.salary.search');
            Route::get('month/salary/print/{employee_id}/{date}', 'Print_Salary_Data')->name('month.salary.print');

        }); //End controller group
    });

    Route::prefix('marks')->group(function () {
        // Marks Entry
        Route::get('/add', [MarksEntryController::class, 'Marks_Add'])->name('marks.add');
        Route::get('/get/subject', [MarksEntryController::class, 'Marks_Get_Subject'])->name('marks.get_subject');
        Route::get('/get/student', [MarksEntryController::class, 'Marks_Get_Student'])->name('marks.get_student');
        Route::post('/store', [MarksEntryController::class, 'Marks_store'])->name('marks.store');
        Route::get('/edit', [MarksEntryController::class, 'Marks_Edit'])->name('marks.edit');
        Route::get('/get/edit/student', [MarksEntryController::class, 'Marks_Get_Edit_Student'])->name('marks.get_edit_student');
        Route::post('/update', [MarksEntryController::class, 'Marks_Update'])->name('marks.update');
        Route::resource('grade', MarksGradeController::class)->except(['destroy','show']);


    });

    Route::prefix('accounts')->group(function () {
        // Student Fee
        Route::resource('student_account', StudentFeeController::class)->except('destroy');


    });
});


Route::controller(AdminController::class)->group(function () {
    Route::get('/logout', 'logout')->name('user_logout');

});


