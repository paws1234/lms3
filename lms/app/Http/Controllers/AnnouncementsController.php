<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\ClassModel;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class AnnouncementsController extends Controller
{
    public function index()
    {

        $userName = Auth::user()->name;
        $teacherId = Teacher::where('name', $userName)->value('id');

        if (!$teacherId) {
            return redirect()->route('home')->with('error', 'Teacher not found for user: ' . $userName);
        }

        $announcements = Announcement::where('teacher_id', $teacherId)->get();

        return view('announcements.index', compact('announcements'));
    }


    public function create()
    {

        return view('announcements.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'class_id' => 'required|numeric',
        ]);


        $userName = Auth::user()->name;
        $teacherId = Teacher::where('name', $userName)->value('id');

        if (!$teacherId) {
            return redirect()->route('home')->with('error', 'Teacher not found for user: ' . $userName);
        }

        $validatedData['teacher_id'] = $teacherId;
        $className = ClassModel::findOrFail($validatedData['class_id'])->name;
        $validatedData['class_name'] = $className;
        Announcement::create($validatedData);

        return redirect()->route('announcements.index')->with('success', 'Announcement created successfully');
    }


    public function edit(Announcement $announcement)
    {
        return view('announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $validatedData = $request->validate([
            'title' => 'string|max:255',
            'content' => 'string',
            'class_id' => 'required|numeric',
        ]);

        $announcement->update($validatedData);

        return redirect()->route('announcements.index')->with('success', 'Announcement updated successfully');
    }

    public function destroy(Announcement $announcement)
    {

        $announcement->delete();


        return redirect()->route('announcements.index')->with('success', 'Announcement deleted successfully');
    }
}
