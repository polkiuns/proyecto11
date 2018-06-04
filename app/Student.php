<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	public function subjects()
	{
		return $this->belongsToMany(Subject::class);
	}

	public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function subcriptions()
    {
    	return $this->hasMany(Subcription::class);
    }
}
