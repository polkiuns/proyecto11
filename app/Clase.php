<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clase extends Model
{
    public function lesson()
    {
    	return $this->belongsTo(Lesson::class);
    }
    public function comments()
    {
    	return $this->hasMany(Comment::class);
    }
    public function files()
    {
    	return $this->hasMany(File::class);
    }
    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }
}
