<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
	 protected $fillable = ['name' , 'course_id'];

	public function parent()
	{
		return $this->belongsTo(Course::class , 'course_id');
	}

	public function childs()
	{
		return $this->hasMany(Course::class, 'course_id');
	}
    public function subjects()
	{
		return $this->belongsToMany(Subject::class);
	}

	//Setters
	public function getRouteKeyName()
    {
    	return 'url';
    }

    public function setNameAttribute($name)
    {
    	$this->attributes['name'] = $name;

    	$this->attributes['url'] = str_slug($name , "-");
    }
}
