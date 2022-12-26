@extends('layouts.app')

{{--
    Sẽ nhận được 1 array đủ các thông tin ở dưới đặt tạm tên là $listExams
 --}}
@php
    // dd($listExams);
    $subject = App\Models\Course::all();
    if (isset($_GET['filterSubject'])) {
        $subjectFilter = $_GET['filterSubject'];
        $tmp = [];
        foreach ($listExams as $key => $value) {
            if ($value->course_name == $subjectFilter) {
                $tmp[] = $value;
            }
        }
        $listExams = $tmp;
    }
@endphp

@section('content')
    <div class="p-3 flex-1 bg-slate-100">
        <div class="filter flex justify-between">
            <div class="search w-1/3 relative hidden md:block">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Search icon</span>
                </div>
                <input type="text" id="search-navbar"
                    class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search...">
            </div>
            <div class="">
                <form class="flex flex-row" id="filter" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
                    <select name="filterSubject" id="" data-palaceholder="Filters"
                        class="block min-w-fit bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option <?php if (isset($_GET['filterSubject'])) {
                            echo 'hidden';
                        } ?> selected>
                            {{ isset($_GET['filterSubject']) ? $_GET['filterSubject'] : 'Select' }}</option>
                        @foreach ($subject as $item)
                            <option value="{{ $item->name }}">
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                    <button
                        class="bg-gray-50 ml-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        type="submit">
                        filter
                    </button>
                </form>
            </div>
        </div>

        <div class="my-6 bg-white mx-4">
            <table class="w-full">
                <thead>
                    <?php $thClass = 'bg-yellow-400 text-white px-4 py-3'; ?>
                    <tr class="text-md font-semibold">
                        <th class="{{ $thClass }}">Tên bài thi</th>
                        <th class="{{ $thClass }}">Tên khóa học</th>
                        <th class="{{ $thClass }}">Số câu hỏi</th>
                        <th class="{{ $thClass }}">Thời gian</th>
                        <th class="{{ $thClass }}">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $tdClass = 'text-center px-4 py-3'; ?>
                    @foreach ($listExams as $item)
                        <tr class="hover:bg-yellow-100">
                            <td class="{{ $tdClass }}">{{ $item->name }}</td>
                            <td class="{{ $tdClass }}">{{ $item->course_name }}</td>
                            <td class="{{ $tdClass }}">{{ $item->question_lenth }}</td>
                            <td class="{{ $tdClass }}">{{ $item->time }} minute</td>
                            <td class="{{ $tdClass }} flex flex-row justify-center">
                                <form action="/makequestion/{{ $item->id }}/edit" method="get">
                                    <button class="p-2 hover:bg-green-100 rounded-full text-green-600" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path
                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z">
                                            </path>
                                            <path d="M16 5l3 3"></path>
                                        </svg>
                                    </button>
                                </form>
                                <form action="/teacher/show-student-result/{{ $item->id }}" method="get">
                                    <button class="p-2 hover:bg-blue-100 rounded-full text-blue-600" type="submit"><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-report-analytics" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path
                                                d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2">
                                            </path>
                                            <rect x="9" y="3" width="6" height="4"
                                                rx="2"></rect>
                                            <path d="M9 17v-5"></path>
                                            <path d="M12 17v-1"></path>
                                            <path d="M15 17v-3"></path>
                                        </svg></button>
                                </form>
                                <button class="p-2 hover:bg-red-100 rounded-full text-red-600" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash"
                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <line x1="4" y1="7" x2="20" y2="7"></line>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
