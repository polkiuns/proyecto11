<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clase;
use App\Subject;
class ClasesController extends Controller
{
    public function index(Subject $subject,Clase $clase)
    {
    	return view('classes.index' , compact('clase' , 'subject'));
    }
}
