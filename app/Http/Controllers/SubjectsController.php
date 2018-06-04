<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Course;
class SubjectsController extends Controller
{
    public function index(Course $course , Subject $subject)
    {
    	
    	return view('subjects.index' , compact('subject' , 'course'));
    }

    public function update(Subject $subject)
    {
    	return "ok";
    }
}
