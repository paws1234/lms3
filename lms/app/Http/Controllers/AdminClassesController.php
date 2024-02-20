<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Http\Request;

class AdminClassesController extends Controller
{
    public function index()
    {
        $classes = ClassModel::all();

        return view('classes.admin', compact('classes'));
    }

    public function create()
    {
        // No need to pass teachers to the create view for administrators
        return view('classes.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        ClassModel::create($validatedData);

        return redirect()->route('classes.admin')->with('success', 'Class created successfully');
    }

    public function edit(ClassModel $class)
    {
        // No need to pass teachers to the edit view for administrators
        return view('classes.edit', compact('class'));
    }

    public function update(Request $request, ClassModel $class)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        $class->update($validatedData);

        return redirect()->route('classes.admin')->with('success', 'Class updated successfully');
    }

    public function destroy(ClassModel $class)
    {
        $class->delete();
        return redirect()->route('classes.admin ')->with('success', 'Class deleted successfully');
    }
}
