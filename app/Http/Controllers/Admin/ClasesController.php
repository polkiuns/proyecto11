<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Clase;
use App\Lesson;
use App\Teacher;
use App\Subject;
use App\Delivery;
use App\controlClase;

class ClasesController extends Controller
{
    public function index()
    {
        $this->authorize('view' , new Clase);
        if(auth()->user()->hasRole('root')) {
        $classes = Clase::all();            
        } else {
        $teacher = Teacher::where('user_id' , auth()->user()->id)->get();
        $classes = $teacher->first()->clases;
        }
    	
        return view('admin.classes.index' , compact('classes'));

    }
    public function create()
    {
        $this->authorize('view' , new Clase);
        if(auth()->user()->hasRole('root')) {
        $lessons = Lesson::pluck('name','id');
        $subjects = Subject::pluck('name' , 'id');
        $idClase = controlClase::all()->pluck('id')->last();        
        } else {
        $teacher = Teacher::where('user_id' , auth()->user()->id)->get();
        $subjects = $teacher->first()->subjects->pluck('name' , 'id');
        $lessons = Lesson::where('teacher_id', $teacher->first()->id)->get()->pluck('name' , 'id');
        $idClase = controlClase::all()->pluck('id')->last(); 
        
        }

    	return view('admin.classes.create' , compact('subjects' , 'idClase'));
    }
    public function store(Request $request)
    {
    	
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:10|max:50',
            'body' => 'required|min:10|max:500',
            'iframe' => array(
                            'nullable',
                            'regex:/^<([a-z]+)([^<]+)*(?:>(.*)<\/\1>|\s+\/>)$/'
                                ),
            'lesson_id' => [
                'required',
                function ($attribute, $value, $fail){
                   $lesson = 'App\Lesson'::find($value);
                   if(!isset($lesson)) {
                    return $fail($attribute. 'No es valido');
                   }
                }
            ]
    	]);

        $clase = new Clase;
        $control = new controlClase;
        $clase->name = $request->name;
        $clase->url = str_slug($request->name);
        $clase->description = $request->description;
        $clase->iframe = $request->iframe;
        $clase->body = $request->body;
        $clase->lesson_id = $request->lesson_id;
        if($request->has('published')) {
            $clase->published = true;
        } else {
            $clase->published = false;
        }
        if($request->has('allowDelivery')) {
            $clase->allowDelivery = true;
        } else {
            $clase->allowDelivery = false;
        }
        $clase->save();
        $control->save();

    	return back()->with('flash' , 'Asignatura creada satisfactoriamente');
    }
    
    public function edit(Clase $class)
    {
        $this->authorize('update' , $class);
        if(auth()->user()->hasRole('root')) {
        $lessons = Lesson::pluck('name','id');
        $subjects = Subject::pluck('name','id');
        } else {
        $teacher = Teacher::where('user_id' , auth()->user()->id)->get();
        $subjects = $teacher->first()->subjects->pluck('name' , 'id');
        $lessons = Lesson::where('teacher_id', $teacher->first()->id)->get()->pluck('name' , 'id');            
        }
        
    	return view('admin.classes.edit' , compact('lessons' , 'class' , 'subjects'));
    }
    public function update(Request $request , Clase $class)
    {
        
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:10|max:50',
            'body' => 'required|min:10|max:500',
            'lesson_id' => [
                'required',
                function ($attribute, $value, $fail){
                   $lesson = 'App\Lesson'::find($value);
                   if(!isset($lesson)) {
                    return $fail($attribute. 'No es valido');
                   }
                }
            ],
            'iframe' => array(
                            'nullable',
                            'regex:/^<([a-z]+)([^<]+)*(?:>(.*)<\/\1>|\s+\/>)$/'
                                )            
        ]);

        $class->name = $request->name;
        $class->url = str_slug($request->name);
        $class->description = $request->description;
        $class->iframe = $request->iframe;
        $class->body = $request->body;
        $class->lesson_id = $request->lesson_id;
        if($request->has('published')) {
            $class->published = true;
        } else {
            $class->published = false;
        }
        if($request->has('allowDelivery')) {
            $class->allowDelivery = true;
        } else {
            $class->allowDelivery = false;
        }
        $class->save();

        return back()->with('flash' , 'Asignatura creada satisfactoriamente');
    }
    public function delete(Clase $class)
    {
        $this->authorize('delete' , $class);
        foreach ($class->files as $file) {
        $fileRute = str_replace('storage', 'public', $file->url);
        Storage::delete($fileRute);
        $file->delete();
        }
        $class->delete();

        return back()->with('flash' , 'Curso eliminado satisfactoriamente');
    }

    public function show(Clase $clase)
    {
        $this->authorize('entrega' , $clase);
        if(auth()->user()->hasRole('root'))
        {
            $deliveries = Delivery::where('clase_id' , $clase->id)->get();
        } else {
            $deliveries = Delivery::where('clase_id' , $clase->id)->get();
        }

        return view('admin.classes.show' , compact('deliveries'));
    }
}
