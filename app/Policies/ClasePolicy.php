<?php

namespace App\Policies;

use App\User;
use App\Clase;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClasePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the clase.
     *
     * @param  \App\User  $user
     * @param  \App\Clase  $clase
     * @return mixed
     */
    public function view(User $user, Clase $clase)
    {
        if($user->hasRole('root') || $user->hasRole('teacher'))
        {
            return true;
        }
            return false;
    }

    /**
     * Determine whether the user can create clases.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the clase.
     *
     * @param  \App\User  $user
     * @param  \App\Clase  $clase
     * @return mixed
     */
    public function update(User $user, Clase $class)
    {
        if($user->hasRole('root') || ($user->hasRole('teacher') && $class->lesson->teacher->id == $user->teacher->id))
        {
            return true;
        }
            return false;
    }

    /**
     * Determine whether the user can delete the clase.
     *
     * @param  \App\User  $user
     * @param  \App\Clase  $clase
     * @return mixed
     */
    public function delete(User $user, Clase $class)
    {
        if($user->hasRole('root') || ($user->hasRole('teacher') && $class->lesson->teacher->id == $user->teacher->id))
        {
            return true;
        }
            return false;    
    }

    public function entrega(User $user, Clase $clase)
    {
        if($user->hasRole('root') || ($user->hasRole('teacher') && $clase->lesson->teacher->id == $user->teacher->id))
        {
            return true;
        }
            return false;    
    }

        public function control(User $user, Clase $clase)
    {
        if($user->hasRole('student'))
        {
            foreach($user->student->subjects as $subjectStudent) {

                    if($subjectStudent->id == $clase->lesson->subject->id) {
                        return true;
                    }
                
            }
            return false;
        }
            return false;    
    }
}
