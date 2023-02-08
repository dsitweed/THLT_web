<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Answer;
use App\Models\Course;
use App\Models\Result;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\ExamInfo;
use App\Models\JoinCourse;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{

    public function showAllExams(Request $request)
    {

        $teacher = Teacher::where('user_id', Auth::user()->id)->get();
        if (count($teacher) != 1) {
            return abort(403);
        }

        $listExams = Examinfo::where('teacher_id', $teacher[0]->id)->get();

        foreach ($listExams as $key => $value) {
            $course = Course::find($value->course_id);
            $listExams[$key]->course_name = $course->name;
        }
        return view('teacher.showAllExams', ['listExams' => $listExams]);
    }

    public function showStudentResult($exam_id)
    {
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

    public function showStudentResultDetail(Request $request) {
        $student_id = $request->student_id;
        $result_id = $request->result_id;
        $score = Result::where('id', $result_id)->value('score');
        $user_id = Student::where('id', $student_id)->value('user_id');
        $student_name = User::where('id', $user_id)->value('name'); 
        $listResult =  Answer::where('student_id', $student_id)->where('result_id', $result_id)->get();
        foreach ($listResult as $key => $value) {
            $question = Question::find($value->question_id);
            $listResult[$key]->question = $question;
        }
        $listResult->score = $score;
        $listResult->student_name = $student_name;
        return view('teacher.showStudentResultDetail', ['listResult' => $listResult]);
    }

    public function showForum() {
        $user = Auth::user();
        if ($user->role != 'teacher') return abort(403);
        $teacherId = Teacher::where('user_id', $user->id)->value('id');
        $listCourse = Course::where('teacher_id', $teacherId)->orWhere('privacy', 'public')->get();
        foreach ($listCourse as $key => $value) {
            $value['number_student'] = JoinCourse::where('course_id', $value->id)->count();

            $tmp = Teacher::where('id', $value->teacher_id)->value('user_id');
            $value['teacher_name'] = User::where('id', $tmp)->value('name');
        }
        return view('teacher.showForum',[
            'listCourse' => $listCourse
        ]);
    }
}
