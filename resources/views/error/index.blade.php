@extends('layouts.app')

@section('content')
    @if (isset($error))
        <div class="p-4">
            <p class="text-lg">{{$error}}</p>
            <a class="font-bold" href="/">Quay trờ lại trang chủ</a>
        </div>
    @else
        
    @endif
@endsection