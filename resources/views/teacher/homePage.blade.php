@extends('layouts.app')

@section('content')
    <div class="flex flex-row flex-1">
        <div class="flex flex-col p-4 bg-slate-100">
            <div class="flex flex-col">
                <?php $button = 'p-1 mt-2 border-l-4 border-blue-600 hover:bg-blue-600 hover:text-white'; ?>
                <a class="{{ $button }}" href="{{ route('course.create') }}">Tạo khóa học mới </a>
                <a class="{{ $button }}" href="{{ route('course.index') }}">Tất cả khóa học</a>
                <a class="{{ $button }}" href="{{ route('examinfo.create') }}">Tạo đề thi</a>
                <a class="{{ $button }}" href="{{ route('teacher.show-all-exams') }}">Tất cả đề thi</a>
                <a class="{{ $button }}" href="{{ route('teacher.show-forum') }}">Các nhóm thảo luận</a>
            </div>
        </div>
        <div class="flex-1 mt-4">
            <x-courses />
        </div>
    </div>
@endsection
