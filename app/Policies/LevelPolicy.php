<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Level;
use Illuminate\Auth\Access\HandlesAuthorization;

class LevelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the level can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list levels');
    }

    /**
     * Determine whether the level can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Level  $model
     * @return mixed
     */
    public function view(User $user, Level $model)
    {
        return $user->hasPermissionTo('view levels');
    }

    /**
     * Determine whether the level can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create levels');
    }

    /**
     * Determine whether the level can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Level  $model
     * @return mixed
     */
    public function update(User $user, Level $model)
    {
        return $user->hasPermissionTo('update levels');
    }

    /**
     * Determine whether the level can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Level  $model
     * @return mixed
     */
    public function delete(User $user, Level $model)
    {
        return $user->hasPermissionTo('delete levels');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Level  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete levels');
    }

    /**
     * Determine whether the level can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Level  $model
     * @return mixed
     */
    public function restore(User $user, Level $model)
    {
        return false;
    }

    /**
     * Determine whether the level can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Level  $model
     * @return mixed
     */
    public function forceDelete(User $user, Level $model)
    {
        return false;
    }
}
