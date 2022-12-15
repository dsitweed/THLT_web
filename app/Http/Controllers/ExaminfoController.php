<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Examinfo;
use Illuminate\Http\Request;

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
        //
        $examinfo= new Examinfo;
        $teacher = Teacher::where('user_id', $request->input('user_id'))->get();

        if (count($teacher) != 1) {
            return view(abort(403));
        }

        // Thiếu validate dữ liệu ở đây
        // đang lỗi nếu nhập not unique name của exam 

        $examinfo = Examinfo::create([
                'name' => $request->input('name'),
                'teacher_id' => $teacher[0]->id,
                'course_id' => $request->input('course_id'),
                'question_lenth' => $request->input('question_lenth'),
                'uniqueid' => $request->input('uniqueid'),
                'time' => $request->input('time')
            ]);

        return view('makequestion.create', ['examinfo' => $examinfo]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
