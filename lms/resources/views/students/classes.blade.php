@extends('layouts.student')

@section('content')
<div class="container mx-auto px-4 py-8 flex justify-between items-center">
    <h2 class="text-3xl font-semibold mb-4">Your Classes</h2>
    <a href="{{ route('student.dashboard') }}" class="text-blue-500 hover:text-blue-600 font-medium">Back</a>
</div>

@if($classes->isNotEmpty())
<div class="container mx-auto px-4">
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-md overflow-hidden">
            <thead class="bg-gray-100 border-b border-gray-300">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Class Name</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                @foreach($classes as $class)
                <tr class="hover:bg-gray-50 transition duration-300 ease-in-out">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $class->name }}</div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
<div class="container mx-auto px-4">
    <div class="bg-white shadow-md rounded-md p-4 text-center text-gray-600">
        <p>No classes found.</p>
    </div>
</div>
@endif
@endsection
