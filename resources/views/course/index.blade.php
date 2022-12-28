@extends('layouts.app')

{{-- Nhận 1 biến $listCourse array kiểu Model Course --}}

@php
    if (!isset($listCourse)) {
        $listCourse = [];
    }
@endphp

@section('content')
    <div class="p-3 flex-1 bg-slate-100">
        <div class="my-6 bg-white mx-4">
            <table class="w-full">
                <thead>
                    <?php $thClass = 'bg-yellow-400 text-white px-4 py-3'; ?>
                    <tr class="text-md font-semibold">
                        <th class="{{ $thClass }}">ID khóa học</th>
                        <th class="{{ $thClass }}">Tên khóa học</th>
                        <th class="{{ $thClass }}">Miêu tả khóa học</th>
                        {{-- <th class="{{$thClass}}">Số học sinh đang tham gia</th> --}}
                    </tr>
                </thead>
                <tbody>
                    <?php $tdClass = 'text-center px-4 py-3'; ?>
                    @foreach ($listCourse as $item)
                        <tr class="hover:bg-yellow-100">
                            <td class="{{ $tdClass }}">{{ $item->id }}</td>
                            <td class="{{ $tdClass }}">{{ $item->name }}</td>
                            <td class="{{ $tdClass }}">{{ $item->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
