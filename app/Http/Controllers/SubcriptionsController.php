<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Subcription;
class SubcriptionsController extends Controller
{
    public function create(Subject $subject)
    {
    	$subcription = new Subcription;
    	$subcription->subject_id = $subject->id;
    	$subcription->student_id = auth()->user()->student->id;
    	$subcription->teacher_id = $subject->teachers->first()->id;
    	$subcription->save();
    	return back();
    }
}
