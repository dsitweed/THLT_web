<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Examinfo;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

   public function showAllExams() {
    // Sau này sẽ lấy tất cả những bài test ở các khóa học mà học sinh đã đăng ký 
    // dd(Auth::user()->name);
    // $user_id = Auth::user()->id;

    $listExams = Examinfo::all();

    foreach ($listExams as $key => $value) {
        $course = Course::find($value->course_id);
        $listExams[$key]->course_name = $course->name;
    }

    foreach ($listExams as $key => $value) {
        $teacher = Teacher::find($value->teacher_id);
        $user_teacher = User::find($teacher->user_id);
        $listExams[$key]->teacher_name = $user_teacher->name;
    }

    return view('student.showAllExams', ['listExams' => $listExams]);
   }
   
   public function doExam(Request $request, $exam_id) {
    // dd($exam_id);
    $exam = Examinfo::find($exam_id);
    $course = Course::find($exam->course_id);
    $exam->course_name = $course->name; // add course name to exam parameter

    $questions = Question::where('exam_id', $exam->id)->get();
    return view('student.doExam', [
        'exam' => $exam,
        'questions' => $questions,
    ]);
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // BUG
    public function store(Request $request)
    {
        //
        $student = new Student;

        $sIdForValidate = $request->input('student_id');
        $examCodeForValidate = $request->input('exam_code');
        $initialScore=0;

        $checker = Student::where('student_id','=',$sIdForValidate)->where('uniqueid','=',$examCodeForValidate)->count();
        if ($checker > 0) {
            return "YOU ALREADY DONE THIS EXAM";
        }else{
            $student = Student::create([
            'student_id' => $request->input('student_id'),
            'uniqueid' => $request->input('exam_code'),
            'score' => $initialScore
            ]);

            $id = $request->input('exam_code');
            $studentRealId = $request->input('student_id');
            $student_id = Student::where('student_id',$studentRealId)->value('id');
            $findcourse = Examinfo::where('uniqueid',$id)->value('id');
            $findtime = Examinfo::where('uniqueid',$id)->value('time');
            $course = Examinfo::where('uniqueid',$id)->value('Course');
            $questions = Question::where('quiz_id',$findcourse)->get();
            return view('answer.show')->with('questions', $questions)->with('student_id',$student_id)->with('course',$course)->with('time',$findtime);
        }
        

        //return $this->show($request->input('exam_code'));
    }
}
