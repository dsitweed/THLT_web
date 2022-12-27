@extends('layouts.app')

{{-- Biến đàu vào từ teacherController hàm showStudentResultDetail
    nhận tham số $listResult: ví dụ
        $listResult: [
            [
                student_id: 1,
                question_id: 2,
                exam_id: 3,
                result_id: 4,
                given_answer: '1213',
                question: [
                    exam_id: 3,
                    question: '2312',
                    choice1: '1',
                    choice2: '1',
                    choice3: '1',
                    choice4: '1'
                    answer: '1'
                ]
            ],// end 1 phan tu
        ]
--}}
@php
    $resultDetail = [];
    foreach ($listResult as $key => $value) {
        $resultDetail[$key] = $listResult[$key]->question;
        $resultDetail[$key]->given_answer = $listResult[$key]->given_answer;
    }
    // dd($resultDetail);
@endphp

{{-- received $resultDetail and $score (score of exam) --}}

@section('content')
    <div class="">
        <div class="bg-slate-200 py-10">
            <div class="max-w-[600px] mx-auto pointer-events-none select-none">
                <div class="bg-white mx-4 my-6 rounded-lg text-center text-lg font-semibold py-6">
                    <h2 class="mb-2">Họ và tên: {{ $listResult->student_name }}</h2>
                    <h2>Kết quả bài thi: {{$listResult->score}}/{{ count($resultDetail) }}</h2>
                </div>
                @foreach ($resultDetail as $key => $question)
                    <div class="bg-white mx-4 my-6 rounded-lg px-8 py-6">
                        <div class="flex flex-row justify-between mx-3">
                            <h3 class=" mb-2 text-lg font-semibold">Câu {{ $key + 1 }} :
                                {{ $question->question }} ?
                            </h3>
                            @if ($question->answer == $question->given_answer)
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="green"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M5 12l5 5l10 -10"></path>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="red"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            @endif

                        </div>
                        <div class="flex flex-row flex-wrap">
                            <input type="hidden" name="question_id[]" value="{{ $question->id }}">
                            <input type="hidden" name="question[]" value="{{ $question->question }}">
                            <input type="hidden" name="true_answer[]" value="{{ $question->answer }}">

                            <div class="w-1/2 px-3 py-2 flex">
                                <label class="w-full flex">
                                    <input hidden name="answer{{ $key }}" value="{{ $question->choice1 }}"
                                        type="radio">
                                    @if ($question->answer == $question->choice1)
                                        <span
                                            class="bg-green-400 px-4 py-3 rounded-lg cursor-pointer hover:bg-yellow-500 w-full">A.
                                            {{ $question->choice1 }}
                                        </span>
                                    @elseif($question->given_answer == $question->choice1 && $question->answer != $question->given_answer)
                                        <span
                                            class="bg-red-400 px-4 py-3 rounded-lg cursor-pointer hover:bg-yellow-500 w-full">A.
                                            {{ $question->choice1 }}
                                        </span>
                                    @else
                                        <span
                                            class="bg-yellow-400 px-4 py-3 rounded-lg cursor-pointer hover:bg-yellow-500 w-full">A.
                                            {{ $question->choice1 }}
                                        </span>
                                    @endif
                                </label>
                            </div>
                            <div class="w-1/2 px-3 py-2 flex">
                                <label class="w-full flex">
                                    <input hidden name="answer{{ $key }}" value="{{ $question->choice2 }}"
                                        type="radio">
                                    @if ($question->answer == $question->choice2)
                                        <span
                                            class="bg-green-400 px-4 py-3 rounded-lg cursor-pointer hover:bg-yellow-500 w-full">B.
                                            {{ $question->choice2 }}
                                        </span>
                                    @elseif($question->given_answer == $question->choice2 && $question->answer != $question->given_answer)
                                        <span
                                            class="bg-red-400 px-4 py-3 rounded-lg cursor-pointer hover:bg-yellow-500 w-full">B.
                                            {{ $question->choice2 }}
                                        </span>
                                    @else
                                        <span
                                            class="bg-yellow-400 px-4 py-3 rounded-lg cursor-pointer hover:bg-yellow-500 w-full">B.
                                            {{ $question->choice2 }}
                                        </span>
                                    @endif

                                </label>
                            </div>
                            <div class="w-1/2 px-3 py-2 flex">
                                <label class="w-full flex">
                                    <input hidden name="answer{{ $key }}" value="{{ $question->choice3 }}"
                                        type="radio">
                                    @if ($question->answer == $question->choice3)
                                        <span
                                            class="bg-green-400 px-4 py-3 rounded-lg cursor-pointer hover:bg-yellow-500 w-full">C.
                                            {{ $question->choice3 }}
                                        </span>
                                    @elseif($question->given_answer == $question->choice3 && $question->answer != $question->given_answer)
                                        <span
                                            class="bg-red-400 px-4 py-3 rounded-lg cursor-pointer hover:bg-yellow-500 w-full">C.
                                            {{ $question->choice3 }}
                                        </span>
                                    @else
                                        <span
                                            class="bg-yellow-400 px-4 py-3 rounded-lg cursor-pointer hover:bg-yellow-500 w-full">C.
                                            {{ $question->choice3 }}
                                        </span>
                                    @endif

                                </label>
                            </div>
                            <div class="w-1/2 px-3 py-2 flex">
                                <label class="w-full flex">
                                    <input hidden name="answer{{ $key }}" value="{{ $question->choice4 }}"
                                        type="radio">
                                    @if ($question->answer == $question->choice4)
                                        <span
                                            class="bg-green-400 px-4 py-3 rounded-lg cursor-pointer hover:bg-yellow-500 w-full">D.
                                            {{ $question->choice4 }}
                                        </span>
                                    @elseif($question->given_answer == $question->choice4 && $question->answer != $question->given_answer)
                                        <span
                                            class="bg-red-400 px-4 py-3 rounded-lg cursor-pointer hover:bg-yellow-500 w-full">D.
                                            {{ $question->choice4 }}
                                        </span>
                                    @else
                                        <span
                                            class="bg-yellow-400 px-4 py-3 rounded-lg cursor-pointer hover:bg-yellow-500 w-full">D.
                                            {{ $question->choice4 }}
                                        </span>
                                    @endif

                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mx-auto my-6 max-w-[600px]">
                <form action="/teacher/show-student-result/{{$listResult[0]->exam_id}}" method="get">
                    <input type="submit" class="hover:cursor-pointer w-full bg-gray-800 text-white p-3 rounded-md text-xl" value="Quay lại">
                    {{-- <button type="submit" class="">Quay lại</button> --}}
                </form>
            </div>
        </div>
    </div>
@endsection