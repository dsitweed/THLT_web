@extends('layouts.app')

{{-- Biến đàu vào từ teacherController hàm showStudentResult
    nhận tham số: $exam // array chứa thông tin về exam
        $listResult // array chứa thông tin về từng kết quả bài thi tương ứng với exam trên 
--}}

@section('content')
    <div>
        <div class="body m-2">
            <h2>Exam id: {{$exam->id}}</h2>
            <h2>Exam name: {{$exam->name}}</h2>
            <div class="my-6 bg-white mx-4">
                <table class="table-fixed w-full">
                    <thead>
                        <?php $thClass = 'bg-yellow-400 text-white px-4 py-3'; ?>
                        <tr class="text-md font-semibold">
                            <th class="{{$thClass}}">Student name</th>
                            <th class="{{$thClass}}">Score</th>
                            <th class="{{$thClass}}">View detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $tdClass = 'text-center px-4 py-3'; ?>
                        @foreach ($listResult as $item)
                            <tr class="hover:bg-yellow-100">
                                <td class="{{$tdClass}}">{{$item->student_name}}</td>
                                <td class="{{$tdClass}}">{{$item->score}}</td>
                                <td class="{{$tdClass}} flex flex-row justify-center">
                                    <form action="/teacher/show-student-result-detail" method="post">
                                        @csrf
                                        <input type="hidden" name="result_id" value="{{$item->id}}">
                                        <input type="hidden" name="student_id" value="{{$item->student_id}}">
                                        <button class="p-2 hover:bg-blue-100 rounded-full text-blue-600" type="submit"><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-report-analytics" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path
                                                    d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2">
                                                </path>
                                                <rect x="9" y="3" width="6" height="4"
                                                    rx="2"></rect>
                                                <path d="M9 17v-5"></path>
                                                <path d="M12 17v-1"></path>
                                                <path d="M15 17v-3"></path>
                                            </svg></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>    
@endsection