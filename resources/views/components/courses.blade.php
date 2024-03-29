@php
    use App\Models\Course;
    use App\Models\Teacher;
    if (!isset($listCourse)) {
        $teacher = Teacher::where('user_id', Auth::user()->id)->get();
        $teacher = Teacher::where('user_id', Auth::user()->id)->get();
        if (count($teacher) != 1) {
            return abort(403);
        }
        $listCourse = Course::where('teacher_id', $teacher[0]->id)->get();
    }
@endphp

<div class="mx-2">
    <table class="table-fixed w-full border border-spacing-2 border-collapse border-slate-400">
        <thead>
            <?php $thClass = 'border p-2 border-slate-400'; ?>
            <tr>
                <th class="{{ $thClass }}">ID khóa học</th>
                <th class="{{ $thClass }}">Tên khóa học</th>
                <th class="{{ $thClass }}">Nhãn</th>
                <th class="{{ $thClass }}">Loại</th>
                <th class="{{ $thClass }}">Mã code</th>
                <th class="{{ $thClass }}">Miêu tả khóa học</th>
                <th class="{{ $thClass }}">Số học sinh</th>
                {{-- <th class="{{$thClass}}">Số học sinh đang tham gia</th> --}}
            </tr>
        </thead>
        <tbody>
            <?php $tdClass = 'text-center border border-slate-400 p-2'; ?>
            @foreach ($listCourse as $item)
                <tr>
                    <td class="{{ $tdClass }}">{{ $item->id }}</td>
                    <td class="{{ $tdClass }}">{{ $item->name }}</td>
                    <td class="{{ $tdClass }}">{{ $item->tag }}</td>
                    <td class="{{ $tdClass }}">{{ $item->privacy }}</td>
                    <td class="{{ $tdClass }}">{{ $item->code }}</td>
                    <td class="{{ $tdClass }}">{{ $item->description }}</td>
                    <td class="{{ $tdClass }}">
                        @php
                            $number_student = App\Models\JoinCourse::where('id', $item->id)
                                ->get()
                                ->count();
                            echo $number_student;
                        @endphp
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
