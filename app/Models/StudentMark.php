<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMark extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id','class_id','year_id','assign_subject_id','id_number' ,'exam_type_id','mark'
    ];
    public function user(){
        return $this->belongsTo(User::class,'student_id','id');
    }
}
