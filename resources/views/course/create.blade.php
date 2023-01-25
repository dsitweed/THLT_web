@extends('layouts.app')

{{-- Nhận 1 biến $listCourse array kiểu Model Course --}}

@section('content')
    <div>
        <form action="{{route('course.store')}}" method="POST"
            class="flex flex-col w-2/3 mx-auto"
        >
            @csrf

            <label class="my-2" for=""> Course name</label>
            @error('course_name')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
            <input class="border border-black p-2 rounded-md" type="text" name="course_name" required>
            
            <label class="my-2" for=""> Course type</label>
            <div class="flex gap-10">
                <div>
                    <input type="radio" name="privacy" value="public">
                    <label>Public</label><br>
                </div>
                <div>
                    <input type="radio" name="privacy" value="private">
                    <label>Private</label><br>
                </div>
            </div>
           
            <label class="my-2" for="">Course descripton</label>
            <input class="border border-black p-2 rounded-md" type="text" name="course_description" required>
            <button name="submit" type="submit"
                class="mt-4 bg-blue-700 text-white text-2xl w-2/6 m-auto p-1 rounded-md text-"
            >Save</button>
        </form>
        
    </div>
@endsection