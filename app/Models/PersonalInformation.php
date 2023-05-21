<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class PersonalInformation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','father_name','mother_name','mobile','address','religion','gender','date_of_birth','join_date','designation_id','salary'
    ];
    protected $table = 'user_personal_informations';
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
