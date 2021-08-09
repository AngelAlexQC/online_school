<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Career;
use Illuminate\Auth\Access\HandlesAuthorization;

class CareerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the career can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list careers');
    }

    /**
     * Determine whether the career can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Career  $model
     * @return mixed
     */
    public function view(User $user, Career $model)
    {
        return $user->hasPermissionTo('view careers');
    }

    /**
     * Determine whether the career can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create careers');
    }

    /**
     * Determine whether the career can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Career  $model
     * @return mixed
     */
    public function update(User $user, Career $model)
    {
        return $user->hasPermissionTo('update careers');
    }

    /**
     * Determine whether the career can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Career  $model
     * @return mixed
     */
    public function delete(User $user, Career $model)
    {
        return $user->hasPermissionTo('delete careers');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Career  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete careers');
    }

    /**
     * Determine whether the career can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Career  $model
     * @return mixed
     */
    public function restore(User $user, Career $model)
    {
        return false;
    }

    /**
     * Determine whether the career can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Career  $model
     * @return mixed
     */
    public function forceDelete(User $user, Career $model)
    {
        return false;
    }
}
