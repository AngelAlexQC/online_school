<?php

namespace App\Policies;

use App\Models\User;
use App\Models\School;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchoolPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the school can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list schools');
    }

    /**
     * Determine whether the school can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\School  $model
     * @return mixed
     */
    public function view(User $user, School $model)
    {
        return $user->hasPermissionTo('view schools');
    }

    /**
     * Determine whether the school can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create schools');
    }

    /**
     * Determine whether the school can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\School  $model
     * @return mixed
     */
    public function update(User $user, School $model)
    {
        return $user->hasPermissionTo('update schools');
    }

    /**
     * Determine whether the school can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\School  $model
     * @return mixed
     */
    public function delete(User $user, School $model)
    {
        return $user->hasPermissionTo('delete schools');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\School  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete schools');
    }

    /**
     * Determine whether the school can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\School  $model
     * @return mixed
     */
    public function restore(User $user, School $model)
    {
        return false;
    }

    /**
     * Determine whether the school can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\School  $model
     * @return mixed
     */
    public function forceDelete(User $user, School $model)
    {
        return false;
    }
}
