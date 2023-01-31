<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Examinfo;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Nette\Utils\Arrays;

class ExaminfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('examinfo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $teacher = Teacher::where('user_id', $request->input('user_id'))->first();

        $formField = $request->validate([
            'name' => Rule::unique('examInfos', 'name'),
            'question_lenth' => ['integer', 'gt:0'],
            'time' => ['integer', 'gt:0'],
            'user_id' => ['required'],
            'course_id' => ['required'],
        ]);

        $questions = Question::where('course_id', $request->input('course_id'))->get()->toArray();

        if ((count($questions) < $request->input('question_lenth')) && ($request->input('action') == 'random')) {
            return view('makequestion.createRandom',
                [
                    'error' => "Kho đề không đủ câu hỏi",
                    'questions' => []
                ]
            );
        }

        $examinfo = Examinfo::create([
            'name' => $request->input('name'),
            'teacher_id' => $teacher->id,
            'course_id' => $request->input('course_id'),
            'question_lenth' => $request->input('question_lenth'),
            'time' => $request->input('time')
        ]);

        if ($request->input('action') == 'random') {
            return view('makequestion.createRandom', [
                'questions' => $questions,
                'examinfo' => $examinfo,
            ]);
        }
        // $request->input('action') == 'default' là tạo đề thủ công 
        return view('makequestion.create', ['examinfo' => $examinfo]);
    }

    function storeRandomExam(Request $request)
    {
        $exam_id = $request->input('exam_id');
        $exam_length = $request->input('exam_length');
        $course_id = $request->input('course_id');
        
        $array = $request->input('select') ?? [];
        if (count($array) < $exam_length) {
            return view('error.index',["error" => "Số câu lựa chọn quá ít"]);
        }
        shuffle($array);
        for ($i = 0; $i < $exam_length; $i++) {
            $question = Question::find($array[$i]);
            Question::create([
                'exam_id' => $exam_id,
                'course_id' => $course_id,
                'question' => $question['question'],
                'answer' => $question['answer'],
                'choice1' => $question['choice1'],
                'choice2' => $question['choice2'],
                'choice3' => $question['choice3'],
                'choice4' => $question['choice4']
            ]);
        }
        return redirect("/makequestion/$exam_id/edit");
    }
}
