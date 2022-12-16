@extends('layouts.app')

@section('content')
    <h1 class="text-center text-4xl">Teacher home page</h1>
    <div class="flex flex-row mx-3">
        <div class="basis-1/3">
            <a href="{{route('teacher.show-all-exams')}}">View all my exams</a>
            <br>
            <a href="{{route('examinfo.create')}}">Create new exams</a>
            <br>
            <a href="{{route('course.create')}}">Create new course</a>
            <br>
            <a href="{{route('course.index')}}">View all my course</a>
        </div>
        <div class="basis-2/3">right</div>
    </div>
@endsection