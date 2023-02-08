@extends('layouts.app')

@section('content')
    <div class="content m-4">
        <div class="title">
            <h1 class="text text-5xl">
                Làm bài thi trực tuyến
            </h1>
        </div>
        
        <div class="mt-8">
            <a href="{{route('student.show-all-exams')}}" style="background-color: #ff9f3b;padding: 10px;margin: 10px;color: black;border-radius: 5px;">Xem tất cả đề thi</a>
            <a href="{{route('result.index')}}" style="background-color: #ff9f3b;padding: 10px;margin: 10px;color: black;border-radius: 5px;">Xem kết quả bài thi</a>
            <a href="/student/join-course" style="background-color: #ff9f3b;padding: 10px;margin: 10px;color: black;border-radius: 5px;">Đăng ký khóa học</a>
            <a style="background-color: #ff9f3b;padding: 10px;margin: 10px;color: black;border-radius: 5px;" href="/student/join-course">Các nhóm thảo luận</a>
        </div>
       
    </div
@endsection