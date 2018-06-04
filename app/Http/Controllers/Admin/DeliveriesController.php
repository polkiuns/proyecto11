<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Delivery;
class DeliveriesController extends Controller
{
    public function download(Delivery $delivery)
    {
    	$pathtoFile = public_path(). $delivery->url;
    	return response()->download($pathtoFile);
    }

    public function edit(Delivery $delivery, Request $request)
    {
        $request->validate([
            'nota' => 'numeric|min:0|max:10',
        ]);
        if(isset($delivery->nota))
    	{
    		$delivery->nota = $request->nota;
    	} else {
    		$delivery->nota = $request->nota;
    	}
    		$delivery->save();
    	return back()->with('flash' , 'Nota agregada correctamente');
    }

    public function delete(Delivery $delivery)
    {
    	$delivery->delete();
    	return back()->with('flash' , 'Nota eliminada correctamente');
    }
}
