<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Grade;
use App\Models\SchoolCalendar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ClassMaterial as StudentClassMaterial;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $schoolCalendars = SchoolCalendar::all();
        $user = Auth::user();
        $student = DB::table('students')
            ->join('users', 'students.id', '=', 'users.id')
            ->where('students.name', $user->name)
            ->select('students.id')
            ->first();

        if ($student) {
            // Count the number of classes the student is enrolled in
            $classCount = DB::table('class_enrollments')
                ->join('class_models', 'class_enrollments.class_id', '=', 'class_models.id')
                ->where('class_enrollments.student_id', $student->id)
                ->count();

            // Count the number of announcements for classes the student is enrolled in
            $announcementsCount = DB::table('announcements')
                ->join('class_models', 'announcements.class_id', '=', 'class_models.id')
                ->join('class_enrollments', 'class_models.id', '=', 'class_enrollments.class_id')
                ->where('class_enrollments.student_id', $student->id)
                ->count();

            // Count the number of quizzes for classes the student is enrolled in
            $quizzesCount = DB::table('quizzes')
                ->join('class_models', 'quizzes.class_id', '=', 'class_models.id')
                ->join('class_enrollments', 'class_models.id', '=', 'class_enrollments.class_id')
                ->where('class_enrollments.student_id', $student->id)
                ->count();

            // Count the number of grades for quizzes the student has taken
            $gradesCount = DB::table('grades')
                ->join('quizzes', 'grades.quiz_id', '=', 'quizzes.id')
                ->join('class_models', 'quizzes.class_id', '=', 'class_models.id')
                ->join('class_enrollments', 'class_models.id', '=', 'class_enrollments.class_id')
                ->where('class_enrollments.student_id', $student->id)
                ->count();

            // Count the number of class materials for classes the student is enrolled in
            $classMaterialsCount = DB::table('class_materials')
                ->join('class_models', 'class_materials.class_id', '=', 'class_models.id')
                ->join('class_enrollments', 'class_models.id', '=', 'class_enrollments.class_id')
                ->where('class_enrollments.student_id', $student->id)
                ->count();
        } else {
            $classCount = 0;
            $announcementsCount = 0;
            $quizzesCount = 0;
            $gradesCount = 0;
            $classMaterialsCount = 0;
        }

        return view('students.dashboard', compact('classCount', 'schoolCalendars', 'gradesCount', 'quizzesCount', 'announcementsCount', 'classMaterialsCount'));
    }





}


