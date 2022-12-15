@extends('layouts.app')

{{--
    Sẽ nhận được 1 array đủ các thông tin ở dưới đặt tạm tên là $listExams 
 --}}
@php
    $listExams = [];
@endphp

@section('content')
    <div class="mx-3">
        <div class="filter flex justify-between">
            <div class="search w-1/3 relative hidden md:block">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Search icon</span>
                </div>
                <input type="text" id="search-navbar" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search...">
            </div>
            <div class="">
                <select name="" id="" data-palaceholder="Filters"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                >
                    <option value="math">Math</option>
                    <option value="physic">Physic</option>
                </select>
            </div>
        </div>
        
        <div class="body my-2">
            <table class="table-fixed w-full border border-spacing-2 border-collapse border-slate-400">
                <thead>
                    <?php $thClass = "border p-2 border-slate-400" ?>
                    <tr>
                        <th class="{{$thClass}}">Exam Id</th>
                        <th class="{{$thClass}}">Course Id</th>
                        <th class="{{$thClass}}">Course name</th>
                        <th class="{{$thClass}}">Uniqueid of Exam</th>
                        <th class="{{$thClass}}">Question number</th>
                        <th class="{{$thClass}}">Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $tdClass = "text-center border border-slate-400 p-2" ?>
                    @for ($i = 0; $i < 4; $i++)
                        <tr>
                            <td class="{{$tdClass}}">{{$i}}</td>
                            <td class="{{$tdClass}}">12</td>
                            <td class="{{$tdClass}}">Math</td>
                            <td class="{{$tdClass}}">123Mh</td>
                            <td class="{{$tdClass}}">50</td>
                            <td class="{{$tdClass}}">90 minute</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
            
        </div>
        <div class="pagination flex justify-between my-5 items-center">
            <div>
                <p>Showing 1 to <strong>10</strong> of <strong>30</strong> results</p>
            </div>
            <div>
                <a class="border-gray-300 border focus:border-indigo-500 rounded-md shadow-sm border-solid p-3" href="#">
                    &laquo;
                </a>
                {{-- {{$listExams->links()}} --}}
               @for ($i = 1; $i < 4; $i++)
                
                <a class="border-gray-300 border border-collapse active:bg-slate-400 focus:border-indigo-500 rounded-md shadow-sm justify-center items-center border-solid p-3" href="#">
                    {{$i}}
                </a>
               @endfor
                <a class="border border-gray-300 focus:border-indigo-500 rounded-md shadow-sm justify-center border-solid p-3" href="#">
                    &raquo;
                </a>
            </div>
        </div>
    </div>
@endsection