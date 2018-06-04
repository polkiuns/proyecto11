<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //Relaciones
    public function courses()
	{
		return $this->belongsToMany(Course::class);
	}
	public function lessons()
	{
		return $this->hasMany(Lesson::class);
	}
	public function teachers()
	{
		return $this->belongsToMany(Teacher::class);
	}

	public function students()
	{
		return $this->belongsToMany(Student::class);
	}
	public function suscriptions()
	{
		return $this->hasMany(Suscription::class);
	}

	//Setters
	public function getRouteKeyName()
    {
    	return 'url';
    }

    public function clases()
    {
      return $this->hasManyThrough(Clase::class, Lesson::class);
    }

    public function setNameAttribute($name)
    {
    	$this->attributes['name'] = $name;

    	$this->attributes['url'] = str_slug($name , "-");
    }
}
