<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\ExamInfo;
use App\Models\Question;
use App\Models\JoinCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

   public function showAllExams() {
    // Sau này sẽ lấy tất cả những bài test ở các khóa học mà học sinh đã đăng ký 
    // dd(Auth::user()->name);
    $user_id = Auth::user()->id;

    $listExams = [];
    $joinedCourses = JoinCourse::where('student_id', $user_id)->get();
    // 
    foreach ($joinedCourses as $key => $value) {
        $tmp = Examinfo::where('course_id', $value->course_id)->get();
        foreach ($tmp as $i => $item) {
            $listExams[] = $item;
        }
    }

    foreach ($listExams as $key => $value) {
        $course = Course::find($value->course_id);
        $listExams[$key]->course_name = $course->name;
    }
    
    foreach ($listExams as $key => $value) {
        $teacher = Teacher::find($value->teacher_id);
        $user_teacher = User::find($teacher->user_id);
        $listExams[$key]->teacher_name = $user_teacher->name;
    }
    
    // dd($listExams);
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

    public function joinCourse() {
        // Lấy toàn bộ khóa học public và các khóa học private đã đăng ký
        $listCourse = Course::where('privacy', 'public')->get();
        $student_id = Student::where('user_id', Auth::user()->id)->value('id');
        $joinedCourses = joinCourse::where('student_id', $student_id)->get();
        foreach ($joinedCourses as $key => $value) {
            $course = Course::find($value->course_id);
            if ($course->privacy == 'private') $listCourse[] = $course;
        }

        // Lấy thêm các thông tin bổ sung khác để hiển thị trên màn hình
        foreach ($listCourse as $key => $value) {
            $teacher = Teacher::find($value->teacher_id);
            $teacher_name = User::where('id', $teacher->user_id)->value('name');
            $listCourse[$key]->teacher_name = $teacher_name;
            
            $number_student = JoinCourse::where('course_id', $value->id)->get()->count();
            $listCourse[$key]->number_student = $number_student;
        }

        return view('student.joinCourse', [
            'listCourse' => $listCourse,
            'joinedCourses' => $joinedCourses,
        ]);
    }
    public function joinCourseSave(Request $request) {
        $user_id = $request->student_id;
        $student_id = Student::where('user_id', $user_id)->value('id');

        JoinCourse::create([
            'course_id' => $request->course_id,
            'student_id' => $student_id
        ]);
        return redirect(url()->current())->with('message', 'Đã đăng ký thành công !');;
    }

    public function joinCoursePrivateSave(Request $request) {
        if (isset($_POST['code'])) {
            $student_id = $request->student_id;
            $course = Course::where('code', $_POST['code'])->first();
            if ($course) {
                JoinCourse::create([
                    'course_id' => $course->code,
                    'student_id' => $student_id
                ]);
                return redirect('/');
            } else {// not have course
                return redirect('/');
            }
        }
    }
}
