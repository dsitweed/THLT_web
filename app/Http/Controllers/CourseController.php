<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index () {
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();
        $listCourse = Course::where('teacher_id', $teacher->id)->get();

        return view('course.index')->with('listCourse', $listCourse);;
    }

    public function create() {
        return view('course.create');
    }

    public function store(Request $request) {
        $teacher = Teacher::where('user_id', Auth::user()->id)->first();

        $formField = $request->validate([
            'course_name' => Rule::unique('courses', 'name')
        ]);
        $bytes = random_bytes(5);
        $randomCode = bin2hex($bytes);
        Course::create([
            'name' => $_POST['course_name'] ,
            'description' => $_POST['course_description'],
            'privacy' => $_POST['privacy'],
            'code' =>  ($_POST['privacy'] == 'private' ? $randomCode : null),
            'teacher_id' => $teacher->id,
        ]);        

        return redirect('/course');
    }

}
