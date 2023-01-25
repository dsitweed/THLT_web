@extends('layouts.app')

{{-- $listPost  from CourseController 
    $listPost gồm các trường:
    các trường của Post như db
    thêm trường listReply - là list Reply như db
    thêm trường owner - tên của người viết cái post này (tại sao ko để owner_name ? vì nghĩ sau này sẽ mở rộng ra, hoặc là đéo.)
--}}
@php
    $slice = explode('/',Request::url());
    $course_id = $slice[count($slice) - 1];
   
@endphp

<script>
    function showReply(id) {
        $form = document.getElementById(`reply-${id}`);
        if ($form.style.display === 'none') {
            $form.style.display = 'block';
        }
    }
    function hideReply(id) {
        $form = document.getElementById(`reply-${id}`);
        $form.style.display = 'none';
    }
</script>

@section('content')
    <div>
        <h1 class="text-center text-4xl">This is forum</h1>
        <div class="flex flex-col items-center gap-5">
            @foreach ($listPost as $item)
                <div>
                    <h2>Tiêu đề: {{$item->title}}</h2>
                    <div>
                        <span>Người đăng: {{$item->owner}}</span><br>
                        <span>Thời gian đăng: {{$item->created_at}}</span>
                    </div>
                    <div>
                        {{-- Body post --}}
                        <p>{{$item->body}}</p>
                    </div>
                    <div>
                        {{-- reply list --}}
                        @if (count($item->listReply) > 0)
                            <p class="mb-2">Các bình luận: </p>
                        @endif
                        @foreach ($item->listReply as $reply)
                            <div>
                                <p>{{$reply->body}}</p>
                                <p>{{$reply->commenter_name}}</p>
                            </div>
                        @endforeach
                    </div>
                   <button class="bg-green-700" onclick='showReply({{$item->id}})'>Reply</button>
                   <form action="/post/storeReply" method="post" id="reply-{{$item->id}}" style="display: none">
                        @csrf
                        <input type="text" name="reply_body" class="border border-black" required>
                        <input type="text" hidden value="{{$item->id}}" name="post_id">
                        <input type="text" hidden name="commenter_id" value="{{Auth::user()->id}}">
                        <button type="submit">
                            Trả lời
                        </button>
                   </form>
                </div>
            @endforeach
        </div>
        <form action="/post/store" method="post" class="flex flex-col justify-center mt-4">
            @csrf
            <div>
                <input type="text" placeholder="chủ đề" name="title">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <input type="text" placeholder="Nội dung" name="body">
                @error('body')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <input type="text" hidden value={{$course_id}} name="course_id">
            <button type="submit">Đăng</button>
        </form>
    </div>
@endsection