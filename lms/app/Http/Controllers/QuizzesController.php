<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizzesController extends Controller
{
    public function index()
    {
        $userName = Auth::user()->name;
        $teacher = Teacher::where('name', $userName)->first();

        if ($teacher) {
            $quizzes = Quiz::where('teacher_id', $teacher->id)->get();
        } else {
            return redirect()->route('home')->with('error', 'Teacher not found for user: ' . $userName);
        }
        $classes = ClassModel::all();
        return view('quizzes.index', compact('quizzes', 'classes'));
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
            return redirect()->route('home')->with('error', 'Teacher not found for user: ' . $userName);
        }

        $classes = ClassModel::where('teacher_id', $teacherId->id)->get();

        return view('quizzes.create', compact('classes'));
    }


    public function store(Request $request)
    {
        $userName = Auth::user()->name;
        $teacher = Teacher::where('name', $userName)->first();

        if ($teacher) {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'class_id' => 'required|exists:class_models,id',
            ]);
            $validatedData['teacher_id'] = $teacher->id;
            Quiz::create($validatedData);

            return redirect()->route('quizzes.index')->with('success', 'Quiz created successfully');
        } else {
            return redirect()->route('home')->with('error', 'Teacher not found for user: ' . $userName);
        }
    }


    public function edit(Quiz $quiz)
    {
        $classes = ClassModel::all();
        return view('quizzes.edit', compact('quiz', 'classes'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'class_id' => 'required|exists:class_models,id',
        ]);

        $userName = Auth::user()->name;
        $teacher = Teacher::where('name', $userName)->first();

        if ($teacher) {
            $validatedData['teacher_id'] = $teacher->id;
            $quiz->update($validatedData);

            return redirect()->route('quizzes.index')->with('success', 'Quiz updated successfully');
        } else {
            return redirect()->route('home')->with('error', 'Teacher not found for user: ' . $userName);
        }
    }


    public function destroy(Quiz $quiz)
    {

        $quiz->delete();


        return redirect()->route('quizzes.index')->with('success', 'Quiz deleted successfully');
    }
}
