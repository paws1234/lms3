@extends('layouts.student')

@section('content')
<div class="container mx-auto py-8">
    <div class="container mx-auto px-4 py-8 flex justify-between items-center">
        <h1 class="text-3xl font-semibold mb-6">Class Materials</h1>
        <a href="{{ route('student.dashboard') }}" class="text-blue-500 hover:text-blue-600 font-medium">Back</a>
    </div>
    @foreach($classMaterials as $classMaterial)
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <p>Title: {{ $classMaterial->title }}</p>
        <p>Description: {{ $classMaterial->description }}</p>
        <p><a href="{{ route('student.class_materials.download', $classMaterial->id) }}" class="text-blue-500 hover:text-blue-600 font-medium">Download File</a></p>
    </div>
    @endforeach
</div>
@endsection
