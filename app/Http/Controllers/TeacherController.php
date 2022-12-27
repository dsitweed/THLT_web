<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Result;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Examinfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{

    public function showAllExams(Request $request) {

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

    public function showStudentResult($exam_id) {
        $exam = Examinfo::find($exam_id);
        $listResult = Result::where('exam_id', $exam_id)->get(); 

        foreach ($listResult as $key => $value) {
            $student = Student::find($value->student_id);
            $user = User::find($student->user_id);
            $listResult[$key]->student_name = $user->name;
        }

        return view('teacher.showStudentResult', [
            'listResult' => $listResult,
            'exam' => $exam,
        ]);
    }
}
