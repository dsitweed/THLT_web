<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Course;
use App\Models\Result;
use App\Models\Student;
use App\Models\Examinfo;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    public function index()
    {
        $student = Student::where('user_id', Auth::user()->id)->first();
        $listResult = Result::where('student_id', $student->id)->get();

        foreach ($listResult as $key => $value) {
            $exam = Examinfo::find($value->exam_id);
            $course = Course::find($exam->course_id);
            $listResult[$key]->exam_id = $exam->id;
            $listResult[$key]->exam_name = $exam->name;
            $listResult[$key]->exam_time = $exam->time;
            $listResult[$key]->question_lenth = $exam->question_lenth;
            $listResult[$key]->course_name = $course->name;
        }

        return view('result.index', [
            'listResult' => $listResult,
        ]);
    }

    public function show($result_id)
    {
        $result = Result::where('id', $result_id)->get();
        $score = $result->value('score');
        $max_score = Examinfo::where('id', $result->value('exam_id'))->value('question_lenth');
        $resultDetail = Answer::where('result_id', $result_id)->get();
        foreach ($resultDetail as $key => $value) {
            $question = Question::find($value->question_id);
            $resultDetail[$key]->question = $question->question;
            $resultDetail[$key]->choice1 = $question->choice1;
            $resultDetail[$key]->choice2 = $question->choice2;
            $resultDetail[$key]->choice3 = $question->choice3;
            $resultDetail[$key]->choice4 = $question->choice4;
            $resultDetail[$key]->answer = $question->answer;
        }
        return view('result.show', [
            'resultDetail' => $resultDetail,
            'score' => $score,
            'maxScore' => $max_score
        ]);
    }
}
