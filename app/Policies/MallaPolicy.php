<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Malla;
use Illuminate\Auth\Access\HandlesAuthorization;

class MallaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the malla can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list mallas');
    }

    /**
     * Determine whether the malla can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Malla  $model
     * @return mixed
     */
    public function view(User $user, Malla $model)
    {
        return $user->hasPermissionTo('view mallas');
    }

    /**
     * Determine whether the malla can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create mallas');
    }

    /**
     * Determine whether the malla can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Malla  $model
     * @return mixed
     */
    public function update(User $user, Malla $model)
    {
        return $user->hasPermissionTo('update mallas');
    }

    /**
     * Determine whether the malla can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Malla  $model
     * @return mixed
     */
    public function delete(User $user, Malla $model)
    {
        return $user->hasPermissionTo('delete mallas');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Malla  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete mallas');
    }

    /**
     * Determine whether the malla can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Malla  $model
     * @return mixed
     */
    public function restore(User $user, Malla $model)
    {
        return false;
    }

    /**
     * Determine whether the malla can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Malla  $model
     * @return mixed
     */
    public function forceDelete(User $user, Malla $model)
    {
        return false;
    }
}
