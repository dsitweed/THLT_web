@extends('layouts.app')

{{-- Nhận 1 biến $listCourse array kiểu Model Course --}}

@section('content')
    <div>
        <form action="{{route('course.store')}}" method="POST"
            class="flex flex-col w-2/3 mx-auto"
        >
            @csrf

            <label for=""> Course name</label>
            @error('course_name')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
            <input type="text" name="course_name" required>
            <label for="">Course descripton</label>
            <input type="text" name="course_description" required>
            <button name="submit" type="submit">Save</button>
        </form>
        
    </div>
@endsection