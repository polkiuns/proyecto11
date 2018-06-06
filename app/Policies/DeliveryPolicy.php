<?php

namespace App\Policies;

use App\User;
use App\Delivery;
use App\Clase;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeliveryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the delivery.
     *
     * @param  \App\User  $user
     * @param  \App\Delivery  $delivery
     * @return mixed
     */
    public function view(User $user, Delivery $delivery)
    {
        if($user->hasRole('root')){
            return true;
        } else if($user->hasRole('teacher')) {
            foreach($user->teacher->clases as $clase) {
                if($clase->id == $delivery->clase_id) {
                    return true;
                } 
            }
        return false;
        }
    }

    /**
     * Determine whether the user can create deliveries.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the delivery.
     *
     * @param  \App\User  $user
     * @param  \App\Delivery  $delivery
     * @return mixed
     */
    public function update(User $user, Delivery $delivery)
    {
        if($user->hasRole('root')){
            return true;
        } else if($user->hasRole('teacher')) {
            foreach($user->teacher->clases as $clase) {
                if($clase->id == $delivery->clase_id) {
                    return true;
                } 
            }
        return false;
        }
    }

    /**
     * Determine whether the user can delete the delivery.
     *
     * @param  \App\User  $user
     * @param  \App\Delivery  $delivery
     * @return mixed
     */
    public function delete(User $user, Delivery $delivery)
    {
        if($user->hasRole('root')){
            return true;
        } else if($user->hasRole('teacher')) {
            foreach($user->teacher->clases as $clase) {
                if($clase->id == $delivery->clase->id) {
                    return true;
                } else {
                    return false;
                }
            }
        }
    }

}
