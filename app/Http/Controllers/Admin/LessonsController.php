<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subject;
use App\Lesson;
use App\Teacher;

class LessonsController extends Controller
{
    public function index()
    {
         $this->authorize('view' , new Lesson);
        if(auth()->user()->hasRole('root')){
        $lessons = Lesson::all();           
        } else {
            $teacher = Teacher::where('user_id' , auth()->user()->id)->get();
            $lessons = Lesson::where('teacher_id' , $teacher->first()->id)->get();
        }

    	return view('admin.lessons.index' , compact('lessons'));

    }
    public function create()
    {
         $this->authorize('view' , new Subject);
    	
        if(auth()->user()->hasRole('root')){
        $categories = Lesson::where('lesson_id' , '=' , null)->get();
        $subjects = Subject::pluck('name' , 'id');
        $lessons = Lesson::pluck('name','id');            
        } else {
        $teacher = Teacher::where('user_id' , auth()->user()->id)->get();
        $subjects = $teacher->first()->subjects->pluck('name' , 'id');
        $categories = Lesson::where('lesson_id' , '=' , null)->get();
        }

    	return view('admin.lessons.create' , compact('subjects' , 'categories'));
    }
    public function store(Request $request)
    {
    	
        $request->validate([
            'name' => 'required|min:5|max:25',
            'subject_id' => 'required'

    	]);

        $lesson = new Lesson;
        $lesson->name = $request->name;
        $lesson->subject_id = $request->subject_id;
        if($request->lesson_id != 0){
            $lesson->lesson_id = $request->lesson_id;
        }
        if($request->has('published')) {
            $lesson->published = true;
        } else {
            $lesson->published = false;
        }
        if(auth()->user()->hasRole('root'))
        {
            $lesson->teacher_id = 0;
        }else {
            $lesson->teacher_id = auth()->user()->teacher->id;
        }
        
        $lesson->save();

    	return back()->with('flash' , 'Asignatura creada satisfactoriamente');

    }
    public function edit(Lesson $lesson)
    {
        $this->authorize('update' , $lesson);
        if(auth()->user()->hasRole('root')){
        $categories = Lesson::where('lesson_id' , '=' , null)->get();
        $subjects = Subject::pluck('name','id');            
        } else {
        $teacher = Teacher::where('user_id' , auth()->user()->id)->get();
        $subjects = $teacher->first()->subjects->pluck('name' , 'id');
        $allCategories = Lesson::where('lesson_id' , '=' , null)->get();
        $all2categories = $allCategories->where('subject_id' , $lesson->subject->id);
        $categories = $all2categories->where('teacher_id' , auth()->user()->teacher->id);
        }

    	return view('admin.lessons.edit' , compact('lesson' , 'categories' , 'subjects'));
    }
    public function update(Request $request , Lesson $lesson)
    {
    	$request->validate([
            'name' => 'required|min:5|max:25',
            'subject_id' => 'required'
        ]);
        
        $lesson->name = $request->name;
        $lesson->subject_id = $request->subject_id;
        $lesson->lesson_id= $request->lesson_id;
        if($request->has('published')) {
            $lesson->published = true;
        } else {
            $lesson->published = false;
        }
        if(auth()->user()->hasRole('root'))
        {
            $lesson->teacher_id = 0;
        }else {
            $lesson->teacher_id = auth()->user()->teacher->id;
        }
        $lesson->save();

        return back()->with('flash' , 'Curso actualizado satisfactoriamente');
    }
    public function delete(Lesson $lesson)
    {
        $lesson->delete();

        return back()->with('flash' , 'Curso eliminado satisfactoriamente');
    }
}
