<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentClassesController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $student = DB::table('students')
            ->join('users', 'students.id', '=', 'users.id')
            ->where('students.name', $user->name)
            ->select('students.id')
            ->first();

        if ($student) {
            $classes = DB::table('class_enrollments')
                ->join('class_models', 'class_enrollments.class_id', '=', 'class_models.id')
                ->where('class_enrollments.student_id', $student->id)
                ->select('class_models.*')
                ->get();
        } else {
            $classes = [];
        }

        return view('students.classes', compact('classes'));
    }
}
