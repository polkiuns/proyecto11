<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Teacher;
use App\Subject;
use App\User;
use App\Lesson;
class TeachersController extends Controller
{
    public function index()
    {
        $this->authorize('view' , new Teacher);
    	$teachers = Teacher::all();
    	return view('admin.teachers.index' , compact('teachers'));
    }
    public function create()
    {
    	$subjects = Subject::pluck('name','id');
    	return view('admin.teachers.create' , compact('subjects'));
    }
    public function store(Request $request)
    {
    	
        $request->validate([
            'name' => [
                'required',
                'between:3,15',
                'regex:/^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$/'
        ],
            'surnames' => 'required|between:5,30',
            'phone' => [
                'required',
                'digits:9',
                'regex: /^((\+?34([ \t|\-])?)?[9|6|7]((\d{1}([ \t|\-])?[0-9]{3})|(\d{2}([ \t|\-])?[0-9]{2}))([ \t|\-])?[0-9]{2}([ \t|\-])?[0-9]{2})$/' 
            ],
            'address' => [
                'required',
                'between:5,30',
                'regex:/^Calle/i'
            ],
            'dni' => [
                'required',
                'min:9',
                'max:9',
                'regex:/^[XYZ]?([0-9]{7,8})([A-Z])$/i' 
            ],
            'email' => 'required|email', 
            'password' => 'required|between:3,15' ,
            'subject_id' => [
                'required',
                function ($attribute, $value, $fail){
                   $subject = 'App\Subject'::find($value);
                   if(!isset($subject)) {
                    return $fail($attribute. 'No es valido');
                   }
                }
            ]
    	]);

        $teacher = new teacher;
        $user =  new User;
        
        $teacher->name = $request->name;
        $teacher->surnames = $request->surnames;
        $teacher->phone = $request->phone;
        $teacher->address = $request->address;
        $teacher->dni = $request->dni;
        $teacher->email = $request->email;
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        
        $teacher->user_id = $user->id;
        $teacher->save();

        $teacherRole = Role::where('name' , 'teacher');

        $teacher->subjects()->detach();
        $teacher->subjects()->attach($request->subject_id);
        $user->assignRole('teacher');


    	return back()->with('flash' , 'Profesor registrado correctamente');
    }
    public function edit(Teacher $teacher)
    {
        $this->authorize('view' , $teacher);
        $subjects = Subject::pluck('name','id');
    	return view('admin.teachers.edit' , compact('teacher' , 'subjects'));
    }
    public function update(Request $request , Teacher $teacher)
    {

        $request->validate([
            'name' => [
                'required',
                'between:3,15',
                'regex:/^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$/'
        ],
            'surnames' => 'required|between:5,30',
            'phone' => [
                'required',
                'digits:9',
                'regex: /^((\+?34([ \t|\-])?)?[9|6|7]((\d{1}([ \t|\-])?[0-9]{3})|(\d{2}([ \t|\-])?[0-9]{2}))([ \t|\-])?[0-9]{2}([ \t|\-])?[0-9]{2})$/' 
            ],
            'address' => [
                'required',
                'between:5,30',
                'regex:/^Calle/i'
            ],
            'dni' => [
                'required',
                'min:9',
                'max:9',
                'regex:/^[XYZ]?([0-9]{7,8})([A-Z])$/i' 
            ],            'email' => 'required|email', 
            'password' => 'nullable|between:3,15' ,
            'subject_id' => [
                'required',
                function ($attribute, $value, $fail){
                   $subject = 'App\Subject'::find($value);
                   if(!isset($subject)) {
                    return $fail($attribute. 'No es valido');
                   }
                }
            ]
        ]);
        $user = User::find($teacher->user->id);

        $teacher->name = $request->name;
        $teacher->surnames = $request->surnames;
        $teacher->phone = $request->phone;
        $teacher->address = $request->address;
        $teacher->dni = $request->dni;
        $teacher->email = $request->email;
        
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->has('password')){
        $user->password = bcrypt($request->password);            
        }

        $user->save();
        
        $teacher->user_id = $user->id;
        $teacher->save();
        $teacher->subjects()->detach();
        $teacher->subjects()->attach($request->subject_id);

        return back()->with('flash' , 'Profesor registrado correctamente');
    }
    public function delete(Teacher $teacher)
    {
        $this->authorize('view' , $teacher);
        $teacher->user->delete();
        $teacher->subjects()->detach();
        $lesson = Lesson::where('teacher_id' , $teacher->id)->get();
        foreach ($lesson as $lessonTeacher) {
            $lessonTeacher->delete();
        };
        $teacher->delete();


        return back()->with('flash' , 'Profesor eliminado satisfactoriamente');
    }
}
