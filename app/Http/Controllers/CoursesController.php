<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;

class CoursesController extends Controller
{
    public function index()
    {
    	$categories = Course::where('course_id' , '=' , null)->get();
    	return view('courses.index' , compact('categories'));
    }
}
