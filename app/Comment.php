<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function clase()
    {
    	return $this->belongsTo(Clase::class);
    }
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
