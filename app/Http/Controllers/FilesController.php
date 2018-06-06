<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
class FilesController extends Controller
{
    public function download(File $file)
    {
    	$pathtoFile = public_path().$file->url;
    	return response()->download($pathtoFile);
    }
}
