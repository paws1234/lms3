<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentAnnouncementsController extends Controller
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
            $announcements = DB::table('announcements')
                ->join('class_models', 'announcements.class_id', '=', 'class_models.id')
                ->join('class_enrollments', 'class_models.id', '=', 'class_enrollments.class_id')
                ->where('class_enrollments.student_id', $student->id)
                ->select('announcements.*')
                ->get();
        } else {
            $announcements = [];
        }
    
        return view('students.announcements', compact('announcements'));
    }
    
}
