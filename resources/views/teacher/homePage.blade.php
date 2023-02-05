@extends('layouts.app')

@section('content')
    <h1 class="text-center text-4xl">Teacher home page</h1>
    <div class="flex flex-row mx-3">
        <div class="basis-1/3 flex flex-col">
            <?php $button = "p-1 mt-2 border-l-4 border-cyan-800 hover:text-blue-600" ?>
            <a class="{{$button}}" href="{{route('course.create')}}">Tạo khóa học mới </a>
            <a class="{{$button}}" href="{{route('course.index')}}">Tất cả khóa học</a>
            <a class="{{$button}}" href="{{route('examinfo.create')}}">Tạo đề thi</a>
            <a class="{{$button}}" href="{{route('teacher.show-all-exams')}}">Tất cả đề thi</a>
            <a class="{{$button}}" href="{{route('teacher.show-forum')}}">Các nhóm thảo luận</a>
        </div>
        <div class="basis-2/3"></div>
    </div>
@endsection