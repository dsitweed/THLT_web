@extends('layouts.app')

@php
    $teacher = App\Models\Teacher::where('user_id', Auth::user()->id)->get();
    $courses = App\Models\Course::where('teacher_id', $teacher[0]->id)->get();
@endphp

@section('content')
    @if (count($teacher) != 1)
        <h1 class="text-red-500">Lỗi </h1>
    @else
        <div class="mt-8">
            <h1 class="text-center text-4xl">Tạo bài thi</h1>
            <form action="/examinfo" method="POST">
                @csrf

                <div class="flex flex-col mx-auto w-2/3">
                    <?php $inputClass = 'border border-black rounded-md p-2'; ?>
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                    <label class="my-2" for="">Tên bài thi</label>
                    <input class="{{ $inputClass }}" type="text" id="name" name="name" :value="old('name')"
                        required autofocus class="block mt-1 w-full" />
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <label class="my-2" for="">ID khóa học: </label>
                    <select id="course_id" name="course_id" :value="old('course_id')" required
                        class="p-2 rounded-md form-select">
                        @foreach ($courses as $item)
                            <option value="{{ $item->id }}">
                                <div>
                                    <span>Id: {{ $item->id }}</span>
                                    <span> - {{ $item->name }}</span>
                                </div>
                            </option>
                        @endforeach
                    </select>

                    <label class="my-2" for="">Số câu hỏi:</label>
                    <input class="{{ $inputClass }}" type="number" min="1" id="question_lenth"
                        name="question_lenth" :value="old('question_lenth')" required class="block mt-1 w-full" />
                    @error('question_lenth')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <label class="my-2" for="">Thời gian phút</label>
                    <input class="{{ $inputClass }}" type="number" min="1" id="time" name="time"
                        :value="old('time')" required class="block mt-1 w-full" />
                    @error('time')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <button class="mt-4 text-xl rounded-lg mx-auto w-2/6 bg-slate-300 text-green-600 p-3 font-bold">Tạo bài thi ngẫu nhiên </button>
                </div>
            </form>
        </div>
    @endif
@endsection
