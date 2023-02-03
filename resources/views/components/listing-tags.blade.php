@props(['tagsCsv'])
@php
//Takes the string value => slice it and store it in the tag array
    $tags = explode(',',$tagsCsv);
@endphp
<script>console.log($tags);</script>
<ul class="flex">
    @foreach($tags as $tag)
    <li
        class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs"
    >
        <a href="/?tag={{$tag}}">{{$tag}}</a>
    </li>
    @endforeach
</ul>