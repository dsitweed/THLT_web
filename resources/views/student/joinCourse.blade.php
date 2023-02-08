@extends('layouts.app')

{{-- Lấy $joinedCourses và $listCourse from studentController   
 --}}
@php
    // dd($listCourse);
    // dd($joinedCourses);
    if (count($listCourse) == 0) $listCourse = [];

    function inArray($course_id, $listCourse) {
        foreach ($listCourse as $key => $value) {
            if($value->course_id == $course_id) return true;
        }
    }
@endphp

@section('content')
    <div>
        <div class="flex flex-col justify-center items-center mt-4">
            <h1 class="mb-2">Đăng ký khóa học private bằng code</h1>
            <form action="/student/join-course-private" method="post" class="flex">
                @csrf
                <input type="text" name="code" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                <input type="hidden" name="student_id" value="{{Auth::user()->id}}">
                <button class="bg-slate-600 text-white p-2 rounded-lg" type="submit">Đăng ký</button>
            </form>
        </div>
        <div>
            <h2 class="text-4xl font-semibold my-3 text-center">Đăng ký khoá học</h2>
        </div>
        <div class="my-6 bg-white mx-4">
            <table class="w-full">
                <thead>
                    <?php $thClass = 'bg-yellow-400 text-white px-4 py-3'; ?>
                    <tr class="text-md font-semibold">
                        <th class="{{ $thClass }}">Khóa học</th>
                        <th class="{{ $thClass }}">Giáo viên</th>
                        <th class="{{ $thClass }}">Miêu tả</th>
                        <th class="{{ $thClass }}">Loại</th>
                        <th class="{{ $thClass }}">Code</th>
                        <th class="{{ $thClass }}">Số học sinh</th>
                        <th class="{{ $thClass }}">Đăng ký</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $tdClass = 'text-center px-4 py-3'; ?>
                    @foreach ($listCourse as $item)
                        <tr class="hover:bg-yellow-100">
                            <td class="{{ $tdClass }}">
                                {{ $item->name }}
                            </td>
                            <td class="{{ $tdClass }}">{{ $item->teacher_name }}</td>
                            <td class="{{ $tdClass }}">{{ $item->description}}</td>
                            <td class="{{ $tdClass }}">{{ $item->privacy}}</td>
                            <td class="{{ $tdClass }}">{{ $item->code}}</td>
                            <td class="{{ $tdClass }}">{{ $item->number_student}} người</td>
                            <td class="{{ $tdClass }} flex justify-center">
                                <form action="/student/join-course/" method="post">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{$item->id}}">
                                    <input type="hidden" name="student_id" value="{{Auth::user()->id}}">
                                    @if (inArray($item->id, $joinedCourses))
                                        <button class="bg-slate-300 text-black p-2 rounded-lg" type="submit" disabled>Đã đăng ký</button>
                                    @else
                                        <button class="bg-slate-600 text-white p-2 rounded-lg" type="submit">Đăng ký</button>
                                    @endif
                                </form>
                                <a class="bg-slate-600 text-white p-2 rounded-lg" href="/course/forum/{{$item->id}}">Vào nhóm chat</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection