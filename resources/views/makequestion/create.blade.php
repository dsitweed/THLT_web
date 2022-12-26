@extends('layouts.app')

{{-- Truyền 1 tham số là Examinfo $examinfo, $questionCount từ ExaminfoController.php
	1 kiểu model Examinfo biến có tên là examinfo
--}}
@php
    if (!isset($questionCount)) {
        $questionCount = 1;
    }
    $inputClass = 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500';
@endphp

@section('content')
    <div class="m-4">
        <div class="header flex justify-between">
            <h1 class="text-lg">Tên bài thi: {{ $examinfo->name }} </h1>
            <h1 class="text-lg">Id bài thi: {{ $examinfo->id }}</h1>
        </div>
        <h2 style="text-align: center;"><b>Hệ thống sẽ tự động chuyển hướng khi bạn điền đủ số lượng câu hỏi</b></h2>
        <form method="post" action="{{ route('makequestion.store') }} ">
            @csrf

            <div class="">
                <div class="flex flex-col">
                    <label class="" for="formGroupExampleInput">Câu hỏi số:
                        {{ $questionCount }}/{{ $examinfo->question_lenth }}</label>
                    <textarea id="message" rows="4"
                        class="block p-2.5 mb-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        name="question" placeholder="Question" required></textarea>
                </div>
                <div class="grid grid-rows-2 grid-flow-col gap-4">
                    <div class="form-group">
                        <label class="col-form-label" for="formGroupExampleInput2">Lựa chọn 1</label>
                        <input type="text" name="option1" class="{{ $inputClass }}" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="formGroupExampleInput2">Lựa chọn 2</label>
                        <input type="text" name="option2" class="{{ $inputClass }}" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="formGroupExampleInput2">Lựa chọn 3</label>
                        <input type="text" name="option3" class="{{ $inputClass }}" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="formGroupExampleInput2">Lựa chọn 4</label>
                        <input type="text" name="option4" class="{{ $inputClass }}" id="formGroupExampleInput2"
                            required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="formGroupExampleInput2">Đáp án đúng</label>
                    <input type="text" name="answer" class="{{ $inputClass }}" id="formGroupExampleInput2" required>
                </div>
                {{-- Có thể ẩn label exam ID khi thiết kế giao diện đang để hiện cho dễ test  --}}
                <input type="hidden" name="examId" class="form-control" id="formGroupExampleInput2"
                    value="{{ $examinfo->id }}" readonly>
            </div>
            <button type="Submit" class="p-2 mt-4 rounded-md font-medium w-full text-lg bg-slate-500">Xác nhận</button>
        </form>
    </div>
@endsection
