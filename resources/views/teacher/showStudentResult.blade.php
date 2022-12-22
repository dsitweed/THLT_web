@extends('layouts.app')

{{-- Biến đàu vào từ teacherController hàm showStudentResult
    nhận tham số: $exam // array chứa thông tin về exam
        $listResult // array chứa thông tin về từng kết quả bài thi tương ứng với exam trên 
--}}

@section('content')
    <div>
        <div class="body my-2">
            <h2>Exam id: {{$exam->id}}</h2>
            <h2>Exam name: {{$exam->name}}</h2>
            <table class="table-fixed w-full border border-spacing-2 border-collapse border-slate-400">
                <thead>
                    <?php $thClass = "border p-2 border-slate-400" ?>
                    <tr>
                        <th class="{{$thClass}}">Student name</th>
                        <th class="{{$thClass}}">Score</th>
                        <th class="{{$thClass}}">View detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $tdClass = "text-center border border-slate-400 p-2" ?>
                    @foreach ($listResult as $item)
                        <tr>
                            <td class="{{$tdClass}}">{{$item->student_name}}</td>
                            <td class="{{$tdClass}}">{{$item->score}}</td>
                            <td class="{{$tdClass}}">
                                <form action="#" method="get">
                                    <button type="submit">View detail</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>    
@endsection