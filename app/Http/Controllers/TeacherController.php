<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\Examinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{

    public function showAllExams() {

        $teacher = Teacher::where('user_id', Auth::user()->id)->get();
        if (count($teacher) != 1) {
            return abort(403);
        }

        $listExams = Examinfo::where('teacher_id', $teacher[0]->id)->get();
        foreach($listExams as $key => $value) {
            $course = Course::find($value->course_id);
            $listExams[$key]->course_name = $course->name; 
        }
        return view('teacher.showAllExams', ['listExams' => $listExams]);
    }
}
