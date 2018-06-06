<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function subjects()
    {
    	return $this->belongsToMany(Subject::class);
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    public function lessons()
    {
    	return $this->hasMany(Lesson::class);
    }
    public function clases()
    {
        return $this->hasManyThrough(Clase::class, Lesson::class);
    }
    public function students()
    {
        return $this->hasManyThrough(Student::class , Subject::class);
    }
    public function suscriptions()
    {
        return $this->hasMany(Suscription::class);
    }
    public function files()
    {
        return $this->hasMany(File::class);
    }

}
