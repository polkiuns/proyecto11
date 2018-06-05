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
            'name' => 'required|between:3,15',
            'surnames' => 'required|between:5,30',
            'phone' => 'required|digits:9' ,
            'address' => 'required|between:5,30' ,
            'dni' => 'required|min:9|max:9' ,
            'email' => 'required|email', 
            'password' => 'required|between:3,15' ,
            'subject_id' => 'required'

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

        $student->subjects()->attach($request->subject_id);
        $user->assignRole('student');


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
            'phone' => 'required|digits:9' ,
            'address' => 'required|between:5,30' ,
            'dni' => 'required|min:9|max:9' ,
            'email' => 'required|email', 
            'password' => 'nullable|between:3,15' ,
            'subject_id' => 'required'
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

		$student->subjects()->detach();        
        $student->subjects()->attach($request->subject_id);

        return back()->with('flash' , 'Profesor registrado correctamente');
    }
    public function delete(Student $student)
    {
        $student->user->delete();
        $student->subjects()->detach();
        $student->delete();

        return back()->with('flash' , 'Alumno eliminado satisfactoriamente');
    }
}
