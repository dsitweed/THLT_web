@extends('layouts.app')

{{-- Nhận 1 biến $listCourse array kiểu Model Course --}}

@php
    if (!isset($listCourse)) {
        $listCourse = [];
    }
@endphp

@section('content')
    <div class="mx-2">
        <table class="table-fixed w-full border border-spacing-2 border-collapse border-slate-400">
            <thead>
                <?php $thClass = "border p-2 border-slate-400" ?>
                <tr>
                    <th class="{{$thClass}}">ID khóa học</th>
                    <th class="{{$thClass}}">Tên khóa học</th>
                    <th class="{{$thClass}}">Loại</th>
                    <th class="{{$thClass}}">Mã code</th>
                    <th class="{{$thClass}}">Miêu tả khóa học</th>
                    <th class="{{$thClass}}">Số học sinh</th>
                    {{-- <th class="{{$thClass}}">Số học sinh đang tham gia</th> --}}
                </tr>
            </thead>
            <tbody>
                <?php $tdClass = "text-center border border-slate-400 p-2" ?>
                @foreach ($listCourse as $item)
                    <tr>
                        <td class="{{$tdClass}}">{{$item->id}}</td>
                        <td class="{{$tdClass}}">{{$item->name}}</td>
                        <td class="{{$tdClass}}">{{$item->privacy}}</td>
                        <td class="{{$tdClass}}">{{$item->code}}</td>
                        <td class="{{$tdClass}}">{{$item->description}}</td>
                        <td class="{{$tdClass}}">
                        @php
                            $number_student = App\Models\JoinCourse::where('id', $item->id)->get()->count();
                            echo $number_student;
                        @endphp
                        </td>
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
