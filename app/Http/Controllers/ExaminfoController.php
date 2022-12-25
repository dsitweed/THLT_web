<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Examinfo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'question_lenth' => ['integer' ,'gt:0'],
            'time' => ['integer', 'gt:0'],
            'user_id' => ['required']
        ]);

        $examinfo = Examinfo::create([
                'name' => $request->input('name'),
                'teacher_id' => $teacher->id,
                'course_id' => $request->input('course_id'),
                'question_lenth' => $request->input('question_lenth'),
                'time' => $request->input('time')
            ]);
        return view('makequestion.create', ['examinfo' => $examinfo]);
    }

}
