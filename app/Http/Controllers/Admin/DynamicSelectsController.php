<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subject;
use App\Lesson;

class DynamicSelectsController extends Controller
{
    public function lesson($id)
    {
    	if(auth()->user()->hasRole('root')) {
    	    $subject = Subject::find($id);
            return response()->json($subject->lessons);    		
    	} else {
    		$subjectTeacher = Subject::find($id);
    		$lesson = $subjectTeacher->lessons->where('teacher_id' , auth()->user()->teacher->id);
    		return response()->json($lesson);
    	}

    }
}
