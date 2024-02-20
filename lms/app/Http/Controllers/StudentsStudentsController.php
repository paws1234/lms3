<?php

namespace App\Http\Controllers;
use App\Models\ClassMaterial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class StudentsStudentsController extends Controller
{
    public function index()
    {
        return view('students.dashboard');
    }

    public function quizzes()
    {

        $user = Auth::user();
        $student = DB::table('students')
            ->join('users', 'students.id', '=', 'users.id')
            ->where('students.name', $user->name)
            ->select('students.id')
            ->first();

        $quizzes = [];

        if ($student) {
            $quizzes = DB::table('quizzes')
                ->join('class_models', 'quizzes.class_id', '=', 'class_models.id')
                ->join('class_enrollments', 'class_models.id', '=', 'class_enrollments.class_id')
                ->where('class_enrollments.student_id', $student->id)
                ->get();
        }

        return view('students.quizzes', compact('quizzes'));
    }

    public function grades()
    {
        $user = Auth::user();
        $student = DB::table('students')
            ->join('users', 'students.id', '=', 'users.id')
            ->where('students.name', $user->name)
            ->select('students.id')
            ->first();
        $grades = [];
    
        if ($student) {
            $grades = DB::table('grades')
                ->join('quizzes', 'grades.quiz_id', '=', 'quizzes.id')
                ->join('class_models', 'quizzes.class_id', '=', 'class_models.id')
                ->join('class_enrollments', 'class_models.id', '=', 'class_enrollments.class_id')
                ->where('class_enrollments.student_id', $student->id)
                ->select('quizzes.id as quiz_id', 'quizzes.title as quiz_name', 'grades.score')
                ->get();
        }
    
        return view('students.grades', compact('grades'));
    }
    

public function classMaterials()
{
    $user = Auth::user();
    $student = DB::table('students')
        ->join('users', 'students.id', '=', 'users.id')
        ->where('students.name', $user->name)
        ->select('students.id')
        ->first();

    $classMaterials = [];

    if ($student) {
        $classMaterials = DB::table('class_materials')
            ->join('class_models', 'class_materials.class_id', '=', 'class_models.id')
            ->join('class_enrollments', 'class_models.id', '=', 'class_enrollments.class_id')
            ->where('class_enrollments.student_id', $student->id)
            ->select('class_materials.*') 
            ->get();
    }

    return view('students.class_materials', compact('classMaterials'));
}
public function download($id)
    {
        $classMaterial = ClassMaterial::findOrFail($id);
        $fileContent = $classMaterial->file_content;
        $contentType = 'application/octet-stream';
        if (Str::endsWith($classMaterial->title, '.pdf')) {
            $contentType = 'application/pdf';
        } elseif (Str::endsWith($classMaterial->title, '.docs') || Str::endsWith($classMaterial->title, '.docx')) {
            $contentType = 'application/msword';
        } elseif (Str::endsWith($classMaterial->title, '.png')) {
            $contentType = 'image/png';
        } elseif (Str::endsWith($classMaterial->title, '.jpg') || Str::endsWith($classMaterial->title, '.jpeg')) {
            $contentType = 'image/jpeg';
        }

        $headers = [
            'Content-Type' => $contentType,
            'Content-Disposition' => 'attachment; filename="' . $classMaterial->title . '"',
        ];

        return response()->make($fileContent, 200, $headers);
    }

}

