@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="coustm1">
            <div class="title">
                <h1>
                    Online Exam
                </h1>
            </div>
            
            <div class="links">
                <a href="{{route('examinfo.create')}}" style="background-color: #ff9f3b;padding: 10px;margin: 10px;color: black;border-radius: 5px;">Create Exam</a>
                <a href="{{route('student.index')}}" style="background-color: #ff9f3b;padding: 10px;margin: 10px;color: black;border-radius: 5px;">Give Exam</a>
                <a href="{{route('result.index')}}" style="background-color: #ff9f3b;padding: 10px;margin: 10px;color: black;border-radius: 5px;">Result</a>
            </div>
        </div>
    </div
@endsection