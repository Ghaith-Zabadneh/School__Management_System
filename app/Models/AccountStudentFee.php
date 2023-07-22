<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountStudentFee extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'class_id',
         'year_id',
         'fee_category_id',
         'date',
         'amount'
     ];
     public function student(){
        return $this->belongsTo(User::class);
    }
    public function student_class(){
        return $this->belongsTo(StudentClass::class,'class_id','id');
    }
    public function student_year(){
        return $this->belongsTo(StudentYear::class,'year_id','id');
    }
    public function fee_category(){
        return $this->belongsTo(FeeCategory::class,'fee_category_id','id');
    }
}
