<?php

namespace App\Policies;

use App\User;
use App\Lesson;
use Illuminate\Auth\Access\HandlesAuthorization;

class LessonPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the lesson.
     *
     * @param  \App\User  $user
     * @param  \App\Lesson  $lesson
     * @return mixed
     */
    public function view(User $user, Lesson $lesson)
    {
        if($user->hasRole('root') || $user->hasRole('teacher'))
        {
            return true;
        }
            return false;
        
    }

    /**
     * Determine whether the user can create lessons.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {

    }

    /**
     * Determine whether the user can update the lesson.
     *
     * @param  \App\User  $user
     * @param  \App\Lesson  $lesson
     * @return mixed
     */
    public function update(User $user, Lesson $lesson)
    {
        if($user->hasRole('root') || ($user->hasRole('teacher') && $lesson->teacher->id == $user->teacher->id))
        {
            return true;
        }
            return false;    
    }

    /**
     * Determine whether the user can delete the lesson.
     *
     * @param  \App\User  $user
     * @param  \App\Lesson  $lesson
     * @return mixed
     */
    public function delete(User $user, Lesson $lesson)
    {
        if($user->hasRole('root') || ($user->hasRole('teacher') && $lesson->teacher->id == $user->teacher->id))
        {
            return true;
        }
            return false; 
    }
}
