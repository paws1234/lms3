<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Grade;
use App\Models\ClassMaterial;
use App\Models\ClassEnrollment;
use App\Models\Announcement;
use App\Models\SchoolCalendar;
use App\Models\ClassModel;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userName = $user->name;
        $classCount = ClassModel::join('teachers', 'class_models.teacher_id', '=', 'teachers.id')
            ->where('teachers.name', $userName)
            ->count();

        $userName = Auth::user()->name;
        $teacher = Teacher::where('name', $userName)->first();

        if ($teacher) {

            $quizCount = Quiz::where('teacher_id', $teacher->id)->count();
        } else {
            $quizCount = 0;
        }
        $gradeCount = Grade::join('teachers', 'grades.teacher_id', '=', 'teachers.id')
            ->where('teachers.name', $userName)
            ->count();

        $classMaterialCount = ClassMaterial::count();
        $classEnrollmentCount = ClassEnrollment::count();
        $userName = Auth::user()->name;
        $teacherId = Teacher::where('name', $userName)->value('id');
    
        if (!$teacherId) {
            return redirect()->route('teachers.dashboard')->with('error', 'Teacher not found for user: ' . $userName);
        }

        $announcementsCount= Announcement::where('teacher_id', $teacherId)->count();
        $schoolCalendars = SchoolCalendar::all();

        return view('teachers.dashboard', compact('quizCount', 'gradeCount', 'classMaterialCount', 'classEnrollmentCount', 'classCount', 'announcementsCount', 'schoolCalendars'));
    }


}