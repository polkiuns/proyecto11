<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subcription;
use App\Student;

class SubcriptionsController extends Controller
{
    public function index()
    {
    	$subcriptions = Subcription::all();
    	return view('admin.subcriptions' , compact('subcriptions' , 'students'));
    }
        public function accept(Subcription $subcription)
    {
    	
        $student = $subcription->student;
        $subject = $subcription->subject;

        $student->subjects()->attach($subject->id);

        $subcription->delete();

       return back()->with('flash' , 'Aceptado en la asignatura');

    }
        public function denegate(Subcription $subcription)
    {

        $subcription->delete();

        return back()->with('flash' , 'No se ha aceptado en la asigntura al alumno');
    }
}
