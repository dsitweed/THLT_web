@extends('layouts.app')

{{-- receiv a Examinfo exam (Biến exam kiểu model Examinfo )
    and Question questions  (biến questions là array kiểu model Question)
--}}

@php
    $student = \App\Models\Student::where('user_id', Auth::user()->id)->first();
@endphp

@section('script')
    <style>
        :checked+span,
        :checked+span:hover {
            background: rgb(37 99 235);
            color: white;
        }
    </style>
    <!-- script for time limitation of exam -->
    <script type="text/javascript">
        var timeoutHandle;

        function countdown(minutes) {
            var seconds = 60;
            var mins = minutes

            function tick() {
                var counter = document.getElementById("timer");
                var current_minutes = mins - 1
                seconds--;
                counter.innerHTML =
                    current_minutes.toString() + " phút " + (seconds < 10 ? "0" : "") + String(seconds) + " giây";
                if (seconds > 0) {
                    timeoutHandle = setTimeout(tick, 1000);
                } else {
                    if (mins > 1) {
                        // countdown(mins-1);   never reach “00″ issue solved:Contributed by Victor Streithorst
                        setTimeout(function() {
                            countdown(mins - 1);
                        }, 1000);

                    }
                }
            }
            tick();
        }
        countdown('<?php echo $exam->time; ?>');
    </script>

    <!-- script for disable url -->
    <script type="text/javascript">
        var time = '<?php echo $exam->time; ?>';
        var realtime = time * 60000;
        setTimeout(function() {
                alert('Time Out');
                window.location.href = '/';
            },
            realtime);
    </script>
@endsection

@section('content')

    <body class="">
        <div class="">
            <nav class="bg-red-600 text-white sticky top-0 flex flex-col justify-center items-center py-2">
                <p class="items-center text-lg font-semibold">
                    Bài kiểm tra môn {{ $exam->course_name }}
                </p>
                <p class="">
                    Thời gian còn lại: <span id="timer" class="">00.00</span>
                </p>
            </nav>
            <div class="bg-slate-200 py-10">
                <div class="max-w-[600px] mx-auto">
                    <form method="post" action="{{ route('answer.store') }}" class="flex flex-col gap-10">
                        @csrf

                        <input type="hidden" name="student_id" value="{{ $student->id }}">
                        <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                        @foreach ($questions as $key => $question)
                            <div class="bg-white mx-4 rounded-lg px-8 py-6">
                                <h3 class="ml-3 mb-2 text-lg font-semibold">Câu {{ $key + 1 }} :
                                    {{ $question->question }} ?
                                </h3>
                                <div class="flex flex-row flex-wrap">
                                    <input type="hidden" name="question_id[]" value="{{ $question->id }}">
                                    <input type="hidden" name="question[]" value="{{ $question->question }}">
                                    <input type="hidden" name="true_answer[]" value="{{ $question->answer }}">

                                    <div class="w-1/2 px-3 py-2 flex">
                                        <label class="w-full flex">
                                            <input hidden name="answer{{ $key }}" value="{{ $question->choice1 }}"
                                                type="radio">
                                            <span
                                                class="bg-yellow-400 px-4 py-3 rounded-lg cursor-pointer hover:bg-yellow-500 w-full">A.
                                                {{ $question->choice1 }}</span>
                                        </label>
                                    </div>
                                    <div class="w-1/2 px-3 py-2 flex">
                                        <label class="w-full flex">
                                            <input hidden name="answer{{ $key }}"
                                                value="{{ $question->choice2 }}" type="radio">
                                            <span
                                                class="bg-yellow-400  px-4 py-3 rounded-lg cursor-pointer hover:bg-yellow-500 w-full">B.
                                                {{ $question->choice2 }}</span>
                                        </label>
                                    </div>
                                    <div class="w-1/2 px-3 py-2 flex">
                                        <label class="w-full flex">
                                            <input hidden name="answer{{ $key }}"
                                                value="{{ $question->choice3 }}" type="radio">
                                            <span
                                                class="bg-yellow-400 px-4 py-3 rounded-lg cursor-pointer hover:bg-yellow-500 w-full">C.
                                                {{ $question->choice3 }}</span>
                                        </label>
                                    </div>
                                    <div class="w-1/2 px-3 py-2 flex">
                                        <label class="w-full flex">
                                            <input hidden name="answer{{ $key }}"
                                                value="{{ $question->choice4 }}" type="radio">
                                            <span
                                                class="bg-yellow-400 px-4 py-3 rounded-lg cursor-pointer hover:bg-yellow-500 w-full">D.
                                                {{ $question->choice4 }}</span>
                                        </label>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                        <input type="submit" name="submit" value="Nộp bài"
                            class="uppercase bg-yellow-400 px-4 py-3 mx-4 mb-6 font-semibold cursor-pointer rounded-lg hover:bg-yellow-500"
                            id="submitbtn">
                    </form>
                </div>
            </div>
        </div>

    </body>
@endsection
