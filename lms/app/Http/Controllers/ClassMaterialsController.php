<?php

namespace App\Http\Controllers;

use App\Models\ClassMaterial;
use App\Models\ClassModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClassMaterialsController extends Controller
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

        $classMaterials = ClassMaterial::where('teacher_id', $teacherId->id)->with('class')->get();


        return view('class_materials.index', compact('classMaterials'));
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

        $classes = ClassModel::where('teacher_id', $teacherId->id)->get();

        return view('class_materials.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',
            'class_id' => 'required|exists:class_models,id',
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

        }

        $classMaterial = new ClassMaterial();
        $classMaterial->teacher_id = $teacherId->id;
        $classMaterial->class_id = $request->input('class_id');
        $classMaterial->title = $validatedData['title'];
        $classMaterial->description = $validatedData['description'];
        $fileContent = file_get_contents($request->file('file')->getRealPath());
        $classMaterial->file_content = $fileContent;
        $classMaterial->save();

        return redirect()->route('class-materials.index')->with('success', 'Class material created successfully');
    }



    public function edit(ClassMaterial $classMaterial)
    {
        return view('class_materials.edit', compact('classMaterial'));
    }

    public function update(Request $request, ClassMaterial $classMaterial)
    {
        $validatedData = $request->validate([
            'title' => 'string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2048',

        ]);


        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileContent = file_get_contents($file->getRealPath());
            $classMaterial->file_content = $fileContent;
            $classMaterial->file_path = null;
        }

        $classMaterial->title = $validatedData['title'];
        $classMaterial->description = $validatedData['description'];
        $classMaterial->save();

        return redirect()->route('class-materials.index')->with('success', 'Class material updated successfully');
    }


    public function destroy(ClassMaterial $classMaterial)
    {
        $classMaterial->delete();
        return redirect()->route('class-materials.index')->with('success', 'Class material deleted successfully');
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
