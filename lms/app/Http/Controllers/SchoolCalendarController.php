<?php

namespace App\Http\Controllers;

use App\Models\SchoolCalendar;
use Illuminate\Http\Request;

class SchoolCalendarController extends Controller
{
    public function index()
    {
        $schoolCalendars = SchoolCalendar::all();
        return view('school_calendars.index', compact('schoolCalendars'));
    }

    public function create()
    {
        return view('school_calendars.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
        ]);

        SchoolCalendar::create($validatedData);

        return redirect()->route('school_calendars.index')->with('success', 'Event created successfully');
    }

    public function edit(SchoolCalendar $event)
    {
        return view('school_calendars.edit', compact('event'));
    }

    public function update(Request $request, SchoolCalendar $event)
    {
        $validatedData = $request->validate([
            'event_name' => 'required|string|max:255',
            'event_date' => 'required|date',
        ]);

        $event->update($validatedData);

        return redirect()->route('school_calendars.index')->with('success', 'Event updated successfully');
    }

    public function destroy(SchoolCalendar $event)
    {
        $event->delete();
        return redirect()->route('school_calendars.index')->with('success', 'Event deleted successfully');
    }
}
