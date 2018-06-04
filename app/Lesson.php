<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
	public function parent()
	{
		return $this->belongsTo(Lesson::class , 'lesson_id');
	}

	public function childs()
	{
		return $this->hasMany(Lesson::class, 'lesson_id');
	}
	public function subject()
	{
		return $this->belongsTo(Subject::class);
	}
	public function clases()
	{
		return $this->hasMany(Clase::class);
	}
	public function teacher()
	{
		return $this->belongsTo(Teacher::class);
	}
}
