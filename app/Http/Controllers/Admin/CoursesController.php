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
        $this->authorize('create' , new Course);    
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
        $this->authorize('view' , $course);
    	$categories = Course::where('course_id' , '=' , null)->get();
    	if(count($course->childs)){
        $allCategories=Course::pluck('name','id')->except($course->childs->pluck('id'))->except($course->id);
        } else {
        $allCategories=Course::pluck('name','id')->except($course->id);
        }
    	
    	return view('admin.courses.edit' , compact('course' , 'categories' , 'allCategories'));
      
    }
    public function update(Request $request , Course $course)
    {
    	$request->validate([
            'name' => 'required|min:3|max:20',
            'courses_id' => [
                'nullable',
                function ($attribute, $value, $fail){
                   $course = 'App\Course'::find($value);
                   if(!isset($course)) {
                    return $fail($attribute. 'No es valido');
                   }
                }
            ]
        ]);
        $course->name = $request->name;
        

        if($request->has('courses_id')){ //Pedazo de arreglo para que no peten los cursos
            
            if(count($course->childs)){
                
                foreach($course->childs as $child){
                    
                    if($child->id == $request->courses_id) {
                        $course->course_id = null;
                    } else {
                    if($course->id == $request->courses_id) {
                        $course->course_id = null;
                    } else {
                        $course->course_id = $request->courses_id;
                    }
                }
            }
        }
            else {
                if($course->id == $request->courses_id){
                $course->course_id = null;
                } else {
                $course->course_id = $request->courses_id;
            }                
            } 
        } else {
        $course->course_id = null;
        }
        

        $course->save();

        return back()->with('flash' , 'Curso actualizado satisfactoriamente');
    }
    public function delete(Course $course)
    {
        if(count($course->childs)){
            return back()->with('error' , 'Curso eliminado satisfactoriamente');
        }
        $course->delete();
        return back()->with('flash' , 'Curso eliminado satisfactoriamente');
    }
}
