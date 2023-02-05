{{-- a component that can wrap around whatever we want --}}
<div {{$attributes->merge(['class'=>'bg-gray-50 border border-gray-200 rounded p-6'])}}>
    {{$slot}}
    {{-- a slot deposited for putting information --}}
    {{-- <x-card> </x-card> --}}
</div>