@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="coustm1">
            <div class="title">
                <h1>
                    Online Exam
                </h1>
            </div>
            
            <div class="m-4">
                <a href="{{route('student.show-all-exams')}}" style="background-color: #ff9f3b;padding: 10px;margin: 10px;color: black;border-radius: 5px;">View All Exam</a>
                <a href="{{route('result.index')}}" style="background-color: #ff9f3b;padding: 10px;margin: 10px;color: black;border-radius: 5px;">View All Result</a>
            </div>
        </div>
    </div
@endsection