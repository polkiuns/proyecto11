<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcription extends Model
{
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function teacher()
    {
    	return $this->belongsTo(Teacher::class);
    }
    public function subject()
    {
    	return $this->belongsTo(Subject::class);
    }
}
