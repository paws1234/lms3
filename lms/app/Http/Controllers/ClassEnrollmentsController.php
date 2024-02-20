<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassEnrollment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClassEnrollmentsController extends Controller
{
    public function index()
    {
        $userName = Auth::user()->name;
        $teacherId = DB::table('users')
            ->join('teachers', function ($join) {
                $join->on('users.name', '=', 'teachers.name')
                    ->whereColumn('users.id', '!=', 'teachers.id');
            })
            ->where('users.name', $userName)
            ->select('teachers.id')
            ->first();

        if (!$teacherId) {
            return redirect()->route('home')->with('error', 'Teacher not found for the current user.');
        }

        $enrollments = ClassEnrollment::where('teacher_id', $teacherId->id)
            ->with('classModel')
            ->get();

        return view('class_enrollments.index', compact('enrollments'));
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
            ->select('teachers.id')
            ->first();

        if (!$teacherId) {
            return redirect()->route('home')->with('error', 'Teacher not found for the current user.');
        }

        $enrollment = ClassEnrollment::where('teacher_id', $teacherId->id)->get();

        return view('class_enrollments.create', compact('enrollment'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'class_id' => 'required|exists:class_models,id',
            'student_id' => 'required|exists:students,id',
        ]);

        $userName = Auth::user()->name;
        $teacherId = DB::table('users')
            ->join('teachers', function ($join) {
                $join->on('users.name', '=', 'teachers.name')
                    ->whereColumn('users.id', '!=', 'teachers.id');
            })
            ->where('users.name', $userName)
            ->select('teachers.id')
            ->first();

        if (!$teacherId) {
            return redirect()->route('home')->with('error', 'Teacher not found for the current user.');
        }

        $validatedData['teacher_id'] = $teacherId->id;

        ClassEnrollment::create($validatedData);

        return redirect()->route('class_enrollments.index')->with('success', 'Class enrollment created successfully');
    }

    public function edit(ClassEnrollment $enrollment)
    {
        return view('class_enrollments.edit', compact('enrollment'));
    }


    public function update(Request $request, ClassEnrollment $enrollment)
    {
        $validatedData = $request->validate([
            'class_id' => 'required|exists:class_models,id',
            'student_id' => 'required|exists:students,id',
        ]);

        $enrollment->update($validatedData);


        return redirect()->route('class_enrollments.index')->with('success', 'Class enrollment updated successfully');
    }


    public function destroy(ClassEnrollment $enrollment)
    {
        $enrollment->delete();

        return redirect()->route('class_enrollments.index')->with('success', 'Class enrollment deleted successfully');
    }
}
