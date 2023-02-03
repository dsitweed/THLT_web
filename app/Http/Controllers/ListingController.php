<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    // Show all courses
    public function index(){
        return view('course.course-index',[
            // 'listings' => Listing::all()
            'listings'=> Course::all()
        ]);
    }
    // Show single course
    public function show(Listing $listing){
        return view('course.show', [
            //variable_name => values
            'listing' => $listing
        ]);
    }
}
