<?php

namespace App\Policies;

use App\User;
use App\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function view(User $user, Comment $comment)
    {
        //
    }

    /**
     * Determine whether the user can create comments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if(auth()->user()->hasRole('root') ||auth()->user()->hasRole('teacher') || auth()->user()->hasRole('student')){
            return true;
        } return false;
    }

    /**
     * Determine whether the user can update the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function update(User $user, Comment $comment)
    {
        if(auth()->user()->hasRole('root') ||auth()->user()->hasRole('teacher')){
            return true;
        } else if (auth()->user()->hasRole('student') && $comment->user_id == auth()->user()->id) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function delete(User $user, Comment $comment)
    {
        if(auth()->user()->hasRole('root') ||auth()->user()->hasRole('teacher')){
            return true;
        } else if (auth()->user()->hasRole('student') && $comment->user_id == auth()->user()->id) {
            return true;
        } else {
            return false;
        }
    }
}
