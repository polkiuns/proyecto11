<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function planes()
    {
    	return view('planes');
    }
    public function contact()
    {
    	return view('contact');
    }
}
