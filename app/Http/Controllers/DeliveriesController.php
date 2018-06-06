<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Clase;
use App\Delivery;

class DeliveriesController extends Controller
{
    public function upload(Clase $clase)
    {
        $this->authorize('control', $clase);
    	if(count($clase->deliveries)){
        foreach($clase->deliveries as $delivery)
        {
        	if($delivery->user->id == auth()->user()->id) {
        		$delivery->delete();
        	}
        }    		
    	}

        $file = request()->file('file');
    	$filePath = $file->store('public');
    	$fileName = uniqid() . $file->getClientOriginalName();

    	Delivery::create([
    		'name' => $fileName,
    		'url' => Storage::url($filePath),
    		'user_id' => auth()->user()->id,
    		'clase_id' => $clase->id

    	]);

    }

    public function delete(Clase $clase)
    {
                $this->authorize('control', $clase);
        foreach($clase->deliveries as $delivery)
        {
        	if($delivery->user->id == auth()->user()->id) {
        		$filePath = str_replace('storage' , 'delivery' , $delivery->url);
        		Storage::delete($filePath);
        		$delivery->delete();

        	}
        } 

        return back();   
    }

    public function download(Clase $clase)
    {
                $this->authorize('control', $clase);
        foreach($clase->deliveries as $delivery)
        {
        	if($delivery->user->id == auth()->user()->id) {

    			$pathtoFile = public_path(). $delivery->url;
    			

        	}
        }
        return response()->download($pathtoFile);       	
    }
  
}
