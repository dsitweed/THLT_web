@extends('layouts.app')

@php
    $teacher = App\Models\Teacher::where('user_id', Auth::user()->id)->get();
    $courses = App\Models\Course::where('teacher_id', $teacher[0]->id)->get();
@endphp

@section('content')
    @if (count($teacher) != 1)
        <h1>ERROR</h1>
    @else
        <div class="">
            <h1 class="text-center text-4xl">Create new exam</h1>
            <form action="{{route('examinfo.store')}}" method="post">
                @csrf
                <div class="flex flex-col mx-auto w-2/3">
                    <input type="text" value="{{substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 5)}}" name="uniqueid" class="form-control" id="formGroupExampleInput2">
                    <input type="text" name="user_id" value="{{Auth::user()->id}}">

                    <label for="">Exam name</label>
                    <input type="text" id="name" name="name" :value="old('name')" required autofocus 
                        class="block mt-1 w-full"
                    />

                    <label for="">Course id</label>
                    <select id="course_id" name="course_id" :value="old('course_id')" required
                        class=""
                    >
                        @foreach ($courses as $item)
                            <option value="{{$item->id}}">
                                <div>
                                    <span>{{$item->id}}</span>
                                    <span>{{$item->name}}</span>
                                </div>
                            </option>
                        @endforeach
                    </select>

                    <label for="">Number of question </label>
                    <input type="number" id="question_lenth" name="question_lenth" :value="old('question_lenth')" required 
                        class="block mt-1 w-full"
                    />

                    <label for="">Set time (minutes)</label>
                    <input type="number" min="1" id="time" name="time" :value="old('time')" required 
                        class="block mt-1 w-full"
                    />
                    <button>Submit</button>
                </div>
            </form>
        </div>
    @endif
@endsection