<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Clase;
use App\File;


class FilesController extends Controller
{

    public function store($idClase)
    {
    	$clase_id=($idClase+1);
        $file = request()->file('file');
    	$filePath = $file->store('public');
    	$fileName = uniqid() . $file->getClientOriginalName();

    	File::create([
    		'name' => $fileName,
    		'url' => Storage::url($filePath),
    		'clase_id' => $clase_id

    	]);

    }
}
