@extends('layouts.app')

{{-- Lấy $listCourse from teacherController   
 --}}
@php
    // dd($listCourse);
@endphp

@section('content')
    <div>
        <div>
            <h2 class="text-4xl font-semibold my-3 text-center">Các nhóm chat</h2>
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
                    </tr>
                </thead>
                <tbody>
                    <?php $tdClass = 'text-center px-4 py-3'; ?>
                    @foreach ($listCourse as $item)
                        <tr class="hover:bg-yellow-100">
                            <td class="{{ $tdClass }}">
                                <a href="/course/forum/{{$item->id}}">{{ $item->name }}</a>
                            </td>
                            <td class="{{ $tdClass }}">{{ $item->teacher_name }}</td>
                            <td class="{{ $tdClass }}">{{ $item->description}}</td>
                            <td class="{{ $tdClass }}">{{ $item->privacy}}</td>
                            <td class="{{ $tdClass }}">{{ $item->code}}</td>
                            <td class="{{ $tdClass }}">{{ $item->number_student}} người</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection