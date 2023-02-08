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

class PostController extends Controller
{
    public function index () {
        
    }

    public function create() {
    }

    public function store(Request $request) {
        $formField = $request->validate([
            'title' => ['required', Rule::unique('posts', 'title')],
            'body' => ['required'],
            'course_id' => ['required']
        ]);

        $formField['like'] = 0;
        $formField['user_id'] = Auth::user()->id;
        Post::create($formField);
        return redirect()->back();
    }

    public function storeReply(Request $request) {
        $commenter = User::find($request->commenter_id);
        Reply::create([
            "post_id" => $request->post_id,
            "body" => $request->reply_body,
            "like" => 0,
            "commenter_id" => $request->commenter_id,
            "commenter_name" => $commenter->name,
        ]);
        return redirect()->back();
    }

    public function addLikePost(Request $request) {
        Post::find($request->post_id)->increment('like', 1);
        return redirect()->back();
    }

    public function removeLikePost(Request $request) {
        Post::find($request->post_id)->decrement('like', 1);
        return redirect()->back();
    }
}
