@extends('layouts.app')

{{-- Nhận 1 biến $listCourse array kiểu Model Course --}}

@php
    if (!isset($listCourse)) $listCourse = [];
@endphp

@section('content')
    <div>
        <table class="table-auto">
            <thead>
                <tr>
                    <th>Course id</th>
                    <th>Course name</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listCourse as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->description}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection