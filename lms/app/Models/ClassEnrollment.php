<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassEnrollment extends Model
{
    use HasFactory;
    protected $fillable = ['class_id','student_id','teacher_id'];
    public function classModel()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
    


}
