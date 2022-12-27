@extends('layouts.app')

@section('content')
    @foreach ($questions as $question)

        <body class="">
            <div class="h-full w-full flex-1 flex items-center justify-center bg-green-400">
                {{-- tương đương với: put /makequestion/{{$question->id}}  --}}
                <form class="my-6 p-8 min-w-[640px] rounded-lg bg-white" method="post"
                    action="{{ route('makequestion.update', [$question->id]) }}">
                    @csrf

                    {{-- HTML Chỉ hỗ trợ POST và GET nên muốn gửi PUT cần thêm dòng 15 --}}
                    {{-- Cách viết ngắn hơn cho dòng 15  @method('PUT') --}}
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="exam_id" value="{{ $question->exam_id }}">
                    <div class="flex flex-col gap-4">
                        <span class=" flex flex-col gap-2">
                            <p class="text-2xl font-semibold">Câu hỏi:</p>
                            <textarea class="flex-1 border rounded-lg p-2 font-semibold focus:outline-none" type="text" name="question"
                                value="{{ $question->question }}" required>{{ $question->question }}</textarea>
                        </span>
                        <span class=" flex flex-col gap-2">
                            <p class="text-md font-medium">Lựa chọn 1:</p>
                            <input class="flex-1 border rounded-lg p-2 focus:outline-none" type="text" name="choice1"
                                value="{{ $question->choice1 }}" required>
                        </span>
                        <span class=" flex flex-col gap-2">
                            <p class="text-md font-medium">Lựa chọn 2:</p>
                            <input class="flex-1 border rounded-lg p-2 focus:outline-none" type="text" name="choice2"
                                value="{{ $question->choice2 }}" required>
                        </span>
                        <span class=" flex flex-col gap-2">
                            <p class="text-md font-medium">Lựa chọn 3:</p>
                            <input class="flex-1 border rounded-lg p-2 focus:outline-none" type="text" name="choice3"
                                value="{{ $question->choice3 }}" required>
                        </span> <span class=" flex flex-col gap-2">
                            <p class="text-md font-medium">Lựa chọn 4:</p>
                            <input class="flex-1 border rounded-lg p-2 focus:outline-none" type="text" name="choice4"
                                value="{{ $question->choice4 }}" required>
                        </span>
                        <span class=" flex flex-col gap-2 text-green-600">
                            <p class="text-md font-medium">Đáp án:</p>
                            <input class="flex-1 border rounded-lg p-2 focus:outline-none" type="text" name="answer"
                                value="{{ $question->answer }}" required>
                        </span>
                        <input type="submit"
                            class="hover:cursor-pointer px-4 py-3 bg-green-600 text-white font-semibold rounded-lg"
                            name="update" value="Cập nhật">
                    </div>
                </form>
            </div>
        </body>
    @endforeach
@endsection
