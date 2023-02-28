<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    // Show all courses
    public function index(Request $request){
        // dd($request->tag);
        if (Auth::user()->role == 'teacher') {
            return view('course.course-index',[
                // 'listings' => Listing::all()
                'listings'=> Course::latest()->filter(request(['tag','search']))->get()
            ]);
        }
        return view('course.course-index',[
            // 'listings' => Listing::all()
            'listings'=> Course::latest()->where('privacy','public')->filter(request(['tag','search']))->get()
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
