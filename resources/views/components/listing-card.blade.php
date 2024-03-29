@props(['item'])
@php
use App\Models\Teacher;
use App\Models\User;

$teacher = Teacher::find($item->teacher_id);
$user = User::find($teacher->user_id);
@endphp

<div class="bg-gray-50 border border-gray-200 rounded p-6">
    <div class="flex">
        <img
            class="hidden w-48 mr-6 md:block"
            src="{{asset('images/no-image.png')}}"
            alt=""
        />
        <div>
            <h3 class="text-2xl">
                <a href="/listings/{{$item->id}}">{{$item->name}}</a>
            </h3>
            <div class="text-xl font-bold mb-4">
                {{$user->name}}
            </div>
            <b><x-listing-tags :tagsCsv="$item->tag" /></b>
            <div class="text-lg mt-4">
                <i class="fas fa-info"></i> {{$item->description}}
            </div>
        </div>
    </div>
</div>