<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Course;

class CoursesController extends Controller
{
    public function index()
    {
    	$courses = Course::orderBy('course_id', 'ASC')->get();
    	return view('admin.courses.index' , compact('courses'));
    }
    public function create()
    {
    	$categories = Course::where('course_id' , '=' , null)->get();
    	$allCategories = Course::pluck('name','id');
    	return view('admin.courses.create' , compact('allCategories' , 'categories'));
    }
    public function store(Request $request)
    {
    	$request->validate([
    		'name' => 'required|min:3|max:20',
            'course_id' => 'nullable'
    	]);

    	$course = new Course;
    	$course->name = $request->name;
    	if($request->has('courses_id')){
    	$course->course_id = $request->courses_id;   		
    	} else {
    	$course->course_id = null;
    	}

    	$course->save();

    	return back()->with('flash' , 'Curso creado satisfactoriamente');
    }
    public function edit(Course $course)
    {
    	$categories = Course::where('course_id' , '=' , null)->get();
    	$allCategories = Course::pluck('name','id');
    	
    	return view('admin.courses.edit' , compact('course' , 'categories' , 'allCategories'));
    }
    public function update(Request $request , Course $course)
    {
    	$request->validate([
            'name' => 'required|min:3|max:20',
            'course_id' => 'nullable'
        ]);
        $course->name = $request->name;
        if($request->has('courses_id')){
        $course->course_id = $request->courses_id;          
        } else {
        $course->course_id = null;
        }
        $course->save();
        return back()->with('flash' , 'Curso actualizado satisfactoriamente');
    }
    public function delete(Course $course)
    {
        $course->delete();

        return back()->with('flash' , 'Curso eliminado satisfactoriamente');
    }
}
