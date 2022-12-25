@extends('layouts.app')

@section('content')
    <h1 class="text-center text-4xl">Teacher home page</h1>
    <div class="flex flex-row mx-3">
        <div class="basis-1/3 flex flex-col">
            <?php $button = "p-1 mt-2 border-l-4 border-cyan-800 hover:text-blue-600" ?>
            <a class="{{$button}}" href="{{route('teacher.show-all-exams')}}">View all my exams</a>
            <a class="{{$button}}" href="{{route('examinfo.create')}}">Create new exams</a>
            <a class="{{$button}}" href="{{route('course.create')}}">Create new course</a>
            <a class="{{$button}}" href="{{route('course.index')}}">View all my course</a>
        </div>
        <div class="basis-2/3">right</div>
    </div>
@endsection