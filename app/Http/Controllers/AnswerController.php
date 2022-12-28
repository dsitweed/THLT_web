<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Result;
use App\Models\Student;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function store(Request $request)
    {

        $student_id = $_POST['student_id']; // 1
        $exam_id = $_POST['exam_id']; // 1
        $question_id = $_POST['question_id']; // Array

        $true_answer = $_POST['true_answer']; // Array
        $given_answer = [];

        for ($i = 0; $i < sizeof($true_answer); $i++) {
            $cmp = "answer" . $i;
            if (isset($_POST[$cmp])) $given_answer[] = $_POST[$cmp];
        }

        // chưa báo được lỗi khi không trả lời đủ câu hỏi
        if (count($true_answer) != count($given_answer)) {
            return redirect(url()->previous())->with('error', "not answer full");
        }

        $score = 0;
        foreach ($true_answer as $key => $value) {
            if ($value == $given_answer[$key]) {
                $score++;
            }
        }

        $result = Result::create([
            'student_id' => $student_id,
            'exam_id' => $exam_id,
            'score' => $score,
        ]);

        foreach ($question_id as $key => $value) {
            $answer = Answer::create([
                'student_id' => $student_id,
                'question_id' => $value,
                'exam_id' => $exam_id,
                'result_id' => $result->id,
                'given_answer' => $given_answer[$key]
            ]);
        }

        return redirect("/result/$result->id");
    }
}
