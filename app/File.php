<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $guarded = [];

    public function clase()
    {
    	return $this->belongsTo(Clase::class);
    }
    public function teacher()
    {
    	return $this->belongsTo(Teacher::class);
    }
}
