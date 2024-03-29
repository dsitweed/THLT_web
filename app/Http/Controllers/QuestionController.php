<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExamInfo;
use App\Models\Question;


class questionController extends Controller
{

    public function index()
    {
        //
        //$trapleSelect=Examinfo::find();
    }


    public function create()
    {
        //
        return view('makequestion.create');
    }


    public function store(Request $request)
    {
        $question = Question::create([
                'exam_id' => $request->input('examId'),
                'course_id' => $request->input('course_id'),
                'question' => $request->input('question'),
                'choice1' => $request->input('option1'),
                'choice2' => $request->input('option2'),
                'choice3' => $request->input('option3'),
                'choice4' => $request->input('option4'),
                'answer' => $request->input('answer')
        ]);


        $id = $question->exam_id;

        $questionCount = Question::where('exam_id','=', $id)->count();

        $selectLength = Examinfo::where('id', '=', $id)->value('question_lenth');
        //return number of question in exam have id = input(examId);

        if ($questionCount < $selectLength ) {
            $examinfo = Examinfo::find($id);
            return view('makequestion.create', ['examinfo' => $examinfo, 'questionCount' => $questionCount + 1]);
        }else{
            $examinfo = Examinfo::find($id);
            return view('makequestion.index',['examinfo' => $examinfo]);
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        // for edit question 
        if (isset($_GET['submitFromEditPage'])) {
            $questionId = $id;
            $selectAll = Question::where('id',$questionId)->get();
            return view('makequestion.editOne')->with('questions',$selectAll);
        }else{ // for review all quetion 
        //this is for review teacher question
        $selectIdForQuestion = Examinfo::where('id',$id)->value('id');
        $selectQuestions = Question::where('exam_id',$selectIdForQuestion)->get();
        return view('makequestion.edit')->with('questions',$selectQuestions);
        }
    }


    public function update(Request $request, $id)
    {
        $exam_id = $request->input('exam_id');
        $update = Question::where('id',$id)->update([
                           'question' => $request->input('question'),
                           'choice1' => $request->input('choice1'),
                           'choice2' => $request->input('choice2'),
                           'choice3' => $request->input('choice3'),
                           'choice4' => $request->input('choice4'),
                           'answer' => $request->input('answer')

                        ]);
        $selectQuestions = Question::where('exam_id',$exam_id)->get();
        return view('makequestion.edit')->with('questions', $selectQuestions)->with('success', 'update success');
    }


    public function destroy($id)
    {
        //
    }
}
