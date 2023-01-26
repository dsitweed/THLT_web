@extends('layouts.app')

{{-- $listPost  from CourseController
    $listPost gồm các trường:
    các trường của Post như db
    thêm trường listReply - là list Reply như db
    thêm trường owner - tên của người viết cái post này (tại sao ko để owner_name ? vì nghĩ sau này sẽ mở rộng ra, hoặc là đéo.)
--}}
@php
    $slice = explode('/', Request::url());
    $course_id = $slice[count($slice) - 1];

@endphp

<script>
    function toggleComment(id) {
        $el = document.getElementById(`item-${id}`);
        if ($el.style.display == 'block') {
            $el.style.display = 'none';
        } else {
            $el.style.display = 'block'
        }
    }
</script>

@section('content')
    <div class="bg-slate-100 min-h-screen py-6">
        <span class="sticky top-8">
            <a href="#create-post" class="px-3 py-4 bg-blue-500 text-white rounded ml-6">Tạo bài viết</a>
        </span>
        <h1 class="text-center text-4xl">Forum</h1>
        <div class="flex flex-col items-center gap-5">
            <form action="/post/store" method="post" id="create-post"
                class="flex flex-col justify-center mt-4 bg-white rounded p-4 min-w-[640px]">
                <h1 class="text-3xl font-bold">Bài viết mới</h1>
                @csrf
                <div class="">
                    <input class="px-0 text-xl" type="text" placeholder="Chủ đề" name="title">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <input class="px-0 text-base" type="text" placeholder="Nội dung" name="body">
                    @error('body')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <input type="text" hidden value={{ $course_id }} name="course_id">
                <button class="px-4 py-3 bg-blue-500 text-white mt-2 rounded" type="submit">Tạo bài viết mới</button>
            </form>
            @foreach ($listPost as $item)
                <div class="bg-white rounded p-4 min-w-[640px]">
                    <div class="inline-flex justify-between w-full">
                        <span class="text-sm font-semibold">{{ $item->owner }}</span><br>
                        <span class="text-sm text-slate-500">{{ $item->created_at }}</span>
                    </div>
                    <h2 class="text-lg font-semibold mt-2">{{ $item->title }}</h2>
                    <div class="text-sm">
                        {{-- Body post --}}
                        <p>{{ $item->body }}</p>
                    </div>

                    <div class="inline-flex w-full mt-2 text-slate-600">
                        <button
                            class="inline-flex items-center justify-center w-1/2 px-3 py-2 hover:bg-slate-100 text-sm font-semibold rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-thumb-up"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M7 11v8a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-7a1 1 0 0 1 1 -1h3a4 4 0 0 0 4 -4v-1a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 3 0 0 1 -2 2h-7a3 3 0 0 1 -3 -3">
                                </path>
                            </svg>
                            <span class="ml-2">
                                Thích
                            </span>
                        </button>
                        <button
                            class="inline-flex items-center justify-center w-1/2 px-3 py-2 hover:bg-slate-100 text-sm font-semibold rounded"
                            onclick="toggleComment({{ $item->id }})">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-2"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path
                                    d="M12 20l-3 -3h-2a3 3 0 0 1 -3 -3v-6a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-2l-3 3">
                                </path>
                                <path d="M8 9l8 0"></path>
                                <path d="M8 13l6 0"></path>
                            </svg>
                            <span class="ml-2">
                                {{ count($item->listReply) }} Bình luận
                            </span>
                        </button>

                    </div>

                    <div id="item-{{ $item->id }}" style="display: none">
                        {{-- reply list --}}
                        <form class="mt-3 inline-flex w-full border border-slate-400 text-sm" action="/post/storeReply"
                            method="post">
                            @csrf
                            <input id="write-{{ $item->id }}" class="flex-1" placeholder="Viết bình luận"
                                type="text" name="reply_body" class="border border-black" required>
                            <input type="text" hidden value="{{ $item->id }}" name="post_id">
                            <input type="text" hidden name="commenter_id" value="{{ Auth::user()->id }}">
                            <button class="px-3 py-2 bg-blue-600 text-white" type="submit">
                                Trả lời
                            </button>
                        </form>
                        @foreach ($item->listReply as $reply)
                            <div class="bg-slate-100 my-2 px-4 py-3 rounded text-sm">
                                <span class="inline-flex w-full justify-between gap-2 ">
                                    <p class="font-semibold">
                                        {{ $reply->commenter_name }}
                                    </p>
                                    <p class="text-slate-500">{{ $reply->created_at }}</p>
                                </span>
                                <p>{{ $reply->body }}</p>
                            </div>
                        @endforeach
                        <a class="text-sm font-semibold text-slate-500" href="#write-{{ $item->id }}">Viết trả
                            lời...</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
