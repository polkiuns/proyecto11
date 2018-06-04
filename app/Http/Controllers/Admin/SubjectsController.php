<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subject;
use App\Course;
use App\Teacher;

class SubjectsController extends Controller
{
    public function index()
    {
        if(auth()->user()->hasRole('root')){
            $subjects = Subject::all();
        } else {
            $teacher = Teacher::where('user_id' , auth()->user()->id)->get();
            $subjects = $teacher->first()->subjects;
        }
    	return view('admin.subjects.index' , compact('subjects'));
    }
    public function create()
    {
    	$categories = Course::where('course_id' , '=' , null)->get();
    	$courses = Course::pluck('name','id');
        $teachers = Teacher::pluck('name' , 'id');
    	return view('admin.subjects.create' , compact('courses' , 'categories' , 'teachers'));
    }
    public function store(Request $request)
    {
    	
        $request->validate([
            'name' => 'required|between:3,30',
            'description' => 'required|between:3,15',
            'courses_id' => 'required'
    	]);

        $subject = new Subject;
        $subject->name = $request->name;
        $subject->description = $request->description;
        $subject->save();

        $subject->courses()->attach($request->courses_id);
        $subject->teachers()->attach($request->teacher_id);


    	return back()->with('flash' , 'Asignatura creada satisfactoriamente');
    }
    public function edit(Subject $subject)
    {

        $categories = Course::where('course_id' , '=' , null)->get();
        $courses = Course::pluck('name','id');
        $teachers = Teacher::pluck('name' , 'id');
    	return view('admin.subjects.edit' , compact('courses' , 'categories' , 'subject' , 'teachers'));
    }
    public function update(Request $request , Subject $subject)
    {
    	$request->validate([
            'name' => 'required|between:3,30',
            'description' => 'required|between:3,15',
            'courses_id' => 'required'
        ]);
        
        $subject->name = $request->name;
        $subject->description = $request->description;
        $subject->save();
        $subject->courses()->detach();
        $subject->courses()->attach($request->courses_id);
        $subject->teachers()->detach();
        $subject->teachers()->attach($request->teacher_id);

        return back()->with('flash' , 'Curso actualizado satisfactoriamente');
    }
    public function delete(Subject $subject)
    {
        $subject->clases()->delete();
        $subject->lessons()->delete();
        $subject->students()->detach();
        $subject->teachers()->detach();
        $subject->courses()->detach();
        $subject->delete();

        return back()->with('flash' , 'Curso eliminado satisfactoriamente');
    }
}
