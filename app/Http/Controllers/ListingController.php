<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    // Show all courses
    public function index(Request $request){
        // dd($request->tag);
        return view('course.course-index',[
            // 'listings' => Listing::all()
            'listings'=> Course::latest()->filter(request(['tag','search']))->get()
        ]);
    }
    // Show single course
    public function show(Course $listing){
        return view('course.show', [
            //variable_name => values
            'listing' => $listing
        ]);
    }
}
