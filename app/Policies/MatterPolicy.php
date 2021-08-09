<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Matter;
use Illuminate\Auth\Access\HandlesAuthorization;

class MatterPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the matter can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list matters');
    }

    /**
     * Determine whether the matter can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Matter  $model
     * @return mixed
     */
    public function view(User $user, Matter $model)
    {
        return $user->hasPermissionTo('view matters');
    }

    /**
     * Determine whether the matter can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create matters');
    }

    /**
     * Determine whether the matter can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Matter  $model
     * @return mixed
     */
    public function update(User $user, Matter $model)
    {
        return $user->hasPermissionTo('update matters');
    }

    /**
     * Determine whether the matter can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Matter  $model
     * @return mixed
     */
    public function delete(User $user, Matter $model)
    {
        return $user->hasPermissionTo('delete matters');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Matter  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete matters');
    }

    /**
     * Determine whether the matter can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Matter  $model
     * @return mixed
     */
    public function restore(User $user, Matter $model)
    {
        return false;
    }

    /**
     * Determine whether the matter can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Matter  $model
     * @return mixed
     */
    public function forceDelete(User $user, Matter $model)
    {
        return false;
    }
}
