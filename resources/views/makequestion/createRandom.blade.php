@extends('layouts.app')

{{-- Truyền 1 tham số là $questions, $error, $exam_id từ ExaminfoController.php
	1 kiểu model Examinfo biến có tên là examinfo
--}}
@php
@endphp



@section('content')
<body style="background-color: rgb(74 222 128)">
    <div class="min-w-[800px] mx-auto">
        <div class="px-4 my-8">
            <h2 class="text-center text-2xl p-4 bg-green-600 text-white rounded-lg ">Chọn tập các câu hỏi muốn tráo</h2>
        </div>
        {{-- Nếu có lỗi --}}
        @if (isset($error)) 
            {{$error}}
        @else
        @php
            $count = 0;
        @endphp
        <form action="examinfo/store-random-exam" method="post">
        @csrf
        {{-- gửi kèm exam_id --}}
        <input type="hidden" name="exam_id" value={{$examinfo->id}}>
        <input type="hidden" name="exam_length" value={{$examinfo->question_lenth}}>
        <input type="hidden" name="course_id" value={{$examinfo->course_id }}>
        @foreach ($questions as $question)
        @php
            $count++;
            @endphp
            <div class="flex items-center justify-center mb-4">
                <input name="select[]" value={{$question['id']}} type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                >
                <div class="">
                        <div
                            class="bg-slate-100 mx-4 my-6 rounded-lg px-8 py-6 group cursor-pointer hover:bg-white relative">
                            <button type="submit" name="submitFromEditPage"
                                class="absolute top-4 right-8 hover:bg-slate-200 p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="green"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                    </path>
                                    <path d="M16 5l3 3"></path>
                                </svg>
                            </button>
                            <div class="flex flex-row justify-between mx-3">
                                <h3 class=" mb-2 text-lg font-semibold">Câu {{ $count }} :
                                    {{ $question['question'] }} ?
                                </h3>
                            </div>
                            <div class="flex flex-row flex-wrap">
                                <input type="hidden" name="question_id[]" value="{{ $question['id'] }}">
                                <input type="hidden" name="question[]" value="{{ $question['question'] }}">
                                <input type="hidden" name="true_answer[]" value="{{ $question['answer'] }}">

                                <div class="w-1/2 px-3 py-2 flex">
                                    <label
                                        class="flex justify-between bg-yellow-400 px-4 py-3 rounded-lg cursor-pointer w-full">
                                        <span class="">A.
                                            {{ $question['choice1'] }}
                                        </span>
                                        @if ($question['choice1'] == $question['answer'])
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-check" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="green" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M5 12l5 5l10 -10"></path>
                                            </svg>
                                        @endif
                                    </label>
                                </div>
                                <div class="w-1/2 px-3 py-2 flex">
                                    <label
                                        class="flex justify-between bg-yellow-400 px-4 py-3 rounded-lg cursor-pointer w-full">
                                        <span class="">B.
                                            {{ $question['choice2'] }}
                                        </span>
                                        @if ($question['choice2'] == $question['answer'])
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-check" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="green" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M5 12l5 5l10 -10"></path>
                                            </svg>
                                        @endif
                                    </label>
                                </div>
                                <div class="w-1/2 px-3 py-2 flex">
                                    <label
                                        class="flex justify-between bg-yellow-400 px-4 py-3 rounded-lg cursor-pointer w-full">
                                        <span class="">C.
                                            {{ $question['choice3'] }}
                                        </span>
                                        @if ($question['choice3'] == $question['answer'])
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-check" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="green" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M5 12l5 5l10 -10"></path>
                                            </svg>
                                        @endif
                                    </label>
                                </div>
                                <div class="w-1/2 px-3 py-2 flex">
                                    <label
                                        class="flex justify-between bg-yellow-400 px-4 py-3 rounded-lg cursor-pointer w-full">
                                        <span class="">D.
                                            {{ $question['choice4'] }}
                                        </span>
                                        @if ($question['choice4'] == $question['answer'])
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-check" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="green"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M5 12l5 5l10 -10"></path>
                                            </svg>
                                        @endif
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <br>
                @endforeach
                <button type="submit"
                        class="w-full rounded-lg px-4 py-3 text-lg bg-yellow-400">Hoàn thành</button>
            </form>
            <br>
            <br>
        @endif
        
</body>
@endsection
