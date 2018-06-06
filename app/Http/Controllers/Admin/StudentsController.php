<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Teacher;
use App\Subject;
use App\User;
use App\Lesson;
use App\Student;


class StudentsController extends Controller
{
    public function index()
    {
        $this->authorize('view' , new Student);
        if(auth()->user()->hasRole('root')) {
        $students = Student::all();            
        } else { 
        $teacher = auth()->user()->teacher;
        $subjects = $teacher->subjects->where('students' , '!=' , '[]')->unique('id');
        }
        
    	return view('admin.students.index' , compact('students' , 'subjects'));

    }
    public function create()
    {
        $this->authorize('view' , new Student);
        if(auth()->user()->hasRole('root')) {
        $subjects = Subject::pluck('name','id');            
    } else {
        $teacher = Teacher::where('user_id' , auth()->user()->id)->get()->first();
        $subjects = $teacher->subjects->pluck('name' , 'id');
    }
    	return view('admin.students.create' , compact('subjects'));
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

        $student = new Student;
        $user =  new User;
        
        $student->name = $request->name;
        $student->surnames = $request->surnames;
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->dni = $request->dni;
        $student->email = $request->email;
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        
        $student->user_id = $user->id;
        $student->save();

        $studentRole = Role::where('name' , 'student');


        $user->assignRole('student');

        if(count($request->subject_id) && auth()->user()->hasRole('teacher')){
            foreach($request->subject_id as $subject) {
                foreach(auth()->user()->teacher->subjects as $subjectTeacher) {
                    if($subject == $subjectTeacher->id) {       
        $student->subjects()->attach($request->subject_id);                        
    } else {
        $user->delete();
        return back()->with('flash' , 'Te agradeceria que no me hackeases, no te he guardado al alumno');
    }
                }
            }
        }

        $student->subjects()->attach($request->subject_id);
    	return back()->with('flash' , 'Profesor registrado correctamente');
    }

    public function edit(Student $student)
    {
        $this->authorize('update' , $student);
        if(auth()->user()->hasRole('root')) {
        $subjects = Subject::pluck('name','id');            
    } else {
        $teacher = Teacher::where('user_id' , auth()->user()->id)->get()->first();
        $subjects = $teacher->subjects->pluck('name' , 'id');
    }

    	return view('admin.students.edit' , compact('student' , 'subjects'));
    }
    public function update(Request $request , Student $student)
    {
        $request->validate([
            'name' => 'required|between:3,15',
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
        $user = User::find($student->user->id);

        $student->name = $request->name;
        $student->surnames = $request->surnames;
        $student->phone = $request->phone;
        $student->address = $request->address;
        $student->dni = $request->dni;
        $student->email = $request->email;
        
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->has('password')){
        $user->password = bcrypt($request->password);            
        }

        $user->save();
        
        $student->user_id = $user->id;
        $student->save();
        if(count($request->subject_id) && auth()->user()->hasRole('teacher')){
            foreach($request->subject_id as $subject) {
                foreach(auth()->user()->teacher->subjects as $subjectTeacher) {
                    if($subject == $subjectTeacher->id) {
        $student->subjects()->detach();        
        $student->subjects()->attach($request->subject_id);                        
    } else {
        return back();
    }
                }
            }
        }
		$student->subjects()->detach();        
        $student->subjects()->attach($request->subject_id);


        return back()->with('flash' , 'Profesor registrado correctamente');
    }
    public function delete(Student $student)
    {
        $this->authorize('delete' , $student);
        $student->user->delete();
        $student->subjects()->detach();
        $student->delete();

        return back()->with('flash' , 'Alumno eliminado satisfactoriamente');
    }
}
