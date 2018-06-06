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

        if(auth()->user()->hasRole('teacher')) {
        File::create([
            'name' => $fileName,
            'url' => Storage::url($filePath),
            'clase_id' => $clase_id,
            'teacher_id' => auth()->user()->teacher->id

        ]);            
        } else {
        File::create([
            'name' => $fileName,
            'url' => Storage::url($filePath),
            'clase_id' => $clase_id,
            'teacher_id' => null

        ]);            
        }



    }
    public function update($idClase)
    {
        $clase_id = $idClase;
        $file = request()->file('file');
        $filePath = $file->store('public');
        $fileName = uniqid() . $file->getClientOriginalName();

        if(auth()->user()->hasRole('teacher')) {
        File::create([
            'name' => $fileName,
            'url' => Storage::url($filePath),
            'clase_id' => $clase_id,
            'teacher_id' => auth()->user()->teacher->id

        ]);            
        } else {
        File::create([
            'name' => $fileName,
            'url' => Storage::url($filePath),
            'clase_id' => $clase_id,
            'teacher_id' => null

        ]);            
        }        
    }

    public function delete(File $file)
    {
        $this->authorize('delete', $file);
        $fileRute = str_replace('storage', 'public', $file->url);
        Storage::delete($fileRute);
        $file->delete();
        
        return back()->with('flash' , 'Archivo eliminado con exito');

    }

    public function download(File $file)
    {

        $this->authorize('delete' , $file);
        $pathtoFile = public_path().$file->url;
        return response()->download($pathtoFile);
    }
}
