@extends('layout')
@section('content')
@include('partials._hero')
@include('partials._search')
<div
class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4"
>

    {{-- echo = {{}} --}}

@if (count($listings) == 0)
    <p>No listings found</p>
@else
@foreach($listings as $item)  
    {{-- pass $listing to listing => have to use prefix : --}}
    <x-listing-card :item="$item"/>
@endforeach
@endif
</div>
@endsection
