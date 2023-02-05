<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Reply;
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
            'course_name' => Rule::unique('courses', 'name'),
        ]);
        $bytes = random_bytes(5);
        $randomCode = bin2hex($bytes);
        Course::create([
            'name' => $_POST['course_name'] ,
            'description' => $_POST['course_description'],
            'privacy' => $_POST['privacy'],
            'code' =>  ($_POST['privacy'] == 'private' ? $randomCode : null),
            'tag' => $_POST['course_tag'],
            'teacher_id' => $teacher->id,
        ]);        

        return redirect('/course')->with('message', 'Đã tạo khóa học mới thành công !');
    }

    public function showCourseForum($course_id) {
        $listPost = Post::where('course_id', $course_id)->get();
        foreach ($listPost as $key => $value) {
            $listReply = Reply::where('post_id', $value->id)->get();
            $listPost[$key]->listReply = $listReply;    

            $owner = User::find($value->user_id);
            $listPost[$key]->owner = $owner->name;
        }

        return view('course.forum', [
            "listPost" => $listPost,
        ]);
    }
}
