<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Quiz;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GradesController extends Controller
{
    public function index()
    {
        $userName = Auth::user()->name;
        $teacher = Teacher::where('name', $userName)->first();

        if ($teacher) {
            $teacherId = $teacher->id;
            $grades = Grade::where('teacher_id', $teacherId)->get();

            return view('grades.index', compact('grades'));
        } else {
            return redirect()->route('home')->with('error', 'Teacher not found for user: ' . $userName);
        }
    }

    public function create()
    {
        $userName = Auth::user()->name;
        $teacherId = DB::table('users')
            ->join('teachers', function ($join) {
                $join->on('users.name', '=', 'teachers.name')
                    ->whereColumn('users.id', '!=', 'teachers.id');
            })
            ->where('users.name', $userName)
            ->pluck('teachers.id');
    
        if ($teacherId->isEmpty()) {
            return redirect()->route('home')->with('error', 'Teacher not found for user: ' . $userName);
        }
    

        $quizzes = Quiz::where('teacher_id', $teacherId)->get();
            $students = DB::table('class_enrollments')
            ->join('students', 'class_enrollments.student_id', '=', 'students.id')
            ->where('class_enrollments.teacher_id', $teacherId)
            ->select('students.id', 'students.name') 
            ->get();
    
        $teachers = Teacher::pluck('name', 'id');
    
        return view('grades.create', compact('students', 'quizzes', 'teachers'));
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'score' => 'required|numeric|min:0|max:100',
            'student_id' => 'required|exists:class_enrollments,student_id',
            'quiz_id' => 'required|exists:quizzes,id',
            'teacher_id' => 'required|exists:teachers,id',
        ]);
    
        if (!isset($validatedData['teacher_id'])) {
            $validatedData['teacher_id'] = null;
        }
    
        Grade::create($validatedData);
        return redirect()->route('grades.index')->with('success', 'Grade created successfully');
    }

    public function edit($id)
    {
        $grade = Grade::findOrFail($id);
        $students = Student::all();
        $quizzes = Quiz::all();
        return view('grades.edit', compact('grade', 'students', 'quizzes'));
    }
    public function update(Request $request, Grade $grade)
    {
        $validatedData = $request->validate([
            'score' => 'required|numeric|min:0|max:100',
            'student_id' => 'required|exists:students,id',
            'quiz_id' => 'required|exists:quizzes,id',
        ]);
        $grade->update($validatedData);
        return redirect()->route('grades.index')->with('success', 'Grade updated successfully');
    }

    public function destroy(Grade $grade)
    {

        $grade->delete();
        return redirect()->route('grades.index')->with('success', 'Grade deleted successfully');
    }
}
